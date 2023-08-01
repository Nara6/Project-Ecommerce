<script>
import axios from 'axios'
export default {
    data() {
        return {
            user: [],
            cart: '',
            products: [],
            cartData: {},
            loading: true,
            loading1: false,
        }
    },
    async mounted() {
        try {
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

            const cart = await axios.get(`/api/cart/read?user_id=${this.user.id}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            });

            this.cart = cart.data;
            this.loading = false; // Set loading to false once data is fetched
        } catch (error) {
            console.error('Error fetching data:', error);
            this.loading = false; // Set loading to false in case of an error as well
        }

    },
    computed: {
        uniqueCartItems() {
        // Create a new Set to store unique product ids
        const uniqueProductIds = new Set();
        const uniqueCartItems = [];
        this.cart.forEach(cartItem => {
            const productId = cartItem.product.id;
            if (!uniqueProductIds.has(productId)) {
            uniqueProductIds.add(productId);
            cartItem.showDeleteButton = false;
            uniqueCartItems.push(cartItem);
            }
        });
        this.cart.forEach(cartItem => {
            cartItem.quantity = 1;
        });

        return uniqueCartItems;
        }
    },
    methods: {
        async RemoveCart(id){
            this.loading1 = true;
            const cart = await axios.delete(`/api/cart/remove/${id}`,{
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            });
            if(cart.data.status==='success'){
                alert('Removed from your shopping cart');
                const cart = await axios.get(`/api/cart/read?user_id=${this.user.id}`,{
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem("token")}`
                    }
                });
                this.cart = await cart.data;
                this.loading1=false;
            }
        },
        calculateSubtotal() {
            let subtotal = 0;

            // Iterate through the uniqueCartItems array and calculate the subtotal for each cart item
            this.uniqueCartItems.forEach(cartItem => {
                const price = cartItem.product.price;
                const quantity = cartItem.quantity || 1; // Use 1 as the default quantity if not set

                subtotal += price * quantity;
            });
            return subtotal.toFixed(2); // Return the subtotal with two decimal places
        },
        showErrorToast(message) {
            Toastify({
                text: message,
                backgroundColor: "red",
                canTimeout: true,
                duration: 3000, // 3 seconds
                close: true,
            }).showToast();
        },
        saveCartToLocalStorage() {
            console.log(this.cart);
        // Convert the cart array to JSON and save it to localStorage
            if(this.cart.length > 0) {
                localStorage.setItem("cart", JSON.stringify(this.cart));
                localStorage.setItem("subtotal", this.calculateSubtotal());
                this.$router.push({name: 'checkout'})
            }else{
                this.showErrorToast("You don't have any cart yet!");
            }
            
        },
    },
    watch: {
    // Watch for changes in the quantity property of cart items
        "cart": {
        deep: true,
        handler(newVal, oldVal) {
            // Check if the quantity of any cart item is less than 0
            const invalidQuantityItem = newVal.find(cartItem => cartItem.quantity < 0);
            if (invalidQuantityItem) {
            // Display the toast notification
            Toastify({
                text: "Quantity cannot be less than 0.",
                backgroundColor: "red",
                duration: 3000, // 3 seconds
                close: true,
            }).showToast();
            // Set the quantity back to 1 for the cart item with an invalid quantity
            invalidQuantityItem.quantity = 1;
            }
        },
        },
    },

}
</script>

<template>

    <div class="w-full p-[50px]" v-if="user && cart">
        
        <div class="text-[20px] font-[600] pb-4">
            Shopping Cart
        </div>
        <div class="relative w-full m-auto">
            <table class=" w-[65%] pt-7 absolute left-0">
                <tr class="w-full text-left
                 border-t-[2px] border-b-[2px] font-bold">
                    <th class="p-4 ">Items</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                 </tr>
                <tr class="w-full
                  font-bold " v-for="carts in uniqueCartItems" :key="carts.product.title">
                    <td>
                        <img :src="'/image'+carts.product.image_url" alt="" class="w-[100px] h-[100px]">
                    </td>
                    <td>{{ carts.product.title }}</td>
                    <td>
                        <input type="number" v-model="carts.quantity" class="w-[70px] h-[50px] bg-[#EEEEEE] p-3">
                    </td>
                    <td>$ {{ carts.product.price }}</td>
                    <td class="text-[20px] text-red-500 cursor-pointer" @click="RemoveCart(carts.id)" v-if="!loading1">x</td>
                </tr>
                <!-- <div v-if="loading1" class="border-t-4 border-blue-500 border-solid rounded-full h-[20px] w-[20px] animate-spin"></div> -->
                
            </table>
            <div class="absolute right-0 flex w-[30%] h-[350px] p-4 border-[1px] flex-col bg-[#F5F5F5]">
                <div class="text-[20px] border-b-[1px] w-full font-bold">
                    Summary ({{uniqueCartItems.length}}Item)
                </div>
                <div class="flex flex-col pt-4 pb-4 gap-y-4 border-b-[1px]">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>${{calculateSubtotal()}}</span>

                    </div>
                    <div class="flex justify-between">
                        <span>Shipping</span>
                        <span>-</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Est. Taxes</span>
                        <span>-</span>
                    </div>
                </div>
                <div class="flex justify-between pt-4">
                    <span>Total</span>
                    <span>${{ calculateSubtotal() }}</span>
                </div>
                <div class="flex justify-center pt-6 pb-2">
                    <button class="w-[200px] p-3 bg-black text-[15px] text-white font-bold rounded-[20px]" @click="saveCartToLocalStorage">Continues Checkout</button>
                </div>
            </div>
        </div>
        <div v-if="loading" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-75 bg-gray-300">
            <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-[#333]"></div>
        </div>
        
    </div>

</template>
<style>

</style>