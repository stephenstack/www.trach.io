<template>
    <div class=" flex flex-wrap justify-between w-full mt-4 lg:mt-8 mb-4 sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto "
        v-if="$store.getters.shift.status === 1">
        <div class="w-full lg:w-full">
            <div class="w-full mb-6 lg:mb-0  px-2 flex flex-col">
                <div
                    class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                    <div class="border-b">
                        <div class="flex justify-between px-6 items-center">
                            <h3 class="text-gray-800 py-2 font-bold text-normal">Recent Activity</h3>
                            <!-- <svg viewBox="0 0 100 125"
                                class="fill-current h-6 w-6 text-gray-500 cursor-pointer hover:text-gray-700 pt-1"
                                alt="settings" title="settings">
                                <g data-name="Group">
                                    <path data-name="Compound Path"
                                        d="M93,40.82,86.15,40a37.12,37.12,0,0,0-3.55-8.55l4.3-5.4a3,3,0,0,0-.23-4L77.9,13.33a3,3,0,0,0-4-.23l-5.4,4.3A37.09,37.09,0,0,0,60,13.85L59.18,7a3,3,0,0,0-3-2.66H43.8a3,3,0,0,0-3,2.66L40,13.85a37.1,37.1,0,0,0-8.55,3.55l-5.4-4.3a3,3,0,0,0-4,.23L13.33,22.1a3,3,0,0,0-.23,4l4.3,5.4A37.12,37.12,0,0,0,13.85,40L7,40.82a3,3,0,0,0-2.66,3V56.2a3,3,0,0,0,2.66,3l6.85.77a37.06,37.06,0,0,0,3.55,8.55l-4.3,5.4a3,3,0,0,0,.23,4l8.77,8.77a3,3,0,0,0,4,.23l5.4-4.3A37.11,37.11,0,0,0,40,86.14L40.82,93a3,3,0,0,0,3,2.66H56.2a3,3,0,0,0,3-2.66L60,86.14a37.11,37.11,0,0,0,8.55-3.55l5.4,4.3a3,3,0,0,0,4-.23l8.77-8.77a3,3,0,0,0,.23-4l-4.3-5.4A37.06,37.06,0,0,0,86.15,60L93,59.18a3,3,0,0,0,2.66-3V43.8A3,3,0,0,0,93,40.82ZM62.09,62.09a16.91,16.91,0,0,1-24.18,0,16.91,16.91,0,0,1,0-24.18,16.91,16.91,0,0,1,24.18,0,16.91,16.91,0,0,1,0,24.18Z" />
                                </g>
                            </svg> -->
                        </div>
                    </div>
<div v-if="isLoading"  class="linePreloader w-full"></div>

                    <!-- UX/UI Badges Collection https://thenounproject.com/im04/collection/basic-uiux-badge/ -->
                    <div class="flex-grow flex px-2 py-2 text-grey-darker items-center  " v-for="action in actions"
                        :key="action.id">
                        <div class="w-2/5 md:w-1/2 mx-4 flex items-center">
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
                            <span class="text-sm font-base text-gray-700 w-full ml-2">{{action.action}}
                                {{ action.action_model }}</span>
                        </div>

                        <div class="hidden md:flex lg:hidden xl:flex w-1/4 px-4 items-center">
                            {{action.user.name}}
                        </div>
                        <div class="block w-1/2 mr-6">
                            <!---->
                            <p class="text-sm font-semibold text-right text-gray-600">Record ID: {{action.action_id}}
                            </p>
                            <p class="text-sm text-gray-500 text-right"> {{action.updated_at | countTimeAgo}}</p>
                        </div>
                    </div>
                    <div class="px-6 py-2 bg-gray-100 border-t">
                        <div class="flex justify-end text-sm ">
                            <span class="text-gray-600">
                                <router-link to="/useractions"
                                    class="px-2 bg-transparent p-3 rounded-lg text-indigo-500 hover:text-indigo-400 mr-2">
                                    View all activity
                                </router-link>
                            </span>
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
            actions: {},
            isLoading: false,
        }),
        methods: {
            getUserActions(){
                this.isLoading = true;
               axios
                  .get('api/user-actions-latest/5' )
                  .then(response => {
                      this.actions = response.data;
                        this.isLoading = false;
                  })
                  .catch(error => {
                      console.log(error)
                  })
            }
        },
        mounted() {
            this.getUserActions();
        },
        filters: {
            countTimeAgo: function (value) {
                return moment(value).fromNow();
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>