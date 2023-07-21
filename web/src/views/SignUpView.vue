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
                    <form action="" class="w-[80%] flex gap-y-2 flex-col font-semibold">
                        <label for="full-name">Full name <span class="text-red-500">*</span></label>
                        <input required placeholder="ex. yin soknara" type="text" 
                        class="bg-[#F4F4F4] py-2.5 px-[20px] w-full placeholder:text-[16px] rounded-md" 
                        >
                        <label for="full-name">Email <span class="text-red-500">*</span></label>
                        <input type="text" placeholder="ex. yinsoknara@gmail.com" required
                        class="bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md" 
                        >
                        <label for="full-name">Password <span class="text-red-500">*</span></label>
                        <input type="password" required placeholder="••••••••"
                        class="bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md"
                        >
                        <label for="full-name">Confirm Password <span class="text-red-500">*</span></label>
                        <input type="text" required placeholder="••••••••"
                        class="bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md"
                        >
                        <div class="flex justify-center w-full mt-6">
                        <button type="submit" 
                        class="p-5 bg-[#FF3535CC] text-white font-bold py-3 rounded-sm w-[40%]">
                        Create Account</button>
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