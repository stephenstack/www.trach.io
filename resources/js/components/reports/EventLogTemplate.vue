<template>
    <div>
        <div v-show="isLoading" class="linePreloader w-full"></div>
        <p v-show="!isLoading" class="text-gray-600 font-normal m-4">
            <span :class="allActiveLink ? 'font-semibold text-blue-600' : ''"
                class=" hover:text-blue-600 cursor-pointer" @click="filterItems('all')">View all
                ({{ rows.length || '0'}}) </span>
            |
            <span :class="mineActiveLink ? 'font-semibold text-blue-600' : ''"
                class=" hover:text-blue-600 cursor-pointer" @click="filterItems('mine')">My entries
                ({{ myActiveRowsCount  || '0'}}) </span>
            |
            <span :class="prevShiftActiveLink ? 'font-semibold text-blue-600' : ''"
                class=" hover:text-blue-600 cursor-pointer" @click="filterItems('prev_shift')">Previous Shift
                ({{ prevShiftRowsCount  || '0'}}) </span>
            |
            <span :class="currShiftActiveLink ? 'font-semibold text-blue-600' : ''"
                class=" hover:text-blue-600 cursor-pointer" @click="filterItems('curr_shift')">Current Shift
                ({{ currShiftRowsCount  || '0'}}) </span>
        </p>

        <div v-show="!isLoading" class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell">
                                ID
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{eventTitleHeader}}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell">
                                Date/Time
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell">
                                Logged By
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white" v-for="(item, index) in displayedRows" :key="`${index}-${item.id}`">
                            <td class="px-5 py-5 border-b border-gray-200  text-sm hidden md:table-cell">
                                <div class="flex">

                                    <div class="w-full flex justify-between ml-3">
                                        <div>
                                            <p class="text-gray-900 ">
                                                {{item.title}}
                                            </p>
                                            <p class="text-gray-600">{{item.id}}</p>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-3 border-b border-gray-200  text-sm">
                                <span v-if="model === 'O2'">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                        <span :class="item.status == 1 ? 'bg-green-200' : 'bg-red-200'"
                                            class="absolute inset-0  opacity-50 rounded-full"></span>
                                        <span v-if="item.status == 1" class="relative text-green-900">O2 On</span>
                                        <span v-if="item.status == 0" class="relative text-red-900">O2 Off </span>
                                    </span>
                                    <span v-if="item.status == 0"
                                        class="relative text-gray-600">({{item.treatment_time}} mins) </span>
                                </span>

                                <span v-else-if="model === 'Desat'" class="font-semibold text-xl text-orange-700">
                                    {{item.desat_value}}
                                </span>
                                <span v-else-if="model === 'Envvar'">
                                    {{item.temperature}}{{item.temperature_type}} / {{item.humidity}}%
                                </span>
                                <span v-else-if="model === 'Awakesleep'">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                        <span :class="item.status == 1 ? 'bg-green-200' : 'bg-red-200'"
                                            class="absolute inset-0  opacity-50 rounded-full"></span>
                                        <span v-if="item.status == 1" class="relative text-green-900">Woke up </span>
                                        <span v-if="item.status == 0" class="relative text-red-900">Went to sleep</span>
                                    </span>
                                    <p v-if="item.status == 1" class="relative text-gray-600 px-2 py-1">Slept -
                                        {{item.sleep_time}} mins</p>
                                </span>
                                <p class="text-gray-600" v-else>{{eventTitle}} event</p>

                                <!-- DISPLAY FOR MOBILE IN THIS CELL -->
                                <p class="text-gray-900 whitespace-no-wrap md:hidden">
                                    {{item.created_at | moment1 }}</p>
                                <p v-if="item.created_at" class="text-gray-600 whitespace-no-wrap">
                                    {{item.created_at | moment2  }} </p>

                                <p class="text-gray-900 mt-2 md:mt-0 md:hidden">{{item.user.name}}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200  text-sm hidden md:table-cell">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{item.created_at | moment1 }}</p>
                                <p v-if="item.created_at" class="text-gray-600 whitespace-no-wrap">
                                    {{item.created_at | moment2  }} </p>
                            </td>
                            <td class="px-5 py-3 border-b border-gray-200  text-sm hidden md:table-cell">
                                <p class="text-gray-900 ">{{item.user.name}}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex mx-6 border-b-2 border-gray-200 bg-white"></div>
                <div class="flex px-6 justify-between h-12 bg-white">
                    <div class="flex justify-start ">
                        <div class="text-gray-600 text-sm text-center px-2 py-2">page {{page}} of
                            {{pages.length}} </div>
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
</template>

<script>
import Dropdown from "../Dropdown";

    export default {
        props: ['model', 'eventTitleHeader', 'eventTitle'],
        components: {
            Dropdown
        },
        data: () => ({
            isLoading: false,
            showModal: false,
            showAlert: false,
            alertmessage: null,
            rows: [],
            page: 1,
            pages: [],
            pageNumber: '',
            tablePerPage: 10,
            tableTotalRows: '',
            allActiveLink: true,
            mineActiveLink: false,
            myActiveRowsCount: null,
            prevShiftRowsCount: null,
            prevShiftActiveLink: false,
            currShiftActiveLink: false,
            currShiftRows: null,
            currShiftRowsCount: null,
            dateRangeList: [
                { "id": 7, "name": "Last 7 days", "link": "#" },
                { "id": 30, "name": "Last 30 days", "link": "#" },
                { "id": 60, "name": "Last 60 days", "link": "#" },
                { "id": 90, "name": "Last 90 days", "link": "#" },
                { "id": 180, "name": "Last 180 days", "link": "#" },
                { "id": 365, "name": "Last year", "link": "#" },
                { "id": 7, "name": "Reset", "link": "#" },
            ],

        }),
        methods: {
            getAllItems() {
                this.isLoading = true;
                axios
                    .post('api/get-all-log-data', {
                        model: this.model
                    })
                    .then(response => {
                        this.rows = response.data;
                        this.allActiveRows = this.rows;
                        this.myActiveRowsCount = this.rows.filter(element => element.owner_id === this.$userId).length;
                        this.thisUsersRows = this.rows.filter(element => element.owner_id == this.$userId);
                        // this.rows = rawDataRows.filter(element => element.status === '0').reverse();
                        this.isLoading = false;
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            getCurrentShiftItems() {
                axios
                    .post('api/get-logs-current-shift', {
                        model: this.model
                    })
                    .then(response => {
                        this.rows = response.data;
                        this.currShiftRows = this.rows;
                        this.currShiftRowsCount = this.currShiftRows.length;
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            getPreviousShiftItems() {
                axios
                    .post('api/get-logs-previous-shift', {
                        model: this.model
                    })
                    .then(response => {
                        this.rows = response.data;
                        this.prevShiftRows = this.rows;
                        this.prevShiftRowsCount = this.prevShiftRows.length;
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
        filterItems(filter){
            switch(filter) {
            case "all":
                this.rows = this.allActiveRows;
                this.allActiveLink = true;
                this.mineActiveLink = false;
                this.prevShiftActiveLink = false;
                this.currShiftActiveLink = false;
                break;
            case "mine":
                this.rows = this.thisUsersRows;
                this.allActiveLink = false
                this.prevShiftActiveLink = false
                this.currShiftActiveLink = false
                this.mineActiveLink = true;
                break;
            case "prev_shift":
                this.rows = this.prevShiftRows;
                this.allActiveLink = false
                this.mineActiveLink = false;
                this.prevShiftActiveLink = true;
                this.currShiftActiveLink = false;
                break;
            case "curr_shift":
                this.rows = this.currShiftRows;
                this.allActiveLink = false
                this.mineActiveLink = false;
                this.prevShiftActiveLink = false;
                this.currShiftActiveLink = true;
                break;
            default:
                this.rows = this.allActiveRows;
            }
        },
    },
    computed: {
        displayedRows() {
            // this overwrites method in helpers to display 'active' rows only
            return this.paginate(this.rows);
        }
    },
    created() {
        this.getAllItems();
        this.getCurrentShiftItems();
        this.getPreviousShiftItems();
    },
    filters: {
        moment1: function (date) {
            return moment(date).format('dddd, MMMM Do YYYY');
        },
        moment2: function (date) {
            return moment(date).format(' h:mm A');
        },
    }

    }
</script>
