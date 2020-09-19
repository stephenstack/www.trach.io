<template>
    <div class="flex-1 overflow-auto border-l-2 border-gray-200" >
        <!-- https://medium.com/@obapelumi/pagination-with-vuejs-1f505ce8d15b -->
        <div class="flex-1">
            <div class="w-full sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto">
                <div class="w-full text-gray-700 font-semibold text-xl">
                </div>
                <div class="flex w-full justify-between items-center py-4 text-gray-700 font-semibold ">
                    <header class="w-3/4 text-gray-700 font-semibold text-xl">User Actions Log <span class="text-sm text-gray-600">({{ rows.length}})</span></header>
                    <router-link :to="'/useractions'"
                    class="px-2 text-base bg-transparent rounded-lg text-indigo-500 hover:text-indigo-400">View All</router-link>
                </div>

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4  ">
                    <div class="inline-block min-w-full shadow-md rounded-lg ">
                        <table class="min-w-full leading-normal ">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Action
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Item
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        By
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        When
                                    </th>
                                </tr>
                            </thead>
                            <td v-show="isLoading" colspan="6" class="linePreloader w-full"></td>
                            <tbody v-show="!isLoading" >
                                <span v-if="rows.length === 0" class="px-4 h-8 text-lg font-semibold text-gray-700"> No Data</span>
                                <tr v-for="(action, index) in displayedRows" :key="index">
                                    <td class="flex items-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="" v-if="action.action == 'Added'">
                                            <svg class="fill-current text-green-500 h-6 w-6 mt-2 " viewBox="0 0 16 20">
                                                <path
                                                    d="M8,0C3.582,0,0,3.582,0,8s3.582,8,8,8s8-3.582,8-8S12.418,0,8,0z M12.68,8.3H8.3v4.38H7.7V8.3H3.32V7.7H7.7V3.32h0.6V7.7  h4.38V8.3z" />
                                            </svg>
                                        </div>
                                        <div class="" v-if="action.action == 'Edited'">
                                            <svg class="fill-current text-blue-500 h-6 w-6 mt-2 " viewBox="0 0 16 20">
                                                <rect x="4.601" y="7.034"
                                                    transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.7023 7.8382)" width="6.019"
                                                    height="2.709" />
                                                <path
                                                    d="M8,0C3.582,0,0,3.582,0,8s3.582,8,8,8s8-3.582,8-8S12.418,0,8,0z M12.892,5.87l-6.24,6.24  c-0.039,0.038-0.087,0.066-0.14,0.079l-3.12,0.78c-0.024,0.006-0.048,0.009-0.073,0.009c-0.079,0-0.155-0.031-0.212-0.088  c-0.074-0.075-0.104-0.182-0.079-0.285l0.78-3.12c0.013-0.053,0.041-0.101,0.079-0.139l6.24-6.24c0.112-0.112,0.313-0.112,0.425,0  l2.34,2.34C13.009,5.563,13.009,5.753,12.892,5.87z" />
                                                <polygon points="3.733,12.266 5.853,11.736 4.263,10.146 " />
                                                <rect x="9.927" y="3.914"
                                                    transform="matrix(0.707 -0.7072 0.7072 0.707 -0.5819 9.132)" width="1.606"
                                                    height="2.709" /></svg>
                                        </div>
                                        <div class="" v-if="action.action == 'Deleted'">

                                            <svg class="fill-current text-red-500 h-6 w-6 mt-2 " viewBox="0 0 16 20">
                                                <path
                                                    d="M8,0C3.582,0,0,3.582,0,8s3.582,8,8,8s8-3.582,8-8S12.418,0,8,0z M12.68,8.3H3.32V7.7h9.36V8.3z" />
                                            </svg>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                        <span class="text-sm font-base text-gray-700 w-full ml-2">{{action.action_model}}</span>
                                    </td>
                                    <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                        <span class="text-sm font-base text-gray-700 w-full ml-2">{{action.user.name}}</span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="relative inline-block py-1 font-semibold leading-tight">
                                            {{action.created_at | moment("MMMM D, YYYY - H:mm")}}
                                        </span>
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
        getActivities(){
            this.isLoading = true;
            let id = (this.$route.params.id) ? this.$route.params.id : '';
            axios
                .get('api/user-actions/' + id)
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
            countTimeAgo: function (value) {
                return moment(value).fromNow();
            }
        },
    mounted() {
        this.getActivities();
    },
    watch: {
        $route() {
        this.getActivities(); // forces a data reload when route changes i.e. clicks on reset all
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