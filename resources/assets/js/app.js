
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';
import Authorization from './authorization/authorize';

Vue.use(VueIziToast);
Vue.use(Authorization);
// import poilices from './authorization/policies';
//
// //tạo hàm để gọi nhanh authorize('modify', answer)
// Vue.prototype.authorize = function(policy, model) {
//     if (!window.Auth.signedIn) return false;
//     if (typeof policy === 'string' && typeof model === 'object') {
//         const user = window.Auth.user;
//         return poilices[policy](user, model);
//         //return policies.policy(user, model);
//     }
// }


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
Vue.component('user-info', require('./components/UserInfo.vue'));
//Vue.component('answer', require('./components/Answer.vue'));
// Vue.component('favorite', require('./components/Favorite.vue'));
// Vue.component('accept', require('./components/Accept.vue'));
Vue.component('vote', require('./components/Vote.vue'));
Vue.component('answers', require('./components/Answers.vue'));

const app = new Vue({
    el: '#app'
});
