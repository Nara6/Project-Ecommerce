<script>
export default {
  data() {
    return {
      category: [],
      item: [],
      product: [],
      showSubcategories: false,
      url: "/api"
    }
  },
  async mounted(){
    const catUrl = "/api/category/read"
    const proUrl = "/api/product/read"
    const category = await fetch(catUrl,{
      method: "GET",
      headers: {
            'Content-type': 'application/json',
      }
    });
    const product = await fetch(proUrl,{
      method: "GET",
      headers: {
            'Content-type': 'application/json',
      }
    });
    this.product = await product.json();
    this.category=await category.json();
    // console.log(this.product);
  },
  methods: {
    toggleSubcategories(cat) {
      cat.showSubcategories = !cat.showSubcategories;
    },
  },
}
</script>

<template>
    <div class="wrapper mt-4 w-full ">
       

        <div class="w-full p-[50px] mt-4 bg-[#F4F4F4]">
            <span class="font-bold"
             style="color:rgba(0, 0, 0, 0.50);">Home / 
             <span class="text-[#EC3535]">Product</span></span>
        </div>
        
        <div class="w-full p-[50px] flex gap-x-9">
          <div class="w-[25%] h-screen flex gap-y-4 flex-col ">
            <!-- for search -->
            <div class="h-[180px] bg-[#EEEEEE] flex flex-col p-6 pt-8 gap-y-5 rounded-[10px]">
              <span class="text-[23px]">Search</span>
              <div class="relative">
                <img src="../assets/images/search.svg" alt="" class="absolute right-1 top-0.5">
                <input type="text" class="p-2 rounded-[20px] w-[240px]" placeholder="Search for product">
              </div>
            </div>
            <!-- for Categories -->
            <div class="bg-[#EEEEEE] h-fit rounded-[10px] p-6 flex flex-col gap-y-4 font-bold" >
              <span class="text-[23px]">Categories</span>
              <div class="flex flex-col" v-for="cat in category" :key="cat.id">
                <div class="flex justify-between">
                  <div class="flex gap-x-2 items-center cursor-pointer" @click="toggleSubcategories(cat)" >
                    <svg :class="{'rotate-90': cat.showSubcategories}" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.13588 16.7515C4.48003 17.0828 5.03731 17.0828 5.38058 16.7515L12.6587 9.72751C13.347 9.0641 13.347 7.98786 12.6587 7.32445L5.32787 0.2486C4.98723 -0.0792828 4.43692 -0.0835323 4.09188 0.240105C3.73981 0.570538 3.73555 1.11502 4.08234 1.45055L10.7919 7.92499C11.136 8.25713 11.136 8.79483 10.7919 9.12696L4.13588 15.5504C3.79172 15.8817 3.79172 16.4194 4.13588 16.7515Z" fill="black" fill-opacity="0.6"/>
                    </svg>
                    <span class="text-[20px]">{{ cat.name }}</span>
                  </div>
                  <div class="text-[20px]">({{ cat.item.length }})</div>
                </div>
                <ul v-if="cat.showSubcategories" v-for="item in cat.item" :key="item.id" class="flex flex-col list-disc list-inside pl-1.5">
                    <!-- Display subcategories here -->
                    <li class="text-[18px] font-semibold cursor-pointer">{{ item.name }}</li>
                </ul>

                
              </div>
            </div>
          </div>
          <!-- for display Product -->
          <div class="h-screen w-full flex gap-y-4 flex-col ">
            <!-- filter -->
            <div class="w-full h-[100px] rounded-[10px] border-[1px] flex justify-between p-[35px]">
              <div class="text-[18px]">
                Showing 1-9 of 9 result
              </div>
              <div class="flex gap-x-3 items-center">
                <span class="font-bold">Sort By:</span>
                <select name="filter" id="" class="w-[200px] h-[30px] border-[1px]">
                  <option value="Testing">Alphabetically, A-Z</option>
                </select>
              </div>
            </div>

            <div class="flex w-full gap-y-4" >
              <div class="flex gap-x-5 w-full flex-wrap" v-for="products in product" :key="products.id">
                <div class="flex h-fit p-[36px] bg-[#D9D9D9] flex-col items-center gap-y-2 drop-shadow-[10px_10px_4px_rgba(0,0,0,0.25)]">
                 <img :src="this.url+products.image_url" alt="" class="w-[150px] h-[150px]">
                 <span class="text-[20px]">{{ products.title }}</span>
                 <span class="text-[20px] text-red-500 font-bold">$ {{ products.price }}</span> 
                </div>
              </div>     
            </div>
            <!-- pagination -->
            <div class="w-full flex justify-center p-6 h-auto">
              <div class="flex gap-x-4 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41" fill="none">
                  <path d="M32.4583 32.4582L21.708 21.7078C21.0409 21.0407 21.0409 19.959 21.708 19.2919L32.4583 8.5415" stroke="black" stroke-opacity="0.6" stroke-width="3.41667" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M18.7917 32.4582L8.04131 21.7078C7.37415 21.0407 7.37415 19.959 8.04131 19.2919L18.7917 8.5415" stroke="black" stroke-opacity="0.6" stroke-width="3.41667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="flex  w-[45px] h-[45px] rounded-[50%] justify-center items-center
               bg-red-500 font-bold text-white"
                >1</div>
                <span class="font-bold">2</span>
                <span class="font-bold">3</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41" fill="none">
                  <path d="M8.54167 8.54183L19.292 19.2922C19.9591 19.9593 19.9591 21.041 19.292 21.7081L8.54167 32.4585" stroke="black" stroke-opacity="0.6" stroke-width="3.41667" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M22.2083 8.54183L32.9587 19.2922C33.6258 19.9593 33.6258 21.041 32.9587 21.7081L22.2083 32.4585" stroke="black" stroke-opacity="0.6" stroke-width="3.41667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
          </div>
        </div>
        <!-- footer -->

    </div>
</template>
<style>

</style>
