<script>
import axios from 'axios';
export default {
  data() {
    return {
      product: [],
      products: '',
      description:[],
      loading: true,
      user: [],
      cart: ''
    }
  },
  async created() {
    const user = await axios.get('/api/me', {
        headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`
        }
    });
    this.user = user.data.user;
    const proUrl = `/api/product/read/${this.$route.params.id}`;
    const res = await fetch(proUrl,{
      method: "GET",
      headers: {
            'Content-type': 'application/json',
      }
    })
    this.product = await res.json();
    this.products = this.product[0];
    this.loading = false;
    this.description = this.products.description.split(',');
  },
  methods: {
    showSuccessToast(message) {
      Toastify({
        text: message,
        type: "success",
        backgroundColor: "blue",
        canTimeout: true,
        duration: 3000, // 3 seconds
        close: true,
      }).showToast();
    },
    // Function to display an error toast
    showErrorToast(message) {
      Toastify({
        text: message,
        backgroundColor: "red",
        canTimeout: true,
        duration: 3000, // 3 seconds
        close: true,
      }).showToast();
    },
    async addtoCart(id) {
      const cartUrl = `/api/cart/create`;
      try {
        if(!this.user){
          this.showErrorToast("Please login to create a new cart");
        }else if(this.user){
          const res = await fetch(cartUrl,{
          method: "POST",
          headers: {
            'Authorization': `Bearer ${localStorage.getItem("token")}`,
            'Content-type': 'application/json'
          },
          body: JSON.stringify({
              product_id: id,
              user_id: this.user.id
          })
        });
        console.log(this.user);
        this.cart = await res.json();
          if(this.cart.success) {
            this.showSuccessToast("Sucessfully add to cart");
          }else{
            this.showErrorToast("Failed to add to cart");
          }
        }
        
      } catch (error) {
        console.error(error);

      }

    }
  },
}
</script>

<template>

  <div class="w-full p-5" v-if="products">
    <div class="flex items-center">
      <span class="text-blue-500 text-[20px]">Home</span>
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1668 28.3333C14.1668 29.0074 14.5729 29.6152 15.1957 29.8731C15.8185 30.1311 16.5353 29.9885 17.012 29.5119L25.3453 21.1785C25.9962 20.5276 25.9962 19.4724 25.3453 18.8215L17.012 10.4882C16.5353 10.0115 15.8185 9.8689 15.1957 10.1269C14.5729 10.3848 14.1668 10.9926 14.1668 11.6667V28.3333Z" fill="black"/>
      </svg>
      <span class="text-blue-500 text-[20px]">Category</span>
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1668 28.3333C14.1668 29.0074 14.5729 29.6152 15.1957 29.8731C15.8185 30.1311 16.5353 29.9885 17.012 29.5119L25.3453 21.1785C25.9962 20.5276 25.9962 19.4724 25.3453 18.8215L17.012 10.4882C16.5353 10.0115 15.8185 9.8689 15.1957 10.1269C14.5729 10.3848 14.1668 10.9926 14.1668 11.6667V28.3333Z" fill="black"/>
      </svg>
      <span class="text-[20px]">{{ products.category.name }}</span>
    </div>
    <div class="relative w-full m-auto h-[400px]" >
        <div class=" w-[60%] absolute left-0 flex h-[400px] justify-center
          bg-[#EEEEEE] pl-0 gap-y-4 items-center drop-shadow-[10px_4px_4px_rgba(0,0,0,0.25)]">
          <img :src="'/image'+products.image_url" class="w-[300px] h-fit" alt="product image">
        </div>
        <div class="absolute right-0 gap-y-2 flex w-[37%] h-fit p-4 border-[1px] flex-col bg-[#F5F5F5]">
            <span>
              {{ products.title }}
            </span>
            <div class="flex justify-between pb-4 border-b-[1px]">
              <span class="text-[#121BEE] font-bold">
                $ {{ products.price }}
              </span>
              <span class="text-[12px] text-gray-400
              ">200 sold</span>
            </div>
            <div class="p-5 border-b-[1px]">
              <div class="flex gap-x-4" v-for="(des,index) in description" :key="index">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12ZM18.4158 9.70405C18.8055 9.31268 18.8041 8.67952 18.4127 8.28984L17.7041 7.58426C17.3127 7.19458 16.6796 7.19594 16.2899 7.58731L10.5183 13.3838L7.19723 10.1089C6.80398 9.72117 6.17083 9.7256 5.78305 10.1189L5.08092 10.8309C4.69314 11.2241 4.69758 11.8573 5.09083 12.2451L9.82912 16.9174C10.221 17.3039 10.8515 17.301 11.2399 16.911L18.4158 9.70405Z" fill="#121BEE"/>
                </svg>
                <span>{{des}}</span>
              </div>
            </div>
            <div class="flex pt-4 gap-x-4 pb-4 border-b-[1px]">
              <input type="number" value="1" class="p-3 w-[70px] bg-[#D9D9D9] font-bold">
              <button class="w-fit rounded-[15px] p-3 text-white
              bg-black font-semibold drop-shadow-[10px_4px_4px_rgba(0,0,0,0.25)]"
              @click="addtoCart(products.id)"
              >Add to cart</button>
            </div>
            <span class="p-1 text-[14px]">{{ products.note }}</span>
        </div>
    </div>
    <div class="flex gap-x-4 pt-4 pb-4 border-b-[1px]">
      <div class="w-[100px] h-[100px] border-[5px] shadow-[10px_10px_4px_0_rgba(0,0,0,0.25)]
        border-blue-400 flex justify-center items-center">
        <img :src="'/image'+products.image_url" class="w-[80px] h-fit" alt="">
      </div>
    </div>
    <div class="flex flex-col">
      <span class="font-bold text-[20px] pt-2 w-fit border-b-[2px] border-blue-600">
        You might also like
      </span>
      <div class="flex pt-5 w-full justify-between">
        <div class="h-fit flex flex-col items-center bg-white font-bold
         w-[23%] drop-shadow-[10px_4px_4px_rgba(0,0,0,0.25)] rounded-[15px] p-6">
        <img class="w-[100px] h-fit" src="../assets/images/iphone-14promax.png" alt="">
        <span>Samsung s20 ultra</span>
        <span class="text-blue-500">$799.99</span>
        </div>
        <div class="h-fit flex flex-col items-center bg-white font-bold
         w-[23%] drop-shadow-[10px_4px_4px_rgba(0,0,0,0.25)] rounded-[15px] p-6">
        <img class="w-[100px] h-fit" src="../assets/images/iphone-14promax.png" alt="">
        <span>Samsung s20 ultra</span>
        <span class="text-blue-500">$799.99</span>
        </div>
        <div class="h-fit flex flex-col items-center bg-white font-bold
         w-[23%] drop-shadow-[10px_4px_4px_rgba(0,0,0,0.25)] rounded-[15px] p-6">
        <img class="w-[100px] h-fit" src="../assets/images/iphone-14promax.png" alt="">
        <span>Samsung s20 ultra</span>
        <span class="text-blue-500">$799.99</span>
        </div>
        <div class="h-fit flex flex-col items-center bg-white font-bold
         w-[23%] drop-shadow-[10px_4px_4px_rgba(0,0,0,0.25)] rounded-[15px] p-6">
        <img class="w-[100px] h-fit" src="../assets/images/iphone-14promax.png" alt="">
        <span>Samsung s20 ultra</span>
        <span class="text-blue-500">$799.99</span>
        </div>
      </div>
    </div>
  </div>
  <div v-if="products" class="mt-[40px] w-full h-[120px] flex" style="background-color: #5599FF;font-family: 'Roboto',sans-serif;">
      <div class="w-[40%] flex flex-col justify-center items-center">
        <p class="text-white text-[32px]">Sign up with us</p>
        <p class="text-gray-200 text-[20px] pl-[78px]">Be the first our Newsletter today!</p>
      </div>
      <div class="w-[70%] flex items-center">
        <form>
          <div class="relative">
          <input type="email" class="w-[700px] h-[55px] rounded-[55px] p-7 text-[20px]" placeholder="please input your email" style="font-family: 'Roboto',sans-serif;">
          <button class="w-[170px] h-[56px] rounded-[55px] text-white bg-black absolute right-0 font-bold">Sign up</button>
        </div>
        </form>
      </div>
    </div>
  <div v-if="products" class="w-full h-[125px] flex text-white justify-between pt-4 pl-[200px] pr-[200px]" style="background-color: #1E2425 ">
    <div class="flex flex-col w-[150px]">
      <p class="font-bold text-[18px] text-center">Follow us</p>
      <div class="flex gap-x-4">
        <img src="../assets/images/facebok-logo.svg" alt="">
        <p>Facebook</p>
      </div>
      <div class="flex gap-x-4">
        <img src="../assets/images/twitter-logo.svg" alt="">
        <p>Twitter</p>
      </div>
      <div class="flex gap-x-4">
        <img src="../assets/images/instagram-logo.svg" alt="">
        <p>Instagram</p>
      </div>
    </div>
    <div class="flex flex-col ">
      <p class="font-bold text-[18px] text-center">Customer Services</p>
      <div class="flex gap-x-4">
        <img src="../assets/images/phone-icon.svg" alt="">
        <p>+885 16838248</p>
      </div>
      <div class="flex gap-x-4">
        <img src="../assets/images/telegram-icon.svg" alt="">
        <p>t.me/narashop</p>
      </div>
    </div>
    <div class="flex flex-col">
      <p class="font-bold text-[18px] text-center">We accept</p>
      <img src="../assets/images/pay-method.png" alt="">
    </div>
    
  </div>
  <div v-if="loading" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-75 bg-gray-300">
    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-[#333]"></div>
  </div>
</template>

<style>
@media (min-width: 1024px) {
  .product {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
