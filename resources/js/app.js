import "./bootstrap";
import router from "./router";
import { store } from './store'
import Navigationside from "./components/nav/NavigationSide.vue";
import NavigationTop from "./components/nav/NavigationTop.vue";

Vue.prototype.$userId = document
    .querySelector("meta[name='user-id']")
    .getAttribute("content");
// this.$userId
Vue.prototype.$userName = document
    .querySelector("meta[name='user-name']")
    .getAttribute("content");
Vue.prototype.$firstName = document
    .querySelector("meta[name='first-name']")
    .getAttribute("content");
Vue.prototype.$userEmail = document
    .querySelector("meta[name='user-email']")
    .getAttribute("content");
Vue.prototype.$planName = document
    .querySelector("meta[name='user-plan-name']")
    .getAttribute("content");
Vue.prototype.$tenantId = document
    .querySelector("meta[name='tenant-id']")
    .getAttribute("content");
Vue.prototype.$roleId = document
    .querySelector("meta[name='role-id']")
    .getAttribute("content");
Vue.prototype.$timezone = document
    .querySelector("meta[name='timezone']")
    .getAttribute("content");
Vue.prototype.$timezoneOffset = document
    .querySelector("meta[name='timezone-offset']")
    .getAttribute("content");


// bus event listening http://andreybleme.com/2018-01-07/sharing-data-across-vuejs-components/
export const navToggleBus = new Vue();

new Vue({
    el: "#app",
    data: () => ({
        dark: false,
        menuIsOpen: false,

    }),
    router,
    store,
    components: {
        navigationside: Navigationside,
        navigationtop: NavigationTop,
    },
    methods: {

    },
    mounted() {

    },
    created() {
        // console.log(this.isSpaLoading);
    }
});
