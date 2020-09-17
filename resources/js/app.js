/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. **/
require('jquery');
require('./bootstrap');
require('pace');
require('perfect-scrollbar');

window.Vue = require('vue');

import Vuex from 'vuex';
import VuePaginate from 'vue-paginate';
import Multiselect from 'vue-multiselect';
import VueNotification from '@mathieustan/vue-notification';
import VuejsDialog from 'vuejs-dialog';
import 'vuejs-dialog/dist/vuejs-dialog.min.css';


Vue.component('multiselect', Multiselect);
Vue.use(Vuex);
Vue.use(VuePaginate);
Vue.use(VueNotification);
Vue.use(VuejsDialog);

Vue.component('dashboardComponent', require('./components/DashboardComponent.vue').default);
Vue.component('usersComponent', require('./components/UsersComponent.vue').default);
Vue.component('moviesComponent', require('./components/MoviesComponent.vue').default);
Vue.component('streamingqualityComponent', require('./components/StreamingQualityComponent.vue').default);
Vue.component('genresComponent', require('./components/GenresComponent.vue').default);
Vue.component('seriesComponent', require('./components/SeriesComponent.vue').default);
Vue.component('streamingComponent', require('./components/StreamingComponent.vue').default);
Vue.component('notificationsComponent', require('./components/NotificationsComponent.vue').default);
Vue.component('settingsComponent', require('./components/SettingsComponent.vue').default);
Vue.component('accountComponent', require('./components/AccountComponent.vue').default);
Vue.component('reportsComponent', require('./components/ReportsComponent.vue').default);
Vue.component('animeComponent', require('./components/AnimeComponent.vue').default);
Vue.component('animevideosComponent', require('./components/AnimevideosComponent.vue').default);
Vue.component('adsComponent', require('./components/AdsComponent.vue').default);
Vue.component('upcomingComponent', require('./components/UpcomingComponent.vue').default);
Vue.component('planComponent', require('./components/PlanComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',
});
