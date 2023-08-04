import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/auth/login',
    name: 'login',
    component: ()=> import ('../views/Dashboard/auth/Login')
  },
  {
    path: '/',
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
      },
      {
        path: 'item',
        name: 'item',
        component: ()=> import ('../views/Dashboard/pages/item')
      },
      {
        path: 'order',
        name: 'order',
        component: ()=> import ('../views/Dashboard/pages/order')
      },
    ]
  },


  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
