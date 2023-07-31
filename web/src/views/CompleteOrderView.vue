<script>
import axios from 'axios'
export default {
  data() {
    return {
      order: '',
      user: '',
      lastDigit: '',
    }
  },
  async mounted(){
    const order_id = localStorage.getItem('order_id');
    const orders = await axios.get(`/api/order/read/${order_id}`);
    this.order = await orders.data[0];
    localStorage.removeItem('order_id');
    this.lastDigit = this.order.card_number.slice(-4);
    console.log(this.lastDigit);
    const user = await axios.get('/api/me', {
        headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`
        }
    });
      // console.log(user.data);
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
  },

}
</script>

<template>

    <div class="w-full p-[50px]">
      <div class="flex pb-4 border-b-[1px]">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M4.16699 50C4.16699 24.687 24.6873 4.16667 50.0003 4.16667C75.3134 4.16667 95.8337 24.687 95.8337 50C95.8337 75.3131 75.3134 95.8333 50.0003 95.8333C24.6873 95.8333 4.16699 75.3131 4.16699 50ZM76.7328 40.4335C78.3564 38.8029 78.3508 36.1647 76.7201 34.541L73.7675 31.6011C72.1368 29.9774 69.4986 29.9831 67.8749 31.6138L43.8267 55.7659L29.9888 42.1206C28.3503 40.5049 25.7121 40.5233 24.0964 42.1619L21.1708 45.1287C19.5551 46.7673 19.5736 49.4054 21.2121 51.0212L40.955 70.4893C42.5879 72.0995 45.2151 72.0875 46.8332 70.4624L76.7328 40.4335Z" fill="#5CA3E4"/>
        </svg>
        <div class="flex flex-col justify-center gap-y-4 font-semibold">
          <p>Order number {{ order.id }}</p>
          <p>Thank you!, {{ user.username }}</p>
        </div>
      </div>
      <div class="pt-4 pb-4 font-semibold border-b-[1px]">
        <div>Your order is confirmed.</div>
        <div>We have proceed your order and we’re getting it ready.</div> 
      </div>
      <div class="pt-4 pb-5 flex-col gap-y-4 border-b-[1px]">
        <span class="text-[24px] font-semibold">Customer information</span>
        <div class="flex justify-between">
          <div class="flex flex-col pt-3">
            <span class="text-[18px] font-semibold">Shipping address</span>
            <span class="text-[18px] font-semibold text-blue-400">{{ order.shipping_address }}</span>
          </div>
          <div class="flex flex-col pt-3 w-[30%]">
            <span class="text-[18px] font-semibold">Billing address</span>
            <span class="text-[18px] font-semibold text-blue-400">{{ order.billing_address }}</span>
          </div>
        </div>
        <div class="flex justify-between">
          <div class="flex flex-col pt-3 ">
            <span class="text-[18px] font-semibold">Shipping method</span>
            <span class="text-[18px] font-semibold text-blue-400">{{ order.shipping_method }}</span>
          </div>
          <div class="flex flex-col pt-3 w-[30%]">
            <span class="text-[18px] font-semibold">Payment method</span>
            <div class="flex">
              <svg xmlns="http://www.w3.org/2000/svg" width="78" height="27" viewBox="0 0 78 27" fill="none">
                <path d="M33.8 26.6106H27.4814L31.4335 0.473877H37.7517L33.8 26.6106Z" fill="#00579F"/>
                <path d="M56.7059 1.1128C55.4596 0.583965 53.4828 6.10352e-05 51.0386 6.10352e-05C44.7989 6.10352e-05 40.4049 3.55892 40.3779 8.64701C40.3261 12.401 43.5239 14.486 45.9156 15.7377C48.3601 17.0168 49.1911 17.8516 49.1911 18.9917C49.1662 20.7427 47.2158 21.5498 45.3966 21.5498C42.874 21.5498 41.5223 21.1337 39.4682 20.1595L38.6361 19.7419L37.752 25.609C39.2339 26.3312 41.9642 26.972 44.7989 27.0001C51.4287 27.0001 55.745 23.4963 55.7961 18.0741C55.8213 15.0988 54.1328 12.819 50.4923 10.956C48.2824 9.76012 46.929 8.95374 46.929 7.73013C46.9549 6.61776 48.0737 5.47841 50.5684 5.47841C52.6225 5.4226 54.1317 5.9507 55.2751 6.47917L55.8465 6.75671L56.7059 1.1128Z" fill="#00579F"/>
                <path d="M65.103 17.3513C65.6233 15.8498 67.6256 10.0384 67.6256 10.0384C67.5994 10.0942 68.1449 8.5092 68.4569 7.53615L68.8985 9.78825C68.8985 9.78825 70.0951 16.0445 70.3549 17.3513C69.3674 17.3513 66.351 17.3513 65.103 17.3513ZM72.9024 0.473877H68.015C66.5079 0.473877 65.3628 0.946174 64.7125 2.64245L55.3271 26.6102H61.957C61.957 26.6102 63.0485 23.3843 63.2831 22.6896C64.0104 22.6896 70.4599 22.6896 71.3956 22.6896C71.577 23.6072 72.1495 26.6102 72.1495 26.6102H77.9999L72.9024 0.473877Z" fill="#00579F"/>
                <path d="M22.2034 0.473877L16.0155 18.2966L15.3393 14.682C14.1953 10.5111 10.6074 5.97957 6.60352 3.72637L12.2714 26.5829H18.9531L28.8848 0.473877H22.2034Z" fill="#00579F"/>
                <path d="M10.2699 0.473877H0.104001L0 1.00198C7.93005 3.17092 13.182 8.39907 15.3398 14.6831L13.1298 2.67091C12.766 1.00161 11.6479 0.528941 10.2699 0.473877Z" fill="#FAA61A"/>
              </svg>
              <span class="text-[18px] font-semibold text-blue-400">Ending in {{ lastDigit }} - {{order.total_price}}$</span>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>