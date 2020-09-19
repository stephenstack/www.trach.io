<template>
    <div class="flex-1 overflow-auto border-l-2 border-gray-200 px-2" >
        <!-- https://medium.com/@obapelumi/pagination-with-vuejs-1f505ce8d15b -->
        <div class="flex-1">
            <div class="w-full sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto">
                <div class="w-full text-gray-700 font-semibold text-xl">
                </div>
                <div class="flex w-full justify-between py-4 text-gray-700 font-semibold text-xl">
                    <header class="w-full text-gray-700 font-semibold text-xl">Notifications</header>

                </div>
                <p class="text-gray-600 font-normal">
                    <span :class="allActiveLink ? 'font-semibold text-blue-600' : ''"
                        class=" hover:text-blue-600 cursor-pointer" @click="filterItems('all')">View all
                        ({{ allRows.length || '0'}}) </span>
                    |
                    <span :class="activeActiveLink ? 'font-semibold text-blue-600' : ''"
                        class=" hover:text-blue-600 cursor-pointer" @click="filterItems('active')">View active
                        ({{ rowsActive.length  || '0'}}) </span>
                    |
                    <span :class="inactiveActiveLink ? 'font-semibold text-blue-600' : ''"
                        class=" hover:text-blue-600 cursor-pointer" @click="filterItems('inactive')">View inactive
                        ({{ rowsinActive.length  || '0'}}) </span>
                </p>

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Message
                                    </th>

                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell">
                                        Date/Time
                                    </th>
                                    <th v-if="activeActiveLink"
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Mark as read
                                    </th>
                                </tr>
                            </thead>
                            <td v-show="isLoading" colspan="6" class="linePreloader w-full"></td>
                            <tbody v-show="!isLoading" >
                                <tr :class="item.status == 1 ? 'bg-gray-200' : 'bg-white'"
                                    v-for="(item, index) in displayedRows" :key="`${index}-${item.id}`">
                                    <td class="px-5 py-5 border-b border-gray-200  text-sm">
                                        <div class="flex">
                                            <div class="py-1">
                                                <span v-if="item.status == 0" class="flex relative text-gray-700">
                                                    <svg class="fill-current h-6 w-6 text-teal-500 mr-2"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path
                                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                                    </svg>
                                                </span>
                                                <span v-if="item.status == 1" class="flex relative text-gray-700">
                                                    <svg class="fill-current h-6 w-6 text-red-500 mr-2"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M15.71 8.29a1 1 0 0 0-1.42 0L12 10.59l-2.29-2.3a1 1 0 0 0-1.42 1.42l2.3 2.29l-2.3 2.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l2.29-2.3l2.29 2.3a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42L13.41 12l2.3-2.29a1 1 0 0 0 0-1.42zm3.36-3.36A10 10 0 1 0 4.93 19.07A10 10 0 1 0 19.07 4.93zm-1.41 12.73A8 8 0 1 1 20 12a7.95 7.95 0 0 1-2.34 5.66z" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="w-full flex justify-between ml-3">
                                                <div>
                                                    <component :is="item.type | getClassName" :data="item.data"></component>
                                                    <p class="text-gray-900 whitespace-no-wrap mt-2 block md:hidden">{{item.created_at | moment1 }}</p>
                                                    <p v-if="item.created_at" class="text-gray-600 whitespace-no-wrap block md:hidden">{{item.created_at | moment2 }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200  text-sm hidden md:table-cell">
                                        <p class="text-gray-900 whitespace-no-wrap">{{item.created_at | moment1 }}</p>
                                        <p v-if="item.created_at" class="text-gray-600 whitespace-no-wrap">{{item.created_at | moment2 }} </p>
                                    </td>

                                    <td v-if="activeActiveLink" class="px-5 py-5 border-b border-gray-200  text-sm text-right">
                                        <div :class="item.status == 1 ? 'hidden' : 'block'"
                                            class="inline-block text-gray-500">
                                            <svg @click="setInactive(item.id, index)" viewBox="0 0 100 125" class="fill-current text-green-300 hover:text-green-600 cursor-pointer mr-6 h-8 w-8" alt="Acknowledge" title="Acknowledge">
                                            <path class="st0" d="M87.6,30.8L42.7,77.5c-2.5,2.6-6.5,2.6-9,0L11.3,54c-2.5-2.6-2.5-6.8,0-9.4c2.5-2.6,6.5-2.6,9,0l18,18.8  l40.4-42c2.5-2.6,6.5-2.6,9,0C90.1,24,90.1,28.2,87.6,30.8z"/></svg>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="flex mx-6 border-b-2 border-gray-200 bg-white"></div>
                        <div class="flex px-6 justify-between h-12 bg-white">
                            <div class="flex justify-start ">
                                <div class="text-gray-600 text-sm text-center px-2 py-2">page {{page}} of {{pages.length}} </div>
                            </div>
                            <div class="flex justify-start my-2">
                                <div class="text-gray-700 text-center bg-white px-4 py-1 mr-2  rounded  cursor-pointer hover:font-bold"
                                    v-if="page != 1" @click="page--">Previous</div>
                                <div :class="page === pageNumber ? 'text-white bg-purple-400' : 'text-gray-700 bg-white' "
                                    class=" text-center px-4 py-1 mr-2 rounded cursor-pointer hover:font-bold"
                                    v-for="pageNumber in pages" @click="page = pageNumber" :key="pageNumber">
                                    {{pageNumber}}</div>
                                <div class="text-gray-700 text-center bg-white px-4 py-1 mr-2  rounded  cursor-pointer hover:font-bold"
                                    @click="page++" v-if="page < pages.length">Next</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <alert v-if="showAlert" :messagedata="alertmessage" @close="showAlert = false"></alert>

    </div>
</template>

<script>

import Alert from '../components/Alert';
import NewTenantUserAdded from "../components/notifications/NewTenantUserAdded";
export default {
    data: () => ({
        pagename: 'notification',
        isLoading: false,
        showModal: false,
        showAlert: false,
        alertmessage: null,
        showDeleteModal: false,
        rows: [],
        page: 1,
        pages: [],
        pageNumber: '',
        tablePerPage: 10,
        tableTotalRows: '',
        selectedIndex: '',
        selectedItemName: '',
        allRows: null,
        rowsActive: null,
        rowsinActive: null,
        allActiveLink: false,
        activeActiveLink: true,
        inactiveActiveLink: false
    }),
    components: {

        Alert,
        NewTenantUserAdded
    },
    methods: {
        setInactive(id, index){
            axios
                .put('/api/notifications/' + id, {
                    _method: 'PUT',
                    status: '1',
                    id: id
                })
                .then(response => {
                    this.$delete(this.rows, index);
                    this.getitems();
                    this.$store.dispatch('GET_NOTIFICATIONCOUNT');
                })
                .catch(error => {
                     console.log(error)
                })
        },
        getitems(){
            this.isLoading = true;
            axios
                .get('api/notifications')
                .then(response => {
                    this.rows = response.data;
                    this.allRows = this.rows.reverse();
                    this.rowsActive = this.rows.filter(element => element.read_at === null).reverse();
                    this.rowsinActive = this.rows.filter(element => element.read_at != null).reverse();
                    this.rows = this.rowsActive;
                    this.isLoading = false;
                })
                .catch(error => {
                    console.log(error)
                })
        },
        filterItems(filter){

            switch(filter) {
            case "all":
                this.rows = this.allRows;
                this.allActiveLink = true;
                this.inactiveActiveLink = false;
                this.activeActiveLink = false;
                break;
            case "active":
                this.rows = this.rowsActive;
                this.activeActiveLink = true
                this.allActiveLink = false;
                this.inactiveActiveLink = false;
                break;
            case "inactive":
                this.rows = this.rowsinActive;
                this.inactiveActiveLink = true
                this.activeActiveLink = false;
                this.allActiveLink = false;
                break;
            default:
                this.getitems();
            }
        }
    },
    filters: {
        countDaysAgo: function (value) {
            const last_login = value;
            const currTime = new Date().toISOString().slice(0, 19).replace('T', ' ');
            return Math.floor(( Date.parse(currTime) - Date.parse(last_login) ) / 86400000);
        }
    },
    created () {
        this.getitems();
    },
    mounted() {
        this.$store.dispatch('GET_NOTIFICATIONCOUNT');
    },
    filters: {
        moment1: function (date) {
            return moment(date).format('dddd, MMMM Do YYYY');
        },
        moment2: function (date) {
            return moment(date).format('"h:mm A');
        },
        getClassName(string){
            return string.substr(string.lastIndexOf('\\') + 1);
        }
    }
}
</script>

