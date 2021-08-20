import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    redirect: { name: "Dashboard"},
    component: () => import("../components/MainContainer"),
    children: [
      {
        name: "Dashboard",
        path: "",
        component: () => import("../views/Home")
      },
      {
        name: "About",
        path: "/about",
        component: () => import("../views/About")
      }
    ]
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import("../views/Login")
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
