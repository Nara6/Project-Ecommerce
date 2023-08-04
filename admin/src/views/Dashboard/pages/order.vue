<script >
import axios from "axios"
import Toastify from 'toastify-js';

export default {
  data() {
    return {
      orders: [],
      orderDetail: '',
      showModalViewDetail: null,
      order_id: '',
      showModal: false,

    };
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
    convertISO8601ToSimpleDateTime(isoDate) {
      // Parse the ISO 8601 date string and create a Date object
      const dateObject = new Date(isoDate);

      // Extract the individual components (year, month, day, hours, minutes, seconds) and ensure leading zeros if needed
      const year = dateObject.getFullYear();
      const month = String(dateObject.getMonth() + 1).padStart(2, '0');
      const day = String(dateObject.getDate()).padStart(2, '0');
      const hours = String(dateObject.getHours()).padStart(2, '0');
      const minutes = String(dateObject.getMinutes()).padStart(2, '0');
      const seconds = String(dateObject.getSeconds()).padStart(2, '0');

      // Construct the simple date-time format (MM/DD/YYYY HH:mm:ss)
      const simpleDateTimeFormat = `${month}/${day}/${year} ${hours}:${minutes}:${seconds}`;

      return simpleDateTimeFormat;
    },
    toggleModalViewDetail(){
      this.showModal = !this.showModal;
      this.orderDetail = ''
    },
    async viewDetail(id){
      const res = await axios.get(`/api/orderdetail/read/${id}`)
      this.orderDetail = await res.data[0];
      console.log(res.data);
    },
  },

  async mounted() {
    const res = await axios.get('/api/orderdetail/read',{
      headers:{'Content-Type': 'application/json'}
    });
    // console.log(res.data);
    this.orders = await res.data;
  },
};
</script>


<template >
  <main class="relative">
    <div class="bg-gray-500 text-white py-2 text-lg text-center">
      <h1>Order</h1>
    </div>
    <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
      <div class="relative w-[70%] my-6 mx-auto max-w-2lg">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
            <h3 class="text-3xl font-semibold">
              VIEW ORDER DETAIL
            </h3>
          </div>
          <!--body-->
          <div class="p-6 flex flex-col text-1xl gap-y-3" v-if="orderDetail">
            <div class="flex justify-center">
              <img class="w-[200px] h-fit"
              :src="'/image'+orderDetail.product.image_url" alt="">
            </div>
            <div class="flex justify-around text-blue-400 font-bold">
              <p class="w-full">ORDER ID</p>
              <p class="w-full">PRODUCT</p>
              <p class="w-full">QTY</p>
              <p class="w-full">BY</p>
            </div>
            <div class="flex justify-around font-bold">
              <p class="w-full">{{ orderDetail.order.id }}</p>
              <p class="w-full">{{orderDetail.product.title}}</p>
              <p class="w-full">{{orderDetail.quantity}}</p>
              <p class="w-full">{{orderDetail.order.cardholder_name}}</p>
            </div>
            <div class="flex justify-around text-blue-400 font-bold">
              <p class="w-full">SHIPPING ADRESS</p>
              <p class="w-full">SHIPPING CITY</p>
              <p class="w-full">SHIPPING COUNTRY</p>
              <p class="w-full">SHIPPING POSTALCODE</p>
            </div>
            <div class="flex justify-around font-bold">
              <p class="w-full">{{orderDetail.order.shipping_address}}</p>
              <p class="w-full">{{orderDetail.order.shipping_city}}</p>
              <p class="w-full">{{orderDetail.order.shipping_country}}</p>
              <p class="w-full">{{orderDetail.order.shipping_postalcode}}</p>
            </div>
            <div class="flex justify-around text-blue-400 font-bold">
              <p class="w-full">BILLING ADRESS</p>
              <p class="w-full">BILLING CITY</p>
              <p class="w-full">BILLING COUNTRY</p>
              <p class="w-full">BILLING POSTALCODE</p>
            </div>
            <div class="flex justify-around font-bold">
              <p class="w-full">{{orderDetail.order.billing_address}}</p>
              <p class="w-full">{{orderDetail.order.billing_city}}</p>
              <p class="w-full">{{orderDetail.order.billing_country}}</p>
              <p class="w-full">{{orderDetail.order.billing_postalcode}}</p>
            </div>
            <div class="flex justify-around text-blue-400 font-bold">
              <p class="w-full">SHIPPING METHOD</p>
              <p class="w-full">PAYMENT METHOD</p>
            </div>
            <div class="flex justify-around font-bold">
              <p class="w-full">{{orderDetail.order.shipping_method}}</p>
              <p class="w-full">{{orderDetail.order.card_type}}</p>
            </div>
           
          </div>
          <!--footer-->
          <div class="flex items-center justify-around p-6 border-t border-solid border-slate-200 rounded-b">
            <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" v-on:click="toggleModalViewDetail()">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    <div>
      <table id="customers">
        <tr class="bg-gray-200">
          <th>ORDER ID</th>
          <th>PRODUCT</th>
          <th>QTY</th>
          <th>ORDER BY</th>
          <th>PRICE</th>
          <th>DATE TIME</th>
        </tr>

        <tr 
        @mouseover="showModalViewDetail = order.id"
        @mouseleave="showModalViewDetail = null"
        v-for="order in orders" :key="order._id">
          <td class="text-blue-700 font-bold">
            #00000{{ order.order.id }}
          </td>
          <td>
            {{ order.product.title }}
          </td>
          <td>
            {{ order.quantity }}
          </td>
          <td class="font-bold">
            @{{ order.order.cardholder_name }}
          </td>
          <td class="text-red-600 font-bold">
            $ {{ order.price }}
          </td>
          <td>
            <div class="relative">
              <p class="text-green-600 font-bold"
              :style="{ 'filter': showModalViewDetail === order.id ? 'blur(4px)' : 'none' }"
              >
                {{ convertISO8601ToSimpleDateTime(order.created_at) }}
              </p>
              <button
              v-if="showModalViewDetail === order.id"
              class="absolute top-[50%] left-[50%]
              transform -translate-x-1/2 -translate-y-1/2
              bg-green-500 hover:bg-green-400
              backdrop-filter backdrop-blur-lg
              text-white px-4 py-2 rounded"
              @click="toggleModalViewDetail(); viewDetail(order.id) "
              >
              View Details
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