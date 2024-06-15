
import App from '@/App.vue'
import { createApp } from 'vue'
import { createPinia } from "pinia";
// import { func } from '@/core/services/utils/utils.js'
// import axios from "axios";
// import VueAxios from "vue-axios";
// import router from "./router.js";
import mitt from 'mitt'
const emitter = mitt()
const app = createApp(App)


// app.use(vuetify)
// app.use(router)
// app.use(func)
app.config.globalProperties.emitter = emitter

// app.axios.defaults.baseURL = import.meta.env.VUE_APP_BACKEND_URL 
// app.config.globalProperties.$helper = func;
// console.log(app)
app.use(createPinia())
app.mount('#app')
