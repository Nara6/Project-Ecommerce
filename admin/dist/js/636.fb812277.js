"use strict";(self["webpackChunkexercise4"]=self["webpackChunkexercise4"]||[]).push([[636],{3636:function(e,t,o){o.r(t),o.d(t,{default:function(){return Q}});var l=o(3396),r=o(9242),a=o(7139);const i={class:"relative"},s=(0,l._)("div",{class:"bg-gray-500 text-white py-2 text-lg text-center"},[(0,l._)("h1",null,"Products")],-1),d={key:0,class:"overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"},n={class:"relative w-[50%] my-6 mx-auto max-w-lg"},c={class:"border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"},u=(0,l._)("div",{class:"flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t"},[(0,l._)("h3",{class:"text-3xl font-semibold"}," Create New Category ")],-1),p={class:"relative justify-center p-6 flex"},h={class:"w-[90%] gap-1 text-left flex flex-col"},w=(0,l._)("label",{for:""},"Title: ",-1),g=(0,l._)("label",{for:""},"Price: ",-1),_=(0,l._)("label",{for:""},"Category: ",-1),f=(0,l._)("option",{selected:"",disabled:"",value:""},"Select Category",-1),b=["value"],m=(0,l._)("label",{for:""},"Sub-Category: ",-1),y=(0,l._)("option",{selected:"",disabled:"",value:""},"Select Sub-Category",-1),x=["value"],v=(0,l._)("label",{for:""},"Description: ",-1),C=(0,l._)("label",{for:""},"Note: ",-1),k=(0,l._)("label",{for:""},"File: ",-1),D={class:"flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b"},T={key:1,class:"opacity-25 fixed inset-0 z-40 bg-black"},M={class:"py-2"},S={id:"customers"},j=(0,l._)("tr",{class:"bg-gray-200"},[(0,l._)("th",null,"Title"),(0,l._)("th",null,"Prices"),(0,l._)("th",null,"Category"),(0,l._)("th",null,"Sub-Category"),(0,l._)("th",null,"ImageURL"),(0,l._)("th",null,"Description"),(0,l._)("th",null,"Action")],-1),q={class:"flex justify-center"},z=["src"],U=(0,l._)("td",null,[(0,l._)("div",{class:"flex flex-col space-y-2"},[(0,l._)("button",{class:"hover:text-green-600 hover:font-bold"},"Edit"),(0,l._)("button",{class:"hover:text-green-600 hover:font-bold"}," Delete ")])],-1),P={key:2,class:"flex justify-center items-center absolute top-0 left-0 bottom-0 right-0"},A={class:"w-72 h-96 bg-white rounded-lg shadow-md"},V={class:"h-full w-full flex flex-col"},Z={class:"flex flex-grow-0 relative p-2 py-3"},F={class:"font-bold text-center w-full"},H={class:"w-full flex flex-grow p-2"},K={class:"w-full flex flex-col space-y-3"},Y={class:"border"},L={class:"border"},$={class:"flex flex-grow-0 py-1 justify-center space-x-2"},E=(0,l._)("button",{type:"submit",class:"bg-blue-500 p-2 px-3 text-white rounded-md cursor-pointer"}," Add ",-1);function I(e,t,o,I,N,B){return(0,l.wg)(),(0,l.iD)("main",i,[s,N.showModal?((0,l.wg)(),(0,l.iD)("div",d,[(0,l._)("div",n,[(0,l._)("div",c,[u,(0,l._)("div",p,[(0,l._)("div",h,[w,(0,l.wy)((0,l._)("input",{"onUpdate:modelValue":t[0]||(t[0]=e=>N.title=e),class:"w-full p-2 border-2",type:"text",placeholder:"Ex: Phone",required:""},null,512),[[r.nr,N.title]]),g,(0,l.wy)((0,l._)("input",{"onUpdate:modelValue":t[1]||(t[1]=e=>N.price=e),class:"w-full p-2 border-2",type:"text",placeholder:"899",required:""},null,512),[[r.nr,N.price]]),_,(0,l.wy)((0,l._)("select",{"onUpdate:modelValue":t[2]||(t[2]=e=>N.category_id=e),class:"w-full p-2 border-2"},[f,((0,l.wg)(!0),(0,l.iD)(l.HY,null,(0,l.Ko)(N.categories,(e=>((0,l.wg)(),(0,l.iD)("option",{key:e.id,value:e.id},(0,a.zw)(e.name),9,b)))),128))],512),[[r.bM,N.category_id]]),m,(0,l.wy)((0,l._)("select",{"onUpdate:modelValue":t[3]||(t[3]=e=>N.item_id=e),class:"w-full p-2 border-2"},[y,((0,l.wg)(!0),(0,l.iD)(l.HY,null,(0,l.Ko)(N.items,(e=>((0,l.wg)(),(0,l.iD)("option",{key:e.id,value:e.id},(0,a.zw)(e.name),9,x)))),128))],512),[[r.bM,N.item_id]]),v,(0,l.wy)((0,l._)("input",{"onUpdate:modelValue":t[4]||(t[4]=e=>N.description=e),class:"w-full p-2 border-2",type:"text",placeholder:"Lorem ipsum dolor, sit amet consectetur, adipisicing elit, Consecteturquaera",required:""},null,512),[[r.nr,N.description]]),C,(0,l.wy)((0,l._)("input",{"onUpdate:modelValue":t[5]||(t[5]=e=>N.note=e),class:"w-full p-2 border-2",type:"text",placeholder:"Lorem ipsum dolor, sit amet consectetur, adipisicing elit, Consecteturquaera",required:""},null,512),[[r.nr,N.note]]),k,(0,l._)("input",{type:"file",onChange:t[6]||(t[6]=e=>B.handleFileUpload(e))},null,32)])]),(0,l._)("div",D,[(0,l._)("button",{class:"text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150",onClick:t[7]||(t[7]=e=>B.toggleModal())}," Close "),(0,l._)("button",{class:"bg-green-500 text-white rounded background-transparent font-bold uppercase px-6 py-3 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150",onClick:t[8]||(t[8]=e=>B.create())}," Save Changes ")])])])])):(0,l.kq)("",!0),N.showModal?((0,l.wg)(),(0,l.iD)("div",T)):(0,l.kq)("",!0),(0,l._)("div",M,[(0,l._)("button",{onClick:t[9]||(t[9]=e=>B.toggleModal()),type:"submit",class:"bg-blue-500 text-white p-1 px-2 rounded-md"}," Add new ")]),(0,l._)("div",null,[(0,l._)("table",S,[j,((0,l.wg)(!0),(0,l.iD)(l.HY,null,(0,l.Ko)(N.productDesc,(e=>((0,l.wg)(),(0,l.iD)("tr",{key:e._id},[(0,l._)("td",null,(0,a.zw)(e.title),1),(0,l._)("td",null," $"+(0,a.zw)(e.price),1),(0,l._)("td",null,(0,a.zw)(e.category?.name),1),(0,l._)("td",null,(0,a.zw)(e.item?.name),1),(0,l._)("td",q,[(0,l._)("img",{class:"w-[100px] h-[100px]",src:"/image"+e.image_url,alt:""},null,8,z)]),(0,l._)("td",null,[((0,l.wg)(!0),(0,l.iD)(l.HY,null,(0,l.Ko)(e.descriptionArray,((e,t)=>((0,l.wg)(),(0,l.iD)("ul",{class:"list-disc list-inside text-left",key:t},[(0,l._)("li",null,(0,a.zw)(e),1)])))),128))]),U])))),128))])]),e.priceModalShown&&e.selectedProduct?((0,l.wg)(),(0,l.iD)("div",P,[(0,l._)("div",A,[(0,l._)("form",{onSubmit:t[13]||(t[13]=(...t)=>e.onAddPrice&&e.onAddPrice(...t)),method:"post"},[(0,l._)("div",V,[(0,l._)("div",Z,[(0,l._)("div",F,(0,a.zw)(e.selectedProduct?.title),1)]),(0,l._)("div",H,[(0,l._)("div",K,[(0,l._)("div",Y,[(0,l.wy)((0,l._)("input",{required:"","onUpdate:modelValue":t[10]||(t[10]=e=>N.price=e),class:"w-full h-10 px-1",type:"number",placeholder:"Price"},null,512),[[r.nr,N.price]])]),(0,l._)("div",L,[(0,l.wy)((0,l._)("input",{required:"","onUpdate:modelValue":t[11]||(t[11]=t=>e.source=t),class:"w-full h-10 px-1",type:"text",placeholder:"Source"},null,512),[[r.nr,e.source]])])])]),(0,l._)("div",$,[(0,l._)("button",{onClick:t[12]||(t[12]=t=>e.priceModalShown=!1),class:"p-2 px-3 text-gray-500 rounded-md cursor-pointer border border-gray-100"}," Cancel "),E])])],32)])])):(0,l.kq)("",!0)])}var N=o(4161),B=o(2310),R=o.n(B),G={data(){return{categories:[],items:[],products:[],productDesc:"",title:"",image_url:"",description:"",category_id:"",item_id:"",showModal:!1,note:"",price:""}},watch:{async category_id(e,t){const o=await N.Z.get(`/api/category/read/${e}`,{headers:{"Content-Type":"application/json"}});this.items=await o.data[0].item,console.log(this.items)}},methods:{showToast(e){R()({text:e,backgroundColor:"red",duration:3e3,close:!0}).showToast()},toggleModal:function(){this.showModal=!this.showModal},async create(){var e=new FormData;e.append("title",this.title),e.append("description",this.description),e.append("item_id",this.item_id),e.append("price",this.price),e.append("category_id",this.category_id),e.append("image_url",this.image_url),e.append("note",this.note);const t=await N.Z.post("/api/product/create",e,{headers:{Authorization:`Bearer ${localStorage.getItem("token")}`,"Content-Type":"multipart/form-data"}});if(console.log(t.data),t.data.product){this.showToast("Product Created Successfully"),this.showModal=!this.showModal;const e=await N.Z.get("/api/product/read?limit=100",{headers:{"Content-Type":"application/json"}});this.products=await e.data,this.productDesc=this.products.map((e=>{const t=e.description.split(",");return{...e,descriptionArray:t}}))}else t.data.errors.title&&this.showToast(t.data.errors.title[0]),t.data.errors.description&&this.showToast(t.data.errors.description[0]),t.data.errors.category_id&&this.showToast(t.data.errors.category_id[0]),t.data.errors.item_id&&this.showToast(t.data.errors.item_id[0]),t.data.errors.note&&this.showToast(t.data.errors.note[0]),t.data.errors.price&&this.showToast(t.data.errors.price[0])},handleFileUpload(e){this.image_url=e.target.files[0]}},async mounted(){const e=await N.Z.get("/api/product/read?limit=100",{headers:{"Content-Type":"application/json"}});this.products=await e.data,this.productDesc=this.products.map((e=>{const t=e.description.split(",");return{...e,descriptionArray:t}}));const t=await N.Z.get("/api/category/read?limit=100",{headers:{"Content-Type":"application/json"}});this.categories=await t.data}},J=o(89);const O=(0,J.Z)(G,[["render",I]]);var Q=O}}]);
//# sourceMappingURL=636.fb812277.js.map