<script>
import auth from '@/services/Auth/index.js'
export default {
    name:'login',
    data(){
        return{
            email:'',
            password:'',
        }
    },
    // async mounted(){
    //     console.log("hi");
    // },
    methods: {
        async onSubmit(e){
            const url = "/api/auth/login"
            e.preventDefault();
            const formData = JSON.stringify({email: this.email, password: this.password});
            // console.log(formData);
            const res = await auth.login(url,formData);
            // console.log("hello");
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
                    Create your Free Account
                </div>
                <div class="px-9">
                    <form @submit="onSubmit" class="w-[80%] flex gap-y-4 flex-col font-semibold">
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
                        Login</button>
                        </div>
                    </form>
                </div>
                <div class="p-9 flex justify-between w-[80%]">
                    <div class="font-semibold">
                        <span>Don't have account?</span>
                        <router-link to="/auth/signup" class="text-[#FF2020] "> Create new account</router-link>
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