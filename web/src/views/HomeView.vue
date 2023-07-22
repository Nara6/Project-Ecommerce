<script>
export default {
  data(){
    return{
      category: [],
      product:[],
      url: "/image"
    }
  },
  async mounted() {
    const url= "/api/category/read?limit=6"
      const category = await fetch(url,{
        method:"GET",
        headers: {
            'Content-type': 'application/json',
        }
      })
      const product = await fetch("/api/product/read",{
        method:"GET",
        headers: {
            'Content-type': 'application/json',
        }
      })
      this.product = await product.json();
      this.category = await category.json();
      console.log(this.product);
  },
  
}
</script>

<template>
  <div class="wrapper mt-4 w-full">
    <div class="w-full h-[425px] slider mt-4">
      <p class="best">best product of the day</p>
      <img src="../assets/images/headphone.png" alt="" class="headphone">
      <p class="sony-xm5">sony-xm<span class="text-5">5</span></p>
      <router-link to="/product/detail">
        <button class="button-buynow"><span class="text-buynow">BUY NOW</span></button>
      </router-link>
      <button class="switch-slider-circle"></button>
      <button class="switch-slider-ellipse"></button>
    </div>
    <div class="w-full h-[700px] p-9">
      <div class="flex flex-col gap-y-6">
        <p class="trend">Trending Categories</p>
        <div class="flex justify-between">
          <div class="flex flex-col text-center justify-between text-[25px] hover:cursor-pointer" v-for="cat in category" :key="cat.id">
            <img :src="this.url+cat.image_url" alt="" class="w-[150px] h-fit">
            <span style="font-family: 'Roboto', sans-serif;" class="w-full">{{cat.name}}</span>
          </div>
        </div>
        <div class="flex justify-between">
          <div class=" w-[650px] h-[350px] box-slide text-center">
            <p class="pt-5 text-xl" style="font-family: 'Roboto',sans-serif">SECURITY SMART CAMERA</p>
            <p class="pt-4 text-4xl" style="font-family: 'Roboto',sans-serif">Just starting at 350$</p>
            <button class="w-[144px] h-[49px] text-white rounded-[10px] mt-3" style="background-color: #4D9FEB;">BUY NOW</button>
            <div class="flex justify-center">
              <img src="../assets/images/camera.png" alt="">
            </div>
          </div>
          <div class=" w-[650px] h-[350px] box-slide text-center">
            <p class="pt-5 text-xl" style="font-family: 'Roboto',sans-serif">GAME CONTROLER</p>
            <p class="pt-4 text-4xl" style="font-family: 'Roboto',sans-serif">Just starting at 250$</p>
            <button class="w-[144px] h-[49px] text-white rounded-[10px] mt-3" style="background-color: #4D9FEB;">BUY NOW</button>
            <div class="flex justify-center">
              <img src="../assets/images/controler.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full h-[400px] slide-1 mt-7 flex gap-y-7">
      <div class="w-[60%] flex flex-col items-center ml-[200px] mt-5">
        <div class="bg-red-600 w-[230px] h-[85px] text-white text-[25px] flex items-center justify-center" style="font-family: 'Saira Condensed', sans-serif;">HURRY UP!</div>
        <p style="font-family: 'Saira Condensed', sans-serif;" class="text-[64px] font-bold">Up to 25% Discount</p>
        <div class="w-full flex justify-center">
          <p style="font-family: 'Saira Condensed', sans-serif;" class="text-[28px] text-gray-700 w-[430px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        </div>
        <div class="w-[67%]">
          <button class="button-buynow-1 mt-5"><span class="text-buynow">BUY NOW</span></button>
        </div>
      </div>
      <div class="w-[40%] flex mt-5 mr-[150px]">
        <img src="../assets/images/ps5.png" alt="" class="w-[450px] h-[350px]">
      </div>
    </div>
    <div class="w-full pl-9 pr-9 flex flex-col gap-y-6">
      <div class="flex justify-between">
        <p class="trend">Popular Products</p>
        <a href="#" class="underline underline-offset-2 text-[20px]" style="font-family: 'Roboto',sans-serif; color: #0862CB;">View all Product</a>
      </div>
      <router-link to="/product/detail">
      <div class="flex justify-between " >
        <div v-for="products in product" :key="products.id" class="w-[310px] h-[370px] bg-gray-200 flex flex-col items-center hover:cursor-pointer justify-center relative" style="box-shadow: 4px 10px 4px rgba(0, 0, 0, 0.25);"><img :src="this.url+products.image_url" class="w-[200px] h-fit" alt=""><span class="text-red-500 text-[30px] font-bold absolute bottom-[10px]" style="font-family: 'Roboto',sans-serif;">$ {{ products.price }}</span></div>
        
      </div>
      </router-link>
      
      
    </div>
    <div class="mt-[40px] w-full h-[120px] flex" style="background-color: #5599FF;font-family: 'Roboto',sans-serif;">
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
    <div class="w-full h-[125px] flex text-white justify-between pt-4 pl-[200px] pr-[200px]" style="background-color: #1E2425 ">
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
  </div>
</template>

<style>
@media (min-width: 1024px) {
  .button-buynow-1{
    width: 272px;
    height: 65px;
    background: rgba(77, 159, 235, 0.9);
    box-shadow: 10px 10px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
  }
    .slider{
      background: linear-gradient(180deg, #66EDBF 0%, rgba(182, 226, 211, 0) 100%), #EF7C8E;
    }
    .slide-1{
      background: linear-gradient(180deg, #EEACB6 0.23%, rgba(219, 219, 219, 0) 100%);
    }
    .best{

    position: absolute;
    width: 371px;
    height: 256px;
    left: 95px;
    top: 150px;

    font-family: 'Chivo';
    font-style: normal;
    font-weight: 900;
    font-size: 48px;
    line-height: 57px;
    display: flex;
    align-items: center;
    text-align: center;
    text-transform: uppercase;

    color: #000000;
    }
    .headphone{
      width: 650px;
      position: absolute;
      left: 399px;
      top: 80px;

      background: url(image.png);
      filter: drop-shadow(5px 10px 4px rgba(0, 0, 0, 0.25));
    }
    .sony-xm5{
      position: absolute;
      width: 258px;
      height: 109px;
      left: 900px;
      top: 140px;

      font-family: 'Chivo';
      font-style: normal;
      font-weight: 700;
      font-size: 48px;
      line-height: 57px;
      display: flex;
      align-items: center;
      text-align: center;
      text-transform: uppercase;

      color: #000000;

      text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }
    .text-5{
      color: #EF7C8E;
    }
    .button-buynow{
      position: absolute;
      width: 272px;
      height: 65px;
      left: 154px;
      top: 380px;
      background: #4D9FEB;
      box-shadow: 10px 10px 4px rgba(0, 0, 0, 0.25);
      border-radius: 10px;
    }
    .text-buynow{
      width: 218px;
      font-weight: 100;
      height: 29px;
      font-family: 'Lato',sans-serif;
      font-style: normal;
      font-size: 30px;
      color: #FFFFFF;
    }
    .switch-slider-circle {
      position: absolute;
      width: 23px;
      height: 23px;
      left: 662px;
      top: 474px;
      border-radius: 100%;
      background: #4D9FEB;
    }
    .switch-slider-ellipse{
      position: absolute;
      width: 56px;
      height: 25px;
      left: 703px;
      top: 474px;

      background: #F3F3F3;
      border-radius: 70px;
    }
    .trend{
      font-family: 'Lato',sans-serif;
      font-size: 32px;
      font-weight: bold;
    }
    .box-slide{
      background: linear-gradient(180deg, #F5F5F5 0%, rgba(217, 217, 217, 0) 100%);
    }
}
</style>
