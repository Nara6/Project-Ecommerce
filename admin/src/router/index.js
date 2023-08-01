import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/login',
    name: 'login',
    component: ()=> import ('../views/LoginView')
  },
  {
    path: '/register',
    name: 'register',
    component: ()=> import ('../views/SignupView')
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: ()=> import ('../views/Dashboard/dashboard'),
    children: [
      {
        path: 'category',
        name: 'category',
        component: ()=> import ('../views/Dashboard/pages/category')
      },
      {
        path: 'product',
        name: 'product',
        component: ()=> import ('../views/Dashboard/pages/product'),
        // children: [
        //   {
        //     path: ':productId',
        //     props: true,
        //     component: ()=> import ('../views/Dashboard/pages/productDetail.vue')
        //   }
        // ]
      },
      {
        path: 'product/:id',
        name: 'productDetail',
        component: ()=> import ('../views/Dashboard/pages/productDetail.vue')
      },
      {
        path: 'item',
        name: 'item',
        component: ()=> import ('../views/Dashboard/pages/item')
      }
    ]
  },


  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
