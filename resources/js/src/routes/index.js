import { createMemoryHistory, createWebHistory, createRouter } from 'vue-router'

import defaultComponent from '@/layouts/dashboardLayout.vue';
import bankPage from '@/pages/bank.vue';
import lastOperationPage from '@/pages/lastOperations.vue';
import notificationsPage from '@/pages/notifications.vue';
import profilePage from '@/pages/profile.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', redirect: '/dashboard' },
    {
      path: "/",
      name:"home",
      component: defaultComponent,
      children: [
        {
          name: "dashboard",
          path: 'dashboard',
          component: () => import('@/pages/dashboard.vue'),
          meta: {
            // middleware: [
            //   auth
            // ],
            title : 'Dashboard'
          },
        },
        {
          path: "/bank",
          component: bankPage,
          meta: {
            // middleware: [
            //   auth,
              
            // ],
            title : 'Banco'
          },
        },
        {
          path: "/last-operations",
          component: lastOperationPage,
          meta: {
            // middleware: [
            //   auth,
              
            // ],
            title : 'Ult. Trans.'
          },
        },
        {
          path: "/notifications",
          component: notificationsPage,
          meta: {
            title : 'Notificaciones'
          },
        },
        {
          path: "/profile",
          component: profilePage,
          meta: {
            // middleware: [
            //   auth,
              
            // ],
            title : 'Perfil'
          },
        },
      ]
    },
    {
      path: "/login",
      name: "Login",
      component: () => import('@/pages/login.vue'),
      meta: {
        title: 'Bienvenido'
      },
    },
  ]
})



export default router
