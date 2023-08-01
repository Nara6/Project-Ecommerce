<template>
  <div class="nav flex gap-x-4 mt-4 h-[70px] w-full justify-around">
    <router-link to="/home">
      <div class="flex gap-x-5">
      
      <img src="../assets/images/logo1.png" alt="" class="w-[70px] h-[70px]">
      <p class="flex items-center text-[30px]" style="font-family: 'Roboto', sans-serif;text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Nara Shop</p>
    </div>
    </router-link>
    
    <div class="flex gap-x-7 items-center text-[20px] " style="font-family: 'Lato', sans-serif;">
      <router-link to="/about"   
      class="hover:text-blue-400">About us</router-link>
      <router-link to="/product" 
      class="hover:text-blue-400">Categories</router-link>
      <router-link to="/contact" 
      class="hover:text-blue-400">Contact us</router-link>
    </div>
    <div class="flex gap-x-4">
      <div class="flex items-center">
      <img class="absolute h-[27px] ml-1" src="../assets/images/search.svg" alt="">
      <input type="search" name="gsearch" class="bg-gray-300 w-[350px] h-[35px] pl-8 rounded-xl placeholder:text-[13px] placeholder:italic" placeholder="Search">
    </div>
    <div class="flex items-center flex-col justify-center">
      <div class="flex gap-x-3 hover:cursor-pointer">
        <div class="h-[40px] group relative ">
          <img src="../assets/images/user_svgrepo.com.svg" alt="" 
          class="h-[35px] transition duration-300 ease-in-out hover:scale-[1.2]">
          <div class="hidden group-hover:block flex-col absolute font-bold z-[1]
            bg-white w-[80px] h-[80px] rounded-md drop-shadow-2xl p-2">
            <router-link v-if="!user"  to="/auth/login" class="py-2 block hover:text-blue-400">Login</router-link>
            <router-link v-if="!user" to="/auth/signup" class="block w-[100px] hover:text-blue-400">Sign up</router-link>
            <div @click="logout" v-if="user" class="block w-[100px] hover:text-blue-400">Log out</div>
          </div>
        </div>
        <router-link to="/wishlist">
          <img src="../assets/images/heart-solid.svg" alt="" 
          class="h-[35px] transition duration-300 ease-in-out hover:scale-[1.2]">
        </router-link>
        <router-link to="/cart">
          <img src="../assets/images/Vector.svg" alt="" 
          class="h-[35px] transition duration-300 ease-in-out hover:scale-[1.2]">
        </router-link>
      </div>
    </div>
    </div>
  </div>
  <router-view/>
</template>
<script>
import axios from 'axios';
export default {
  data() {
    return {
      user: {}
    }
  },
  async mounted() {
    const user = await axios.get('/api/me',{
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`
        }
      });
      console.log(user);
      this.user = user.data.user;
  },
  methods: {
    logout(){
      localStorage.removeItem('token');
      this.$router.go(0);
    }
  },
}

</script>
