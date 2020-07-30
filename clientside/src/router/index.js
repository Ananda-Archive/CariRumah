import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

  const routes = [
  {
    path: '',
    name: 'Home',
    component: () => import('../views/Home.vue'),
    meta: {
      auth: false
    }
  },
  {
    path: '/Products',
    name: 'Products',
    component: () => import('../views/Products.vue'),
    meta: {
      auth: false
    }
  },
  // Admin Page
  {
    path: '/Login',
    name: 'Login',
    component: () => import('../views/admin/Login.vue'),
    meta: {
      auth: false
    }
  },
  {
    path: '/Dashboard',
    name: 'Dashboard',
    component: () => import('../views/admin/Dashboard.vue'),
    meta: {
      auth: true
    }
  },
  {
    path: '/AdminMitra',
    name: 'AdminMitra',
    component: () => import('../views/admin/AdminMitra.vue'),
    meta: {
      auth: true
    }
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
