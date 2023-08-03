"use strict";(self["webpackChunkexercise4"]=self["webpackChunkexercise4"]||[]).push([[741],{9741:function(e,t,s){s.r(t),s.d(t,{default:function(){return E}});var a=s(3396),o=s(9242),l=s(7139);const r={class:"w-full h-screen main flex justify-center items-center"},n={class:"w-[90%] h-[80%] bg-white rounded-lg flex"},d=(0,a._)("div",{class:"w-[45%] bg h-full"},null,-1),i={class:"w-[55%] flex flex-col"},u=(0,a._)("div",{class:"flex justify-center py-[50px] font-bold text-2xl"}," Sign in your account ",-1),c={class:"px-9"},p=(0,a._)("label",{for:"full-name"},[(0,a.Uk)("Email "),(0,a._)("span",{class:"text-red-500"},"*")],-1),w=(0,a._)("label",{for:"full-name"},[(0,a.Uk)("Password "),(0,a._)("span",{class:"text-red-500"},"*")],-1),f={class:"flex justify-center w-full mt-6"},h={type:"submit",class:"p-5 bg-[#FF3535CC] text-white font-bold py-3 rounded-sm w-[40%]"},m={class:"p-9 flex justify-between w-[80%]"},x={class:"font-semibold"},b=(0,a._)("span",null,"Don't have account?",-1),g=(0,a.Uk)(" Create new account"),_=(0,a.Uk)("Back");function y(e,t,s,y,k,v){const F=(0,a.up)("router-link");return(0,a.wg)(),(0,a.iD)("div",r,[(0,a._)("div",n,[d,(0,a._)("div",i,[u,(0,a._)("div",c,[(0,a._)("form",{onSubmit:t[2]||(t[2]=(...e)=>v.onSubmit&&v.onSubmit(...e)),class:"w-[80%] text-left flex gap-y-4 flex-col font-semibold"},[p,(0,a.wy)((0,a._)("input",{"onUpdate:modelValue":t[0]||(t[0]=e=>k.email=e),type:"text",placeholder:"ex. yinsoknara@gmail.com",required:"",class:"bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md"},null,512),[[o.nr,k.email]]),w,(0,a.wy)((0,a._)("input",{"onUpdate:modelValue":t[1]||(t[1]=e=>k.password=e),type:"password",required:"",placeholder:"••••••••",class:"bg-[#F4F4F4] w-full placeholder:text-[16px] py-2.5 px-[20px] rounded-md"},null,512),[[o.nr,k.password]]),(0,a._)("div",f,[(0,a._)("button",h,(0,l.zw)(k.loading?"Loading...":"Login"),1)])],32)]),(0,a._)("div",m,[(0,a._)("div",x,[b,(0,a.Wm)(F,{to:"/auth/signup",class:"text-[#FF2020]"},{default:(0,a.w5)((()=>[g])),_:1})]),(0,a._)("div",null,[(0,a.Wm)(F,{to:"/",class:"text-blue-700"},{default:(0,a.w5)((()=>[_])),_:1})])])])])])}var k=s(4161),v=s(2310),F=s.n(v),T={name:"login",data(){return{email:"",password:"",loading:!1}},methods:{showSuccessToast(e){F()({text:e,type:"success",backgroundColor:"blue",canTimeout:!0,duration:3e3,close:!0}).showToast()},showErrorToast(e){F()({text:e,backgroundColor:"red",canTimeout:!0,duration:3e3,close:!0}).showToast()},async onSubmit(e){this.loading=!0;const t="/api/auth/login";e.preventDefault(),await k.Z.post(t,{email:this.email,password:this.password}).then((e=>{e.data.success?1===e.data.data.role?(localStorage.setItem("token",e.data.token),this.$router.push({path:"/"})):showErrorToast("Access Denied!"):(console.log(e.data.error),e.data.error.email&&this.showErrorToast(e.data.error.email[0]),e.data.error.password&&this.showErrorToast(e.data.error.password[0]))})).catch((e=>{this.showErrorToast(e.response.data.message)})),this.loading=!1}}},C=s(89);const S=(0,C.Z)(T,[["render",y]]);var E=S}}]);
//# sourceMappingURL=741.a7bc3685.js.map