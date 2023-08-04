<script >
import authApi from "@/libs/apis/auth";
import axios from 'axios';
import Toastify from 'toastify-js';

export default {
  data() {
    return {
      user: ''
    }
  },
  async mounted() {
      try {
          const user = await axios.get('/api/me', {
              headers: {
                  Authorization: `Bearer ${localStorage.getItem("token")}`
              }
          });
          console.log(user.data);
          if (user.data.success===false) {
              this.showToast(user.data.status)
              this.$router.push({ path: '/auth/login' });
          } else {
              this.user = user.data.user;
          }
          this.loading = false; // Set loading to false once data is fetched
      } catch (error) {
          console.error('Error fetching data:', error);
          this.loading = false; // Set loading to false in case of an error as well
      }
  },
  methods: {
    async onLogout() {
      localStorage.removeItem('token')
      this.$router.go(this.$router.currentRoute);
    },
    showToast(msg){
      Toastify({
        text: msg,
        backgroundColor: "red",
        duration: 3000, // 3 seconds
        close: true,
      }).showToast();
    }
  },
};
</script>

<template >
  <main>
    <div class="bg-gray-500 text-white py-2 text-lg text-center relative">
      <h1>Admin Dashboard Page</h1>
      <div
        v-on:click="onLogout()"
        class="
          absolute
          text-white
          right-2
          top-2
          bg-gray-400
          hover:bg-yellow-400
          px-2
          rounded-md
          cursor-pointer
        "
      >
        Logout

      </div>
      
    </div>
    <div class="flex flex-row">
      <div class="basis-1/5 p-1">
        <div class="flex flex-col p-3 space-y-3 bg-gray-200">
          <div class="flex justify-center">
            <img class="w-[50px]"
            src="../../assets/logo1.png" alt="">
          </div>
          <router-link to="/category"
            ><div class="hover:bg-white hover:font-bold">Category</div></router-link
          >
          <router-link to="/item"
            ><div class="hover:bg-white hover:font-bold">Item</div></router-link
          >
          <router-link to="/product"
            ><div class="hover:bg-white hover:font-bold">Product</div></router-link
          >
          <router-link to="/order"
            ><div class="hover:bg-white hover:font-bold">Order</div></router-link
          >
        </div>
      </div>
      <div class="basic-4/5 p-1 w-full">
        <router-view></router-view>
      </div>
    </div>
  </main>
</template>

<style>
</style>