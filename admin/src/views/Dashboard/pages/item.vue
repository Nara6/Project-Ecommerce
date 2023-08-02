<script >
import axios from 'axios'
import Toastify from 'toastify-js';
export default {
  data() {
    return {
      categories: [],
      items: [],
      name: "",
      category_id: "",
      description: "",
      showModal: false
    };
  },
  methods: {
    
    async create() {
      const bodyData = JSON.stringify({
        name: this.name,
        description: this.description,
        category_id: this.category_id,
      })
      const res = await axios.post('/api/item/create',bodyData,{
        headers: {
          "Authorization": `Bearer ${localStorage.getItem("token")}`,
          'Content-Type': 'application/json'
        }
      })
      if(res.data.category){
        this.showModal = !this.showModal;
      }else{
        if(res.data.error.category_id){
          Toastify({
          text: res.data.error.category_id[0],
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
    }
  },
  async mounted() {
    const res = await axios.get('/api/item/read',{
      headers:{'Content-Type': 'application/json'}
    });
    const resCat = await axios.get('/api/category/read?limit=100',{
      headers:{'Content-Type': 'application/json'}
    });
    // console.log(resCat.data);
    this.categories = await resCat.data;
    this.items = await res.data;
  },
};
</script>

<template >
  <main>
    <div class="bg-gray-500 text-white py-2 text-lg text-center">
      <h1>Item</h1>
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
              <label for="">Name: </label>
              <input v-model="name" class="w-full p-2 border-2"
              type="text" placeholder="Ex: Phone" required>
              <label for="">Category: </label>
              <select v-model="category_id"
               class="w-full p-2 border-2">
                <option selected disabled value="">Select Category</option>
                <option v-for="category in categories" :key="category.id"
                 :value="category.id">{{ category.name }}</option>
              </select>
              <label for="">Description: </label>
              <input v-model="description" class="w-full p-2 border-2"
              type="text" placeholder="Ex: Phone" required>
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
          <div>
            <button 
            @click="toggleModal()"
            class="bg-blue-500 text-white p-1 px-2 rounded-md">
              Add new
            </button>
          </div>
    </div>
    <div>
      <table id="customers">
        <tr class="bg-gray-200">
          <th>Name</th>
          <th>Category</th>
          <th>Description</th>
        </tr>

        <tr v-for="item in items" :key="item.name">
          <td>{{ item.name }}</td>
          <td class="font-bold">{{ item.category.name }}</td>
          <td>{{ item.description }}</td>
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