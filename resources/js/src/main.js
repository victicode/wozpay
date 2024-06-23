
import App from '@/App.vue'
import { createApp } from 'vue'
import { createPinia } from "pinia";
import { Quasar, Notify } from 'quasar'
import quasarLang from 'quasar/lang/es'
import router from "@/routes/index.js";

// import { func } from '@/core/services/utils/utils.js'

// Import icon libraries
import '@quasar/extras/roboto-font/roboto-font.css'
import '@quasar/extras/eva-icons/eva-icons.css'
import * as materialIcons from '@quasar/extras/material-icons-outlined'
import * as materialIcons2 from '@quasar/extras/material-icons-sharp'

import * as ionIcons from '@quasar/extras/ionicons-v7'
import '@quasar/extras/fontawesome-v6/fontawesome-v6.css'


// A few examples for animations from Animate.css:
import '@quasar/extras/animate/fadeIn.css'
import '@quasar/extras/animate/fadeOut.css'

import '@quasar/extras/animate/fadeInUp.css'
import '@quasar/extras/animate/fadeOutDown.css'
// Import Quasar css
import 'quasar/src/css/index.sass'
import "quasar/src/css/flex-addon.sass";
import '@/plugins/quasar/scss/template.scss'

import mitt from 'mitt'
const emitter = mitt()

const app = createApp(App)

// app.use(func)
app.config.globalProperties.emitter = emitter

// app.axios.defaults.baseURL = import.meta.env.VUE_APP_BACKEND_URL 
// app.config.globalProperties.$helper = func;
// console.log(app)
app.use(createPinia())
app.use(router)
app.use(Quasar, {
  plugins: {
    Notify
  }, // import Quasar plugins and add here
  lang: quasarLang,
  /*
  config: {
    brand: {
      // primary: '#e46262',
      // ... or all other brand colors
    },
    notify: {...}, // default set of options for Notify Quasar plugin
    loading: {...}, // default set of options for Loading Quasar plugin
    loadingBar: { ... }, // settings for LoadingBar Quasar plugin
    // ..and many more (check Installation card on each Quasar component/directive/plugin)
  }
  */
})
app.provide('ionIcons', {...ionIcons, ...materialIcons, ...materialIcons2})

app.mount('#app')
