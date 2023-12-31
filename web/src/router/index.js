import { createRouter, createWebHistory } from "vue-router";
import Index from "../views/Index.vue";
import LoginView from '../views/LoginView.vue';
import ShippingView from '../views/ShippingView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "index",
      component:Index ,
      redirect: '/home',
      children:[
        {
          path: "about",
          name: "about",
          component: () => import("../views/AboutView.vue"),
        },
        {
          path: "home",
          name: "home",
          component: () => import("../views/HomeView.vue"),
        },
        {
          path: "contact",
          name: "contact-us",
          component: () => import("../views/ContactUsView.vue"),
        },
        {
          path: "wishlist",
          name: "wishlist",
          component: () => import("../views/WishListView.vue"),
        },
    
        
        {
          path: "/product",
          name: "product",
          component: () => import("../views/CategoryView.vue"),
        },
        {
          path: "/product/detail/:id",
          name: "product-detail",
          component: () => import("../views/Products.vue"),
        },
        {
          path: "/cart",
          name: "cart",
          component: () => import("../views/CartView.vue"),
        },
        {
          path: "/cart/checkout",
          name: "checkout",
          component: () => import("../views/CheckoutView.vue"),
        },
        {
          path: "/cart/shipping",
          name: "shipping",
          component: ShippingView,
        },
        {
          path: "/cart/payment",
          name: "payment",
          component: () => import("../views/PaymentView.vue"),
        },
        {
          path: "/cart/complete-order",
          name: "complete-order",
          component: () => import("../views/CompleteOrderView.vue"),
        }
      ]
    },
    {
      path: "/auth",
      name: "auth",
      children: [
        {
          path: "signup",
          name: "signup",
          component: () => import("../views/SignUpView.vue")
        },
        {
          path: "login",
          name: "login",
          component: LoginView
        }
      ]
    },
    
   
  ],
});

export default router;
