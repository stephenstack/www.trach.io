import Vue from 'vue';
import axios from 'axios';
import VueRouter from 'vue-router';
import VueAxios from "vue-axios";
import Helpers from './mixins/Helpers';
import moment from 'moment'

window.Vue = Vue;
window.axios = axios;
window.moment = moment;

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.mixin(Helpers);


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Add a 401 response interceptor for session timeout - https://gist.github.com/yajra/5f5551649b20c8f668aec48549ef5c1f
window.axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    // console.log(error.response.status);
    if (401 === error.response.status) {
        alert('Your session has expired.')
        window.location = '/logout';
    } else {
        return Promise.reject(error);
    }
});


/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}