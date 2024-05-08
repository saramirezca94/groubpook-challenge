import './bootstrap';
import { createApp } from 'vue';
import app from './components/app.vue';
import router from './router';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

createApp(app).use(router).mount('#app');
window.toastr = toastr;