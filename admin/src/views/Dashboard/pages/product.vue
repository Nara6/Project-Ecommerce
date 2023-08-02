<script >
import axios from "axios"
import Toastify from 'toastify-js';

export default {
  data() {
    return {
      categories: [],
      items: [],
      products: [],
      productDesc: '',
      title: "",
      image_url: "",
      description: "",
      category_id: "",
      item_id: "",
      showModal: false,
      note: '',
      price: '',
    };
  },
  watch:{
    async category_id(newValue, oldValue){
      const resCat = await axios.get(`/api/category/read/${newValue}`,{
        headers:{'Content-Type': 'application/json'}
      });
      this.items = await resCat.data[0].item;
      console.log(this.items);
    }
  },
  methods: {
    showToast(msg){
      Toastify({
        text: msg,
        backgroundColor: "red",
        duration: 3000, // 3 seconds
        close: true,
      }).showToast();
    },
    toggleModal: function(){
      this.showModal = !this.showModal;
    },
    async create() {
      var bodyData = new FormData();
      bodyData.append("title", this.title);
      bodyData.append("description", this.description);
      bodyData.append("item_id", this.item_id);
      bodyData.append("price", this.price);
      bodyData.append("category_id", this.category_id);
      bodyData.append("image_url", this.image_url);
      bodyData.append("note", this.note);
      // console.log(bodyData.getAll());
      const res = await axios.post('/api/product/create',bodyData,{
        headers: {
          "Authorization": `Bearer ${localStorage.getItem("token")}`,
          'Content-Type': 'multipart/form-data'
        }
      })
      console.log(res.data);
      if(res.data.product){
        this.showToast("Product Created Successfully");
        this.showModal = !this.showModal;
        const res = await axios.get('/api/product/read?limit=100',{
          headers:{'Content-Type': 'application/json'}
        });
        // console.log(res.data);
        this.products = await res.data;
        this.productDesc = this.products.map((product) => {
          const descriptionArray = product.description.split(',');
          return {...product, descriptionArray};
        });
      }else{
        if(res.data.errors.title){
          this.showToast(res.data.errors.title[0]);
        }
        if(res.data.errors.description){
          this.showToast(res.data.errors.description[0]);
        }
        if(res.data.errors.category_id){
          this.showToast(res.data.errors.category_id[0]);
        }
        if(res.data.errors.item_id){
          this.showToast(res.data.errors.item_id[0]);
        }
        if(res.data.errors.note){
          this.showToast(res.data.errors.note[0]);
        }
        if(res.data.errors.price){
          this.showToast(res.data.errors.price[0]);
        }

      }
    },
    handleFileUpload(e){
      this.image_url = e.target.files[0];
      // console.log(this.imageUrl);
    },
  },

  async mounted() {
    const res = await axios.get('/api/product/read?limit=100',{
      headers:{'Content-Type': 'application/json'}
    });
    // console.log(res.data);
    this.products = await res.data;
    // console.log(this.products);
    this.productDesc = this.products.map((product) => {
      const descriptionArray = product.description.split(',');
      return {...product, descriptionArray};
    });
    // console.log(this.productDesc);
    const resCat = await axios.get('/api/category/read?limit=100',{
      headers:{'Content-Type': 'application/json'}
    });
    this.categories = await resCat.data;
  },
};
</script>


<template >
  <main class="relative">
    <div class="bg-gray-500 text-white py-2 text-lg text-center">
      <h1>Products</h1>
    </div>
    <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
      <div class="relative w-[50%] my-6 mx-auto max-w-lg">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
            <h3 class="text-3xl font-semibold">
              Create New Category
            </h3>
          </div>
          <!--body-->
          <div class="relative justify-center p-6 flex">
            <div class="w-[90%] gap-1 text-left flex flex-col">
              <label for="">Title: </label>
              <input v-model="title" class="w-full p-2 border-2"
              type="text" placeholder="Ex: Phone" required>
              <label for="">Price: </label>
              <input v-model="price" class="w-full p-2 border-2"
              type="text" placeholder="899" required>
              <label for="">Category: </label>
              <select v-model="category_id"
               class="w-full p-2 border-2">
                <option selected disabled value="">Select Category</option>
                <option v-for="category in categories" :key="category.id"
                 :value="category.id">{{ category.name }}</option>
              </select>
              <label for="">Sub-Category: </label>
              <select v-model="item_id"
               class="w-full p-2 border-2">
                <option selected disabled value="">Select Sub-Category</option>
                <option v-for="item in items" :key="item.id"
                 :value="item.id">{{ item.name }}</option>
              </select>
              <label for="">Description: </label>
              <input v-model="description" class="w-full p-2 border-2"
              type="text" placeholder="Lorem ipsum dolor, sit amet consectetur, adipisicing elit, Consecteturquaera" required>
              <label for="">Note: </label>
              <input v-model="note" class="w-full p-2 border-2"
              type="text" placeholder="Lorem ipsum dolor, sit amet consectetur, adipisicing elit, Consecteturquaera" required>
              <label for="">File: </label>
              <input type="file"
              @change="handleFileUpload($event)"
              >
            </div>
          </div>
          <!--footer-->
          <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
            <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" v-on:click="toggleModal()">
              Close
            </button>
            <button class="bg-green-500 text-white rounded background-transparent font-bold uppercase px-6 py-3 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" @click="create()">
              Save Changes
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    <div class="py-2">
      <button
        @click="toggleModal()"
        type="submit"
        class="bg-blue-500 text-white p-1 px-2 rounded-md"
      >
        Add new
      </button>
    </div>
    <div>
      <table id="customers">
        <tr class="bg-gray-200">
          <th>Title</th>
          <th>Prices</th>
          <th>Category</th>
          <th>Sub-Category</th>
          <th>ImageURL</th>
          <th>Description</th>
          <th>Action</th>
        </tr>

        <tr v-for="product in productDesc" :key="product._id">
          <td>{{ product.title }}</td>
          <td>
            ${{ product.price }}
          </td>
          <td>{{ product.category?.name }}</td>
          <td>{{ product.item?.name }}</td>
          <td class="flex justify-center"><img class="w-[100px] h-[100px]"
            :src="'/image'+product.image_url" alt=""></td>
          <td>
            <ul class="list-disc list-inside text-left" v-for="(des,index) in product.descriptionArray" :key="index">
              <li>{{des}}</li>
            </ul>
          </td>
          <td>
            <div class="flex flex-col space-y-2">
              <button class="hover:text-green-600 hover:font-bold">Edit</button>
              <button class="hover:text-green-600 hover:font-bold">
                Delete
              </button>
            </div>
          </td>
        </tr>
      </table>
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
            <div class="flex flex-grow-0 relative p-2 py-3">
              <div class="font-bold text-center w-full">
                {{ selectedProduct?.title }}
              </div>
            </div>
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
</template>

<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td,
#customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even) {
  background-color: #f2f2f2;
}

#customers tr:hover {
  background-color: #ddd;
}
</style>