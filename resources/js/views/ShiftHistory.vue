<template>
    <div class="flex-1 overflow-auto border-l-2 border-gray-200" >
        <!-- https://medium.com/@obapelumi/pagination-with-vuejs-1f505ce8d15b -->
        <div class="flex-1">
            <div class="w-full sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto">
                <div class="w-full text-gray-700 font-semibold text-xl">
                </div>
                <div class="flex w-full justify-between items-center py-4 text-gray-700 font-semibold ">
                    <header class="w-3/4 text-gray-700 font-semibold text-xl">Shift History Log <span class="text-sm text-gray-600">({{ rows.length}})</span></header>
                    <router-link :to="'/shifthistory'"
                    class="px-2 text-base bg-transparent rounded-lg text-indigo-500 hover:text-indigo-400">View All</router-link>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4">
                    <div class="inline-block min-w-full shadow-md rounded-lg ">
                        <table class="min-w-full leading-normal ">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Who
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        When
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Duration
                                    </th>
                                </tr>
                            </thead>
                            <td v-show="isLoading" colspan="6" class="linePreloader w-full"></td>
                            <tbody v-show="!isLoading" >
                                <span v-if="rows.length === 0" class="px-4 h-8 text-lg font-semibold text-gray-700"> No Data</span>
                                <tr v-for="(shift, index) in displayedRows" :key="index">
                                    <td class="flex items-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                            <span :class="shift.status == 1 ? 'bg-green-200' : 'bg-red-200'"
                                                class="absolute inset-0  opacity-50 rounded-full"></span>
                                            <span v-if="shift.status == 1"
                                                class="relative text-green-900">Logged In</span>
                                            <span v-if="shift.status == 0"
                                                class="relative text-red-900">Logged Out</span>
                                        </span>
                                    </td>

                                    <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                        <span class="text-sm font-base text-gray-700 w-full ml-2">{{shift.user.name}}</span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="relative inline-block py-1 font-semibold leading-tight">
                                            <span v-if="shift.status == 1"
                                                class="">{{shift.time_in | moment }}</span>
                                            <span v-else
                                                class="">{{shift.actual_time_out | moment }}</span>
                                        </span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                       <span v-if="shift.duration"
                                            class="text-sm font-base text-gray-700 w-full ml-2">{{shift.duration}} hrs</span>
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
                                <div class="text-gray-700 text-center bg-white px-4 py-1 mr-2  rounded  cursor-pointer hover:font-bold" v-if="page != 1" @click="page--">Previous</div>
                                <div :class="page === pageNumber ? 'text-white bg-purple-400' : 'text-gray-700 bg-white' " class=" text-center px-4 py-1 mr-2 rounded cursor-pointer hover:font-bold" v-for="pageNumber in pages" @click="page = pageNumber" :key="pageNumber">{{pageNumber}}</div>
                                <div class="text-gray-700 text-center bg-white px-4 py-1 mr-2  rounded  cursor-pointer hover:font-bold" @click="page++" v-if="page < pages.length">Next</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        pagename: 'user',
        isLoading: false,
        rows: [],
        page: 1,
        pages: [],
        pageNumber: '',
        tablePerPage: 10,
        tableTotalRows: '',
        selectedIndex: '',
        selectedItemName: '',
    }),
    components: {

    },
    methods: {
        getShiftHistory(){
            this.isLoading = true;
            let id = (this.$route.params.id) ? this.$route.params.id : '';
            axios
                .get('api/shift-history/' + id)
                .then(response => {
                    this.rows = response.data.reverse();
                    this.isLoading = false;
                })
                .catch(error => {
                    console.log(error)
                })
        },
    },
        filters: {
            moment: function (date) {
                return moment(date).format('MMMM D, YYYY - H:mm');
            },
            countTimeAgo: function (value) {
                return moment(value).fromNow();
            }
        },
    mounted() {
        this.getShiftHistory();
    },
    watch: {
        $route() {
        this.getShiftHistory(); // forces a data reload when route changes i.e. clicks on reset all
        }
    }
}
</script>

<style>
.dropdown-content {
  display: none;
  position: absolute;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>