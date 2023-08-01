<script>
import axios from "axios";
export default {
    name:'signup',
    data(){
        return{
            email:'',
            fullname: '',
            password:'',
            confirm_password: '',
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
            e.preventDefault();
            this.loading=true;
            if(this.password===this.confirm_password){
                const url = "/api/auth/register"
                e.preventDefault();
                await axios.post(url,{
                    username: this.fullname,
                    phone: '016838248',
                    role: 2,
                    email: this.email,
                    password: this.password
                })
                .then((res)=>{
                    // console.log(res.data.token);
                    if(res.data.success){
                        this.showSuccessToast(res.data.message);
                        this.$router.push({name: 'login'});

                    }else{
                        // console.log(res.data);
                        this.showErrorToast(res.data.error.email);
                    }
                })
                .catch((err)=>{
                    // console.log(err);
                    this.showErrorToast(err);
                })
            }else{
                this.showErrorToast("Input password doesn't match!");
            }
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
                <div class="flex justify-center py-7 font-bold text-2xl">
                    Create your Free Account
                </div>
                <div class="px-9">
                    <form @submit="onSubmit" class="w-[80%] flex gap-y-2 flex-col font-semibold">
                        <label for="full-name">Full name <span class="text-red-500">*</span></label>
                        <input v-model="fullname" required placeholder="ex. yin soknara" type="text" 
                        class="bg-[#F4F4F4] py-2.5 px-[20px] w-full placeholder:text-[16px] rounded-md" 
                        >
                        <label for="full-name">Email <span class="text-red-500">*</span></label>
                        <input v-model="email" type="text" placeholder="ex. yinsoknara@gmail.com" required
                        class="bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md" 
                        >
                        <label for="full-name">Password <span class="text-red-500">*</span></label>
                        <input v-model="password" type="password" required placeholder="••••••••"
                        class="bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md"
                        >
                        <label for="full-name">Confirm Password <span class="text-red-500">*</span></label>
                        <input v-model="confirm_password" type="password" required placeholder="••••••••"
                        class="bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md"
                        >
                        <div class="flex justify-center w-full mt-6">
                        <button type="submit" 
                        class="p-5 bg-[#FF3535CC] text-white font-bold py-3 rounded-sm w-[40%]">
                        {{ loading ? 'Loading...' : 'Create Account' }}</button>
                        </div>
                    </form>
                </div>
                <div class="p-9 flex justify-between w-[80%]">
                    <div class="font-semibold">
                        <span>Already have a account?</span>
                        <router-link to="/auth/login" class="text-[#FF2020] "> Login</router-link>
                    </div>
                    <div><router-link to="/home" class="text-blue-700">Back</router-link></div>
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
    background-image: url("../assets/images/Rectangle1.png");
}
</style>