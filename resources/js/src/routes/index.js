import { createMemoryHistory, createWebHistory, createRouter } from 'vue-router'
import guest from './middlewares/guest'
import auth from './middlewares/auth'
import dashboardLayout from '@/layouts/dashboardLayout.vue';
import pageLayout from '@/layouts/pagesLayout.vue';
import authLayout from '@/layouts/authLayout.vue';
import paysLayout from '@/layouts/paysLayout.vue';
import bankPage from '@/pages/bank.vue';
import bankAccountPage from '@/pages/accountBank.vue';
import lastOperationPage from '@/pages/lastOperations.vue';
import notificationsPage from '@/pages/notifications.vue';
import profilePage from '@/pages/profile.vue';
import deposit from '@/pages/deposit.vue'
import creditApply from '@/pages/creditApply.vue'
import userInfo from '@/components/profile/userInfo.vue'
import userAddress from '@/components/profile/userAddress.vue'
import userProffesion from '@/components/profile/userProffesion.vue'
import addAccountBank from '@/components/accountsBank/addAccountBank.vue'
import link_card from '@/pages/link_card.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', redirect: '/dashboard' },
    {
      path: "/",
      name:"home",
      component: dashboardLayout,
      beforeEnter: auth,
      children: [
        {
          name: "dashboard",
          path: '/dashboard',
          component: () => import('@/pages/dashboard.vue'),
          meta: {
            // middleware: [
            //   auth
            // ],
            title : 'Dashboard'
          },
        }
      ]
    },
    {
      path: "/",
      name:"pages",
      component: pageLayout,
      beforeEnter: auth,
      children: [
        {
          path: "/bank",
          component: bankPage,
          meta: {
            // middleware: [
            //   auth,
              
            // ],
            title : 'Agregar cuenta bancaria'
          },
        },
        {
          path: "/deposit",
          component:deposit,
          meta: {
            // middleware: [
            //   auth,
              
            // ],
            title : 'Cargar dinero a tu billetera'
          },
        },
        {
          path: "/account_bank",
          component: bankAccountPage,
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
        {
          path: "/apply",
          component: creditApply,
          meta: {
            // middleware: [
            //   auth,
              
            // ],
            title : 'Solicitar'
          },
        },
        {
          path: "/user_info",
          component: userInfo,
          meta: {
            // middleware: [
            //   auth,
              
            // ],
            title : 'Perfil'
          },
        }, 
        {
          path: "/user_address",
          component: userAddress,
          meta: {
            // middleware: [
            //   auth,
              
            // ],
            title : 'Perfil'
          },
        },
        {
          path: "/user_proffesion",
          component: userProffesion,
          meta: {
            // middleware: [
            //   auth,
              
            // ],
            title : 'Perfil'
          },
        },
        {
          path: "/add_account_bank/:id",
          component: addAccountBank,
          meta: {
            title : 'Agregar cuenta bancaria'
          },
        },
        
      ]
    },
    {
      path: "/",
      name:"auth",
      component: authLayout,
      beforeEnter:guest,
      children: [
        {
          path: "/login",
          name: "Login",
          component: () => import('@/pages/login.vue'),
          meta: {
            title: 'Bienvenido'
          },
        },
        {
          path: "/register",
          name: "register",
          component: () => import('@/pages/register.vue'),
          meta: {
            title: 'Crea tu cuenta'
          },
        },
      ]
    },
    {
      path: "/link_card",
      name:"link_card",
      component: link_card,
      meta: {
        title : 'Vincular tarjeta'
      },
      beforeEnter: auth,
    },
    // {
    //   path: "/",
    //   name:"operations",
    //   component: authLayout,
    //   beforeEnter:auth,
    //   children: [
    //     {
    //       path: "/login",
    //       name: "Login",
    //       component: () => import('@/pages/login.vue'),
    //       meta: {
    //         title: 'Bienvenido'
    //       },
    //     },
    //     {
    //       path: "/register",
    //       name: "register",
    //       component: () => import('@/pages/register.vue'),
    //       meta: {
    //         title: 'Crea tu cuenta'
    //       },
    //     },
    //   ]
    // }
    
  ]
})



export default router
