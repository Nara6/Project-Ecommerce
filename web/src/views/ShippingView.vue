<script>
import axios from 'axios'
export default {
  data() {
    return {
      user: '',
      shippingMethods: [
      { value: 'UPS Ground', label: 'UPS Ground', fee: 2.22 },
      { value: 'UPS 3 Days select', label: 'UPS 3 Days select', fee: 5.22 },
      { value: 'UPS 2nd Days Air', label: 'UPS 2nd Days Air', fee: 6.22 },
      { value: 'UPS Next Day Air', label: 'UPS Next Day Air', fee: 10.22 },
      ],
      subtotal: '',
      shipping_fee:'',
      tax: '',
      selectedShippingMethod: 'UPS Ground',
      selectedShippingFee: 2.22,
      address: '',
    }
  },
  async mounted() {
    const user = await axios.get('/api/me', {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            });
            console.log(user.data);
            if (user.data.success===false) {
                Toastify({
                text: user.data.status,
                backgroundColor: "red",
                duration: 3000, // 3 seconds
                close: true,
                }).showToast();
                this.$router.push({ path: '/auth/login' });
            } else {
                this.user = user.data.user;
            }
    if(localStorage.getItem('shipping_info')){
      this.selectedShippingMethod = (JSON.parse(localStorage.getItem('shipping_info'))).shippingMethod;
    }
    if(localStorage.getItem('shipping_address')){
      this.address = (JSON.parse(localStorage.getItem('shipping_address'))).address;
    }
    this.subtotal = localStorage.getItem('subtotal');
  },
  methods: {
    SaveToLocal(){
      // localStorage.setItem("shipping_method", this.selectedShippingMethod);
      localStorage.setItem("shipping_info", JSON.stringify({
        shippingMethod: this.selectedShippingMethod,
        totalPrice: this.calculateTotal(),
        shippingFee: this.selectedShippingFee,
        tax: this.totalTax(),
      }))
    },
    totalTax() {
    // Calculate the total tax based on the subtotal (3% tax rate)
    const taxRate = 0.005; // 0.5% tax rate
    const totalTax = this.subtotal * taxRate;
    return totalTax.toFixed(2); // Return the total tax with two decimal places
    },
    calculateTotal(){
      return (parseFloat(this.totalTax())+parseFloat(this.selectedShippingFee)+parseFloat(this.subtotal));
    }
  },
  watch: {
    selectedShippingMethod(newValue, oldValue) {
      // Update the selectedShippingFee whenever selectedShippingMethod changes
      const selectedMethod = this.shippingMethods.find(method => method.value === newValue);
      this.selectedShippingFee = selectedMethod.fee ? selectedMethod.fee : null;
    },
  },
}
</script>

<template>
    <div class="w-full p-[50px]">
        <div class="pb-4 flex items-center">
            <span class="text-[20px] font-[600] text-blue-400">Shopping Cart</span> 
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1668 28.3333C14.1668 29.0074 14.5729 29.6152 15.1957 29.8731C15.8185 30.1311 16.5353 29.9885 17.012 29.5119L25.3453 21.1785C25.9962 20.5276 25.9962 19.4724 25.3453 18.8215L17.012 10.4882C16.5353 10.0115 15.8185 9.8689 15.1957 10.1269C14.5729 10.3848 14.1668 10.9926 14.1668 11.6667V28.3333Z" fill="black"/>
            </svg>
            <span class="text-[20px] font-[600] text-blue-400">Customer Information</span> 
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1668 28.3333C14.1668 29.0074 14.5729 29.6152 15.1957 29.8731C15.8185 30.1311 16.5353 29.9885 17.012 29.5119L25.3453 21.1785C25.9962 20.5276 25.9962 19.4724 25.3453 18.8215L17.012 10.4882C16.5353 10.0115 15.8185 9.8689 15.1957 10.1269C14.5729 10.3848 14.1668 10.9926 14.1668 11.6667V28.3333Z" fill="black"/>
            </svg>
            <span class="text-[20px] font-[600]">Shipping Information</span> 

        </div>
        <div class="relative w-full m-auto ">
            <div class=" w-[65%] absolute left-0 flex flex-col border-t-[1px] pl-0 gap-y-4 ">
              <div class="w-full border-b-[1px] flex flex-col gap-y-4 pb-3">
                <div class="flex justify-between pt-4">
                  <div class="text-[20px] font-[600]">Shipping information 
                    <span class="text-[16px] text-blue-400"> - {{ address }}</span>
                  </div>
                  <div class="text-[20px] text-blue-500 underline">Edit
                  </div>
                </div>
              </div>
              <div class="flex flex-col">
                <span class="text-[20px] font-[600]">Shipping method</span>
                <form action="" class="p-3 pb-5 border-b-[1px]">
                  <fieldset class="flex gap-y-1 flex-col">
                    <!-- Radio buttons with shipping methods -->
                    <div v-for="method in shippingMethods" :key="method.value" class="flex justify-between">
                      <div class="flex gap-x-3">
                        <input type="radio" :value="method.value" v-model="selectedShippingMethod" name="default-radio">
                        <label for="">{{ method.label }}</label>
                      </div>
                      <div>${{ method.fee.toFixed(2) }}</div>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="flex gap-x-[330px] pt-4">
                  <router-link to="/cart/checkout" class="w-full ">
                    <div class="p-3.5 text-white rounded-[20px] font-bold bg-blue-400 
                    flex gap-x-1 drop-shadow-[10px_4px_4px_rgba(0,0,0,0.25)] justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M8.38268 3.07609C8.75636 3.23087 9 3.59551 9 3.99997V6.5H15.5C16.9587 6.5 18.3576 7.07946 19.3891 8.11091C20.4205 9.14236 21 10.5413 21 12V20C21 20.5523 20.5523 21 20 21H19C18.4477 21 18 20.5523 18 20V12C18 11.337 17.7366 10.7011 17.2678 10.2322C16.7989 9.76339 16.163 9.5 15.5 9.5H9V12C9 12.4044 8.75636 12.7691 8.38268 12.9238C8.00901 13.0786 7.57889 12.9931 7.29289 12.7071L3.29289 8.70707C2.90237 8.31655 2.90237 7.68339 3.29289 7.29286L7.29289 3.29286C7.57889 3.00686 8.00901 2.92131 8.38268 3.07609Z" fill="white"/>
                    </svg>
                    <span>Customer info</span>
                  </div>
                  </router-link>
                  <router-link to="/cart/payment" class="w-full" @click="SaveToLocal()">
                    <div class="p-3.5 text-white rounded-[20px] font-bold bg-black
                    w-full flex drop-shadow-[10px_4px_4px_rgba(0,0,0,0.25)] justify-center">
                    <span>Continues to Pay</span>
                  </div>
                  </router-link>
                  
              </div>
            </div>
            <div v-if="subtotal" class="absolute right-0 flex w-[30%] h-[350px] p-4 border-[1px] flex-col bg-[#F5F5F5]">
                <div class="text-[20px] border-b-[1px] w-full font-bold">
                    Summary (1Item)
                </div>
                <div class="flex flex-col pt-4 pb-4 gap-y-4 border-b-[1px]">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>${{ subtotal }}</span>

                    </div>
                    <div class="flex justify-between">
                        <span>Shipping</span>
                        <span>${{ selectedShippingFee }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Est. Taxes</span>
                        <span>${{ totalTax() }}</span>
                    </div>
                </div>
                <div class="flex justify-between pt-4 pb-6 border-b-[1px]">
                    <span>Total</span>
                    <span>${{ calculateTotal() }}</span>
                </div>
                <div class="flex justify-center pb-2 w-full gap-x-4 pt-4">
                    <input type="text" placeholder="Apply promo code"
                    class="w-[70%] p-2 border-[2px] pl-5 drop-shadow-[10px_4px_4px_rgba(0,0,0,0.25)] "
                    >
                    <button class="w-[30%] p-2 bg-black text-white">Apply</button>
                </div>
            </div>
            <div v-if="!subtotal" class="absolute right-0 flex w-[30%] h-[350px] p-4 border-[1px] flex-col bg-[#F5F5F5]">
              <div class="w-full h-full flex justify-center items-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-[#333]"></div>
            </div>
            </div>
        </div>
    </div>
</template>