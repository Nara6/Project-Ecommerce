<script>
import categoriesApi from '../libs/apis/category'
import productsApi from '../libs/apis/product'
export default {
  data() {
    return {
      categories: [],
      products: [],
      image: []
      
    }
  },
  async mounted() {
    this.categories = await categoriesApi.getCategoryItem();
    this.products = await productsApi.getAllProduct("", "");
    console.log(this.categories);
    // this.image = await productsApi.getUploads();
    
  },
  methods: {
    async onClick(categoryId, itemId){
      this.products = await productsApi.getAllProduct(categoryId, itemId)
      console.log(this.products)
    }
  }
}
</script>

<template>
  <div>
    <div class="header">
      <div style="width:50%; text-align: right;">
        លេខមួយ.com 
      </div> 
      <div style="width:50%; text-align: right;">
        <router-link to="/login" style="color: rgb(38, 38, 203);">Dashboard</router-link> 
      </div>
    </div>
    <div class="content">
      <div class="sideBar">
        <ul class="list-disc pl-3">
          <li v-for="category in categories" :key="category._id">
            <a href="#" @Click="onClick(category._id,'')">{{category.name}}</a>
            <ul class="list-disc list-inside">
              <li v-for="item in category?.items" :key="item._id">
                <a href="#" @click="onClick(item.category, item._id)">{{item.name}}</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="listing">
        <div v-for="product in products" :key="product._id">
          <div class="product">
            <div class="flex justify-center">
              <img :src="'http://localhost:3001/'+product.imageUrl" alt="productImage">
            </div>
            {{product.title}}
            <div class="price" v-for="price in product.prices">
              <div class="shop">{{price.source}}</div>
              <div class="value">{{price.price}}$</div>
            </div>
            <!-- <div class="price">
              {{  }}
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

.header{
  height: 50px;
  font-size: 30px;
  border: 1px solid black;
  display: flex;
}
.content{
  display: flex;
}
.sideBar{
  text-align: left;
  width: 20%;
  border: 1px solid black;
}
.listing{
  display: grid;
  border: 1px solid black;
  width: 80%;
  grid-template-columns: 25% 25% 25% 25%;
}
.item{
  padding-top: 5px;
}
a{
  text-decoration: none;
  color: black;
}
img{
  width: 100px;
}
.product{
  padding: 10px;
  border: 1px solid black;
}
.price{
  display: flex;
  width: inherit;
  margin-top: 10px;
}
.shop{
  width: 50%;
  text-align: left;
  padding-left: 20px;
}
.value{
  width: 50%;
  text-align: right;
  padding-right: 20px;
}
</style>