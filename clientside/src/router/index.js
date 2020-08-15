import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

  const routes = [
  {
    path:'*',
    name: 'NotFound',
    component: () => import('../views/404.vue'),
    meta: {
      auth: false
    }
  },
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
  {
    path: '/Products/:id',
    name: 'Products',
    component: () => import('../views/ProductDetail.vue'),
    meta: {
      auth: false
    }
  },
  {
    path: '/Registration',
    component: () => import('../views/RegistrationHome.vue'),
    children: [
      {
        path: '/',
        name: 'Registration',
        component: () => import('../views/Registration.vue'),
        meta: {
          auth: false
        }
      },
      {
        path: 'Mitra',
        name: 'Registration',
        component: () => import('../views/RegistrationMitra.vue'),
        meta: {
          auth: false
        }
      },
      {
        path: 'Agent',
        name: 'Registration',
        component: () => import('../views/RegistrationAgent.vue'),
        meta: {
          auth: false
        }
      },
      {
        path: 'Seminar',
        name: 'Registration',
        component: () => import('../views/RegistrationSeminar.vue'),
        meta: {
          auth: false
        }
      }
    ],
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
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
