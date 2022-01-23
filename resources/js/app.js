/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import {routes} from './routes'



Vue.use(VueRouter)

import User from  './Helpers/User';

window.User=User

//noty
import Notification from  './Helpers/Notification';

window.Notification=Notification

// setup sweetalaert globally
import Swal from 'sweetalert2';
window.Swal=Swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

window.Toast=Toast;


Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(require('vue-resource'));

//end sweetalaert

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
    routes ,
    mode:'history'
  })


const app = new Vue({
    el: '#app',
    router
    
});
