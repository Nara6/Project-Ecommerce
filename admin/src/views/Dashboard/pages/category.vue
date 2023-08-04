<script >
import axios from 'axios';
import Toastify from 'toastify-js';

export default {
  data() {
    return {
      categories: [],
      name: "",
      description: "",
      image_url: "",
      showModal: false,
      showModalDelete: false,
      showDeleteButton: null,
      category_id: ''
    };
  },
  methods: {
    handleFileUpload(e){
      this.image_url = e.target.files[0];
      console.log(this.image_url);
    },
    async create() {
      // e.preventDefault();
      var bodyData = new FormData();
      bodyData.append('name', this.name);
      bodyData.append('description', this.description);
      bodyData.append('image_url', this.image_url);

      const res = await axios.post('/api/category/create',bodyData,{
        headers: {
          "Authorization": `Bearer ${localStorage.getItem("token")}`,
          'Content-Type': 'multipart/form-data'
        }
      })
      // console.log(res.data);
      if(res.data.category){
        this.showModal = !this.showModal;
        const res = await axios.get('/api/category/read?limit=100',{
          headers:{'Content-Type': 'application/json'}
        });
        this.categories = await res.data;
        this.name=this.description='';
      }else{
        if(res.data.error.image_url){
          Toastify({
          text: res.data.error.image_url[0],
          backgroundColor: "red",
          duration: 3000, // 3 seconds
          close: true,
        }).showToast();
        }else if(res.data.error.name){
          Toastify({
          text: res.data.error.name[0],
          backgroundColor: "red",
          duration: 3000, // 3 seconds
          close: true,
          }).showToast();
        }else if(res.data.error.description){
          Toastify({
          text: res.data.error.description[0],
          backgroundColor: "red",
          duration: 3000, // 3 seconds
          close: true,
          }).showToast();
        }
      }
    },
    toggleModal: function(){
      this.showModal = !this.showModal;
    },
    toggleModalDelete: function(id){
      this.category_id=id;
      this.showModalDelete = !this.showModalDelete;
    },
    async deleteCategory(){
      const res = await axios.delete(`/api/category/remove/${this.category_id}`)
      if(res.data.status==='success'){
        Toastify({
          text: await res.data.message,
          backgroundColor: "blue",
          duration: 3000, // 3 seconds
          close: true,
        }).showToast();
        const rescat = await axios.get('/api/category/read?limit=100',{
          headers:{'Content-Type': 'application/json'}
        });
        this.categories = await rescat.data;
        this.showModalDelete = !this.showModalDelete;
      }else{
        Toastify({
          text: await res.response.data.message,
          backgroundColor: "red",
          duration: 3000, // 3 seconds
          close: true,
        }).showToast();
      }
    },

  },
  async mounted() {
    // this.categories = await categoryApi.all();
    const res = await axios.get('/api/category/read?limit=100',{
      headers:{'Content-Type': 'application/json'}
    });
    this.categories = await res.data;
  },
};
</script>

<template >
  <main>
    <div class="bg-gray-500 text-white py-2 text-lg text-center">
      <h1>Category</h1>
    </div>
    <div>
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
              <label for="">Name: </label>
              <input v-model="name" class="w-full p-2 border-2"
              type="text" placeholder="Ex: Phone" required>
              <label for="">Description: </label>
              <input v-model="description" class="w-full p-2 border-2"
              type="text" placeholder="Ex: Phone" required>
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
    <div v-if="showModalDelete" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
      <div class="relative w-[50%] my-6 mx-auto max-w-lg">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
            <h3 class="text-3xl font-semibold">
              Delete Confirmation
            </h3>
          </div>
          <!--body-->
          <div class="relative justify-center p-6 flex text-1xl">
            Are you sure you want to delete this category?
          </div>
          <!--footer-->
          <div class="flex items-center justify-around p-6 border-t border-solid border-slate-200 rounded-b">
            <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" v-on:click="toggleModalDelete()">
              Close
            </button>
            <button 
            class="bg-green-500 text-white rounded
             background-transparent font-bold uppercase
              px-8 py-3 text-sm outline-none focus:outline-none
              mr-1 mb-1 ease-linear transition-all duration-150"
              @click="deleteCategory()">
              Yes
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModalDelete" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>
    <div class="py-2">
      <button
        @click="toggleModal()"
        class="bg-blue-500 text-white p-1 px-2 rounded-md"
      >
        Add new
      </button>
     
    </div>
    <div>
      <table id="customers">
        <tr class="bg-gray-200">
          <th>Name</th>
          <th>Description</th>
          <th>ImageURL</th>
        </tr>

        <tr 
        @mouseover="showDeleteButton = cate.id"
        @mouseleave="showDeleteButton = null"
        v-for="cate in categories" :key="cate.name">
          <td>{{ cate.name }}</td>
          <td>{{ cate.description }}</td>
          <td class="flex justify-center relative w-full">
            <div>
              <img class="w-[100px] h-fit" 
              :src="'/image'+cate.image_url" alt=""
              :style="{ 'filter': showDeleteButton === cate.id ? 'blur(4px)' : 'none' }"
              >
            </div>
            <button
              v-if="showDeleteButton === cate.id"
              class="absolute top-[50%] left-[50%]
              transform -translate-x-1/2 -translate-y-1/2
              bg-red-500 hover:bg-red-600
              backdrop-filter backdrop-blur-lg
              text-white px-4 py-2 rounded"
              @click="toggleModalDelete(cate.id)"
            >
            Delete
            </button>
          </td>
        </tr>
      </table>
    </div>
  </main>
</template>

<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  overflow-y: auto;
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
