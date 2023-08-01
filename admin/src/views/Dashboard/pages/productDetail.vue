<script>
import productApi from '../../../libs/apis/product';
import priceApi from "@/libs/apis/price";

export default{
    data() {
        return {
            products: [],
            selectedProduct: null,
            priceModalShown: false,
            price: "",
            source: ""
        }
    },
    async created() {
        const id = this.$route.params.id;
        this.selectedProduct= id
        this.products = await productApi.getById(id);
    },
    methods:{
        onSelectProduct(){
            this.priceModalShown = true;
            console.log(this.selectedProduct);
        },
        async onAddPrice(e) {
            e.preventDefault();
            const { price, source, selectedProduct } = this;
            const result = await priceApi.add({
                price,
                source,
                product: selectedProduct
            });
            console.log(source);
            console.log(result);
            if (result.error) {
                alert(result.error);
                return;
            }

            this.products = await productApi.getById(selectedProduct);
            this.price = this.source = this.selectedProduct = "";
        },
    }
}
</script>

<template>
    <main class="relative border-collapse border-[5px] gap-y-4 flex flex-col" v-if="products">
        <div class="text-left font-bold text-[24px]">Product Detail</div>
        <div class="flex w-full" v-for="product in products" :key="product._id">
            <div class="w-[200px] h-[180px] rounded-full border-2 flex justify-center items-center">
                <img class="w-[70px] h-[70px]" :src="'http://localhost:3001/'+product.imageUrl" alt="">
            </div>
            <div class="w-full text-left p-2 flex-col flex justify-between">
                <span>Title: {{ product.title }}</span>
                <span>Category: {{ product.category["name"] }}</span>
                <span>Item: {{ product.item["name"] }}</span>
                <span>Description: No description</span>
            </div>
        </div>

        <div class="w-full ">
            <div class="flex justify-between">
                <div>Product Prices</div>
                <button class="hover:text-green-600 hover:font-bold p-2 border-[2px]" @click="onSelectProduct()">Add new price</button>
            </div>
            <div>
                <table class=" w-full border-collapse text-left border-[1px]" v-for="product in products" :key="product._id">
                    <tr class="bg-gray-200">
                        <th>Prices</th>
                        <th>Source</th>
                        <th>Action</th>
                    </tr>
                    <tr v-for="prices in product.prices">
                        <td class="pl-2">{{ prices.price }}$</td>
                        <td>{{ prices.source }}</td>
                        <td class="flex flex-col">
                            <button class="text-blue-500">Edit</button>
                            <button class="text-blue-500">Delete</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div
      v-if="priceModalShown && selectedProduct"
      class="
        flex
        justify-center
        items-center
        absolute
        top-0
        left-0
        bottom-0
        right-0
      "
    >
      <div class="w-72 h-96 bg-white rounded-lg shadow-md">
        <form @submit="onAddPrice" method="post">
          <div class="h-full w-full flex flex-col">
            <div class="w-full flex flex-grow p-2">
              <div class="w-full flex flex-col space-y-3">
                <div class="border">
                  <input
                    required
                    v-model="price"
                    class="w-full h-10 px-1"
                    type="number"
                    placeholder="Price"
                  />
                </div>
                <div class="border">
                  <input
                    required
                    v-model="source"
                    class="w-full h-10 px-1"
                    type="text"
                    placeholder="Source"
                  />
                </div>
              </div>
            </div>
            <div class="flex flex-grow-0 py-1 justify-center space-x-2">
              <button
                v-on:click="priceModalShown = false"
                class="
                  p-2
                  px-3
                  text-gray-500
                  rounded-md
                  cursor-pointer
                  border border-gray-100
                "
              >
                Cancel
              </button>
              <button
                type="submit"
                class="
                  bg-blue-500
                  p-2
                  px-3
                  text-white
                  rounded-md
                  cursor-pointer
                "
              >
                Add
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    </main>
    <main v-else>
        Loading...
    </main>
</template>
