import { createWebHistory, createRouter } from 'vue-router'
import guest from './middlewares/guest'
import auth from './middlewares/auth'
import admin from './middlewares/admin'

import dashboardLayout from '@/layouts/dashboardLayout.vue';
import authLayout from '@/layouts/authLayout.vue';
import paysLayout from '@/layouts/paysLayout.vue';
import userAdminLayout from '@/layouts/userAdminLayout.vue';
import rekutuApply from '@/components/rekutu/rekutuApply.vue';
import bankPage from '@/pages/bank.vue';
import bankAccountPage from '@/pages/accountBank.vue';
import lastOperationPage from '@/pages/lastOperations.vue';
import notificationsPage from '@/pages/notifications.vue';
import deposit from '@/pages/deposit.vue'
import creditApply from '@/pages/creditApply.vue'
import loanPage from '@/pages/loan.vue'
import allUsers from '@/pages/admin/users.vue'
import usersWithLoan from '@/pages/admin/loanRequest.vue'
import loanPayView from '@/pages/admin/loanPayView.vue'
import loanApplication from '@/pages/admin/loanApplication.vue'
import cleanUsers from '@/components/admin/users/cleanUsers.vue'
import slowPayer from '@/components/admin/users/slowPayerUsers.vue'
import loanViewAdmin from '@/pages/admin/loanView.vue'
import userInfo from '@/components/profile/userInfo.vue'
import userAddress from '@/components/profile/userAddress.vue'
import userProffesion from '@/components/profile/userProffesion.vue'
import addAccountBank from '@/components/accountsBank/addAccountBank.vue'
import userById from '@/components/admin/users/userById.vue'
import userVerification from '@/components/admin/users/userVerification.vue'
import userNotification from '@/components/admin/notification/notificationPush.vue'
import verificationKyc from '@/components/profile/verificationKyc.vue'
import loanPay from '@/components/loan/loanPay.vue'
import loanPayFinish from '@/components/loan/loanPayFinish.vue'
import selectPayLoan from '@/components/loan/selectPayLoan.vue';
import loanView from '@/components/loan/loanView.vue'
import viewTransaction from '@/components/transaction/viewTransaction.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'landing',
      component: () => import('@/pages/landing.vue'),
      meta: {
        title: 'Crea tu cuenta'
      },
    },
    // { path: '/', redirect: window.localStorage.getItem('is_admin') == 'true' ? '/admin/dashboard' :'/dashboard' },
    {
      path: '/requestPay',
      name: 'payLink',
      beforeEnter: auth,
      component: () => import('@/pages/payLink.vue'),
      meta: {
        title: 'Solicitar Pago'
      },
    },
    {
      path: '/generatePayLink/:type/:id',
      name: 'generatePayLink',
      beforeEnter: auth,
      component: () => import('@/pages/generatePayLink.vue'),
      meta: {
        title: 'Solicitar Pago'
      },
    },
    {
      path: "/",
      name:"home",
      component: dashboardLayout,
      
      children: [
        {
          name: "dashboard",
          path: '/dashboard',
          component: () => import('@/pages/dashboard.vue'),
          beforeEnter: auth,
          meta: {
            // middleware: [
            //   auth
            // ],
            title : 'Dashboard'
          },
        },
        {
          name: "dashboard_admin",
          path: '/admin/dashboard',
          component: () => import('@/pages/admin/dashboard.vue'),
          beforeEnter: admin,
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
      component: () => import('@/pages/link_card.vue'),
      meta: {
        title : 'Vincular tarjeta'
      },
      beforeEnter: auth,
    },
    {
      path: "/transfer",
      name:"transfer",
      component: () => import('@/pages/transfer.vue'),
      meta: {
        title : 'Transferir'
      },
      beforeEnter: auth,
    },
    {
      path: "/finish_transfer/:id",
      name:"finish_transfer",
      component: () => import('@/components/transfer/finishTransfer.vue'),
      meta: {
        title : '¡Envío exitoso!'
      },
      beforeEnter: auth,
    },
    {
      path: "/",
      name:"admin",
      component: paysLayout,
      beforeEnter: admin,
      children: [
        {
          path: "/admin/user/:id",
          name: "userById",
          component: userById,
          beforeEnter: admin,
          meta: {
            title: 'Perfil'
          },
        },
        {
          path: "/admin/user/verification/:id",
          name: "userVerificationId",
          component: userVerification,
          beforeEnter: admin,
          meta: {
            title: 'Perfil'
          },
        },
        {
          path: "/admin/notification/send",
          name: "sendNotification",
          component: userNotification,
          beforeEnter: admin,
          meta: {
            title: 'Notificaciones push'
          },
        },
        {
          path: "/admin/loan/:id",
          name: "adminLoan",
          component: loanApplication,
          beforeEnter: admin,
          meta: {
            title: 'Solicitud'
          },
        },
        {
          path: '/admin/loan_view/:id',
          component: loanViewAdmin,
          meta: {
            title: 'Préstamo'
          }
        },
        {
          path: '/admin/pay/loanView/:id',
          component: loanPayView,
          meta: {
            title: 'Pagos pendientes',
          }
        },
        {
          path: '/admin/loans',
          component: () => import('@/pages/admin/loans.vue'),
          meta: {
            title: 'Préstamo'
          }
        },
        {
          path: '/admin/interest',
          component: () => import('@/pages/admin/interest.vue'),
          meta: {
            title: 'Calculadora de intereses'
          }
        }
      ]
    },
    {
      path: "/",
      name:"adminClient",
      component: userAdminLayout,
      beforeEnter: admin,
      children: [
        {
          path: "/users",
          name: "users",
          component: allUsers,
          meta: {
            title: 'Clientes'
          },
        },
        {
          path: "/users/loan",
          name: "usersWithLoan",
          component: usersWithLoan,
          meta: {
            title: 'Solicitudes'
          },
        },
        {
          path: "/users/clean",
          name: "usersClean",
          component: cleanUsers,
          meta: {
            title: 'Clientes'
          },
        },
        {
          path: "/users/slow_payer",
          name: "usersSlowPayer",
          component: slowPayer,
          meta: {
            title: 'Clientes'
          },
        },
        {
          path: "/pays/pending",
          name: "paysPeding",
          component: import('@/pages/admin/paysPending.vue'),
          meta: {
            title: "Pagos pendientes"
          }
        }
      ]
    },
    {
      path: '/trasacction/view/:type/:id',
      component: viewTransaction,
      meta: {
        title: 'Comprobante'
      }
    },
    {
      path: "/",
      name:"link",
      component: paysLayout,
      beforeEnter:auth,
      children: [
        {
          path: "/link_card_form",
          name: "link_card_form",
          component: () => import('@/pages/creditForDebit.vue'),
          meta: {
            title: 'Credito por debito'
          },
        },
        {
          path: "/linked_card/:id_card",
          name: "linki",
          component: () => import('@/pages/linked_card.vue'),
          meta: {
            title: 'Vincular tarjeta'
          },
        },
        {
          path: "/transfer_send",
          name: "send_transfer",
          component: () => import('@/components/transfer/sendTransfer.vue'),
          meta: {
            title: 'Enviar dinero'
          },
        },
        {
          path: "/verification_kyc",
          name: "verificationKyc",
          component: verificationKyc,
          meta: {
            title: 'Perfil'
          }
        },
        {
          path: "/bank",
          component: bankPage,
          meta: {
            title: 'Bancos',
            // middleware: [
            //   auth,
          },
        },
        {
          path: "/profile",
          component: () => import('@/pages/profile.vue'),
          meta: {
            title : 'Perfil'
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
        {
          path: "/card",
          component: () => import('@/pages/card.vue'),
          meta: {
            title : 'Vincular tarjeta de crédito'
          },
        },
        {
          path:'/loan',
          component: loanPage,
          meta: {
            title: 'Mi préstamo'
          }
        },
        {
          path: '/loan_pay/:type',
          component: loanPay,
          meta: {
            title: 'Paga tu préstamo'
          }
        },
        {
          path: '/loan_view',
          component: loanView,
          meta: {
            title: 'Mi préstamo'
          }
        },
        {
          path: '/loan_select_pay',
          component: selectPayLoan,
          meta: {
            title: 'Paga tu préstamo'
          }
        },
        {
          path: '/loan/pay/finish',
          component: loanPayFinish,
          meta: {
            title: 'Mi préstamo'
          }
        },
        {
          path: '/transactions',
          component: () => import('@/pages/allTransaction.vue'),
          meta: {
            title: 'Ultimas transacciones'
          }
        },
        {
          path:'/rekutu_apply',
          component: rekutuApply,
          meta: {
            title: 'Solicitar rekutu'
          }
        }
      ]
    },
    
  ]
})



export default router
