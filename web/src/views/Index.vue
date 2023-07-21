<template>
  <div class="nav flex gap-x-4 mt-4 h-[70px] w-full justify-around">
    <router-link to="/home">
      <div class="flex gap-x-5">
      
      <img src="../assets/images/logo1.png" alt="" class="w-[70px] h-[70px]">
      <p class="flex items-center text-[30px]" style="font-family: 'Roboto', sans-serif;text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Nara Shop</p>
    </div>
    </router-link>
    
    <div class="flex gap-x-7 items-center text-[20px]" style="font-family: 'Lato', sans-serif;">
      <router-link to="/about">About us</router-link>
      <router-link to="/product">Categories</router-link>
      <router-link to="/contact">Contact us</router-link>
    </div>
    <div class="flex gap-x-4">
      <div class="flex items-center">
      <img class="absolute h-[27px] ml-1" src="../assets/images/search.svg" alt="">
      <input type="search" name="gsearch" class="bg-gray-300 w-[350px] h-[35px] pl-8 rounded-xl placeholder:text-[13px] placeholder:italic" placeholder="Search">
    </div>
    <div class="flex items-center flex-col justify-center">
      <div class="flex gap-x-3 hover:cursor-pointer">
        <div class="h-[40px] group relative ">
          <img src="../assets/images/user_svgrepo.com.svg" alt="" class="h-[35px] ">
          <div class="hidden group-hover:block flex-col absolute font-bold
            bg-white w-[80px] h-[80px] rounded-md drop-shadow-2xl p-2">
            <router-link to="/auth/login" class="py-2 block hover:text-blue-400">Login</router-link>
            <router-link to="/auth/signup" class="block w-[100px] hover:text-blue-400">Sign up</router-link>
          </div>
        </div>
        <router-link to="/wishlist">
          <img src="../assets/images/heart-solid.svg" alt="" class="h-[35px] ">
        </router-link>
        <router-link to="/cart">
          <img src="../assets/images/Vector.svg" alt="" class="h-[35px]">
        </router-link>
      </div>
    </div>
    </div>
  </div>
  <router-view/>
  
</template>
