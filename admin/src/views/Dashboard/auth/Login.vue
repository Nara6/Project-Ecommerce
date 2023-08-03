<script>
import axios from 'axios'
import Toastify from 'toastify-js';
export default {
    name:'login',
    data(){
        return{
            email:'yinsoknara@gmail.com',
            password:'123456',
            loading: false,
        }
    },
    methods: {
        showSuccessToast(message) {
            Toastify({
                text: message,
                type: "success",
                backgroundColor: "blue",
                canTimeout: true,
                duration: 3000, // 3 seconds
                close: true,
            }).showToast();
            },
            // Function to display an error toast
            showErrorToast(message) {
            Toastify({
                text: message,
                backgroundColor: "red",
                canTimeout: true,
                duration: 3000, // 3 seconds
                close: true,
            }).showToast();
        },
        async onSubmit(e){
            this.loading = true;
            const url = "/api/auth/login"
            e.preventDefault();
            await axios.post(url,{
                email: this.email,
                password: this.password
            })
            .then((res)=>{
                console.log(res.data);
                if(res.data.success){
                    if(res.data.data.role===1){
                        localStorage.setItem('token', res.data.token);
                        this.$router.push({path:'/'});
                    }else if(res.data.data.role===2){
                        this.showErrorToast("Access Denied!")
                    }
                }else{
                    console.log(res.data.error);
                    if(res.data.error.email){
                        this.showErrorToast(res.data.error.email[0]);
                    }
                    if(res.data.error.password){
                        this.showErrorToast(res.data.error.password[0]);
                    }
                }
            })
            .catch(err=>{
                this.showErrorToast(err.response.data.message);
            })
            this.loading=false;
        }
    },
}

</script>
<template>
    <div class="w-full h-screen main flex justify-center items-center">
        <div class="w-[90%] h-[80%] bg-white rounded-lg flex">
            <!-- for images background color -->
            <div class="w-[45%] bg h-full"></div>
            <div class="w-[55%] flex flex-col">
                <div class="flex justify-center py-[50px] font-bold text-2xl">
                    Sign in your account
                </div>
                <div class="px-9">
                    <form @submit="onSubmit" class="w-[80%] text-left flex gap-y-4 flex-col font-semibold">
                        <label for="full-name">Email <span class="text-red-500">*</span></label>
                        <input v-model="email" type="text" placeholder="ex. yinsoknara@gmail.com" required
                        class="bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md" 
                        >
                        <label for="full-name">Password <span class="text-red-500">*</span></label>
                        <input v-model="password" type="password" required placeholder="••••••••"
                        class="bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md"
                        >
                        <div class="flex justify-center w-full mt-6">
                        <button type="submit" 
                        class="p-5 bg-[#FF3535CC] text-white font-bold py-3 rounded-sm w-[40%]">
                        {{loading ? 'Loading...' : 'Login'  }}</button>
                        </div>
                    </form>
                </div>
                <div class="p-9 flex justify-between w-[80%]">
                    <div class="font-semibold">
                        <span>Don't have account?</span>
                        <router-link to="/auth/signup" class="text-[#FF2020] "> Create new account</router-link>
                    </div>
                    <div><router-link to="/" class="text-blue-700">Back</router-link></div>
                </div>
            </div>
        </div>
    </div>
</template> 

<style>
.main {
    background: linear-gradient(180deg, #FFA9A9 0%, rgba(250, 250, 250, 0.85) 100%);
}
.bg{
    background-image: url("../../../assets/images/Rectangle1.png");
}
</style>