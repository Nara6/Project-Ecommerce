<template>

    <div class="w-full p-[50px]">
        
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
                  font-bold ">
                    <td>
                        <img src="../assets/images/iphone.png" alt="" class="w-[150px] h-[150px]">
                    </td>
                    <td>Iphone 14 pro max</td>
                    <td>
                        <input type="number" value="1" class="w-[70px] h-[50px] bg-[#EEEEEE] p-3">
                    </td>
                    <td>$ 999.99</td>
                </tr>
                <tr class="w-full
                 font-bold ">
                    <td>
                        <img src="../assets/images/iphone.png" alt="" class="w-[150px] h-[150px]">
                    </td>
                    <td>Iphone 14 pro max</td>
                    <td>
                        <input type="number" value="1" class="w-[70px] h-[50px] bg-[#EEEEEE] p-3">
                    </td>
                    <td>$ 999.99</td>
                </tr>
                <tr class="w-full
                 font-bold ">
                    <td>
                        <img src="../assets/images/iphone.png" alt="" class="w-[150px] h-[150px]">
                    </td>
                    <td>Iphone 14 pro max</td>
                    <td>
                        <input type="number" value="1" class="w-[70px] h-[50px] bg-[#EEEEEE] p-3">
                    </td>
                    <td>$ 999.99</td>
                </tr>
                
            </table>
            <div class="absolute right-0 flex w-[30%] h-[350px] p-4 border-[1px] flex-col bg-[#F5F5F5]">
                <div class="text-[20px] border-b-[1px] w-full font-bold">
                    Summary (1Item)
                </div>
                <div class="flex flex-col pt-4 pb-4 gap-y-4 border-b-[1px]">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>$999.99</span>

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
                    <span>$999.99</span>
                </div>
                <div class="flex justify-center pt-6 pb-2">
                    <router-link to="/cart/checkout">
                        <button class="w-[200px] p-3 bg-black text-[15px] text-white font-bold rounded-[20px]">Continues Checkout</button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>

</template>