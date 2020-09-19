<template>
    <div class="flex-shrink-0 border-l border-gray-300 bg-gray-200">
        <header class="px-10 my-2">
            <div class="flex justify-between items-center">
                <div class="flex-1 min-w-0 flex justify-between">
                    <div class="flex justify-left items-center">
                        <div class="pr-6 -ml-4 block lg:hidden xl:hidden">
                            <svg
                                @click="toggleMenu"
                                viewBox="0 0 448 512"
                                class="text-gray-600 hover:text-gray-700 ml-4 cursor-pointer h-6"
                            >
                                <path
                                    fill="currentColor"
                                    d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"
                                />
                            </svg>
                        </div>

                        <div class="hidden lg:flex items-center">
                            <span class="text-xl text-blue-700 font-bold">{{
                                userCount
                            }}</span>
                            <span class="text-sm text-gray-700 font-light pl-1"
                                >Registered users
                            </span>
                        </div>
                        <div
                            class="ml-4 pl-4 border-l border-gray-300 hidden lg:flex items-center"
                        >
                            <img
                                :src="
                                    $store.getters.shift.status === 1
                                        ? 'images/icons8-hospital-96-green.png'
                                        : 'images/icons8-hospital-96-red.png'
                                "
                                height="32"
                                width="32"
                            />
                            <div class="text-sm text-gray-700 font-light pl-2">
                                <div
                                    class=""
                                    v-if="$store.getters.shift.status === 1"
                                >
                                    <span
                                        class="text-gray-600 font-normal tracking-wide"
                                        >{{
                                            $store.getters.shift.user.name
                                        }} </span
                                    >on duty
                                </div>
                                <div v-else>
                                    No carer on duty
                                </div>
                            </div>
                        </div>
                        <div
                            class="ml-4 pl-4 border-l border-gray-300 hidden lg:flex items-center"
                        >
                            <span
                                class="w-full text-sm text-gray-700 font-light time"
                                ><span id="theTime"></span> &nbsp;<span
                                    v-if="this.$timezone"
                                    >{{ this.$timezone }}</span
                                >
                                <span v-else class="text-sm text-red-400"
                                    >Timezone not set</span
                                ></span
                            >
                        </div>
                    </div>
                    <div class="">
                        <a
                            href="#"
                            @click.prevent="toggleUserMenu"
                            class="lg:ml-4 mr-2 my-1 sm:mr-0 md:mr-2 sm:my-1 md:my-2 flex items-center justify-start pointer-cursor"
                            id="userdropdown"
                        >
                            <p class="text-gray-700 text-right ml-2">
                                {{ this.$userName }}<br />
                            </p>
                            <svg
                                viewBox="0 0 320 512"
                                class="text-gray-600 ml-2 inline-block h-6"
                            >
                                <path
                                    fill="currentColor"
                                    d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"
                                />
                            </svg>
                        </a>
                        <transition name="slide-fade">
                            <div
                                :class="{ invisible: !userDropDownVisible }"
                                id="usermenu"
                                class="absolute pt-4 mr-2 lg:mt-12 pt-4 z-40 left-0 lg:left-auto lg:right-0 lg:top-0 lg:w-56 w-full"
                            >
                                <div
                                    class="bg-white shadow-xl rounded rounded-t-none"
                                >
                                    <ul>
                                        <li
                                            id="usermenuli"
                                            class="flex items-center py-2 px-4 border-b group hover:bg-blue-500 cursor-pointer "
                                            onclick="location.href='/profile';"
                                        >
                                            <svg
                                                class="fill-current text-gray-800 h-8 w-8 mt-2 group-hover:text-white"
                                                viewBox="0 0 100 125"
                                            >
                                                <circle
                                                    cx="50.00002"
                                                    cy="27.55556"
                                                    r="19.97233"
                                                    transform="translate(-4.84006 43.42619) rotate(-45)"
                                                />
                                                <path
                                                    d="M7.76416,92.41675H92.23584a2.74368,2.74368,0,0,0,2.753-2.95624C93.19592,69.87421,73.73871,54.451,50,54.451S6.80408,69.87421,5.01123,89.46051A2.7436,2.7436,0,0,0,7.76416,92.41675Z"
                                                />
                                            </svg>
                                            <a
                                                href="/profile"
                                                class="mt-1 pb-1 px-4 block text-gray-800 ignore-body-click group-hover:text-white"
                                                >Profile</a
                                            >
                                        </li>
                                        <li
                                            class="flex items-center py-2 px-4 border-b group hover:bg-blue-500 cursor-pointer"
                                            onclick="location.href='/logout';"
                                        >
                                            <svg
                                                class="fill-current text-gray-800 h-10 w-10 pr-2 group-hover:text-white"
                                                viewBox="0 0 77 100"
                                            >
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M37,43 C39.209139,43 41,44.790861 41,47 C41,49.209139 39.209139,51 37,51 L35.9970707,51 C34.8947455,51 34,51.8951365 34,52.9992205 L34,68.0007795 C34,69.1046129 34.8954573,70 35.9992205,70 L64.0007795,70 C65.1046129,70 66,69.1045427 66,68.0007795 L66,52.9992205 C66,51.8953811 65.1047972,51 64.0029293,51 L63,51 C60.790861,51 59,49.209139 59,47 C59,44.790861 60.790861,43 63,43 L64.0029293,43 C69.5234318,43 74,47.4774596 74,52.9992205 L74,68.0007795 C74,73.5226802 69.5230314,78 64.0007795,78 L35.9992205,78 C30.4773198,78 26,73.5230314 26,68.0007795 L26,52.9992205 C26,47.4776407 30.475685,43 35.9970707,43 L37,43 Z M52.4231712,23.0105078 L61.7609222,32.1796472 C65.5183877,35.9505572 59.8816913,41.6074221 56.1242259,37.8365121 C54.9301603,36.6236277 53.9861417,37.010179 53.9861417,38.6698732 L53.9978947,61.0000006 L53.9999994,60.9999994 C54.0011622,63.2091381 52.211244,65.0009415 50.0021053,65.0021042 C50.0014035,65.0021046 50.0007018,65.0021048 50,65.0021048 L50,65 L50,65.002256 C47.790861,65.002256 46,63.211395 46,61.002256 C46,61.0015038 46.0000002,61.0007516 46.0000006,60.9999994 L46.0148547,38.6698732 C46.0148547,37.0133583 45.0737784,36.6201938 43.9129019,37.7988168 C40.1183087,41.6074221 34.4816123,35.9505572 38.2390778,32.1796472 L47.4492517,23.0247054 C48.8179934,21.6641718 51.0452464,21.6574641 52.4231712,23.0105078 Z"
                                                            transform="translate(50.000000, 50.000000) rotate(-270.000000) translate(-50.000000, -50.000000) "
                                                        />
                                                    </g>
                                                </g>
                                            </svg>

                                            <a
                                                href="/logout"
                                                class="px-2 block text-gray-800 ignore-body-click group-hover:text-white"
                                                >Logout</a
                                            >
                                        </li>
                                        <li
                                            class="flex items-center py-3 px-6 border-b bg-gray-200 "
                                        >
                                            <span
                                                class="font-semibold text-xs text-indigo-600 ignore-body-click"
                                                :class="
                                                    this.$planName === 'Trial'
                                                        ? 'text-teal-700'
                                                        : ' text-indigo-600'
                                                "
                                                >{{
                                                    capitalizeFirstLetter(
                                                        this.$planName
                                                    )
                                                }}
                                                plan
                                                <span>
                                                    -
                                                    <a
                                                        class="text-sm text-indigo-500 hover:text-indigo-400"
                                                        href="/profile/billing"
                                                        >Upgrade</a
                                                    ></span
                                                ></span
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
import { navToggleBus } from "../../app";
export default {
    props: ["verticalNavState"],
    data: () => ({
        sidebarOpen: false,
        userCount: null,
        userDropDownVisible: false,
        time: "",
        date: ""
    }),
    methods: {
        toggleUserMenu() {
            this.userDropDownVisible = !this.userDropDownVisible;
        },
        close(e) {
            if (!this.$el.contains(e.target)) {
                this.userDropDownVisible = false;
            }
        },
        toggleMenu() {
            this.sidebarOpen = !this.sidebarOpen;
            navToggleBus.$emit("toggle-nav-event", this.sidebarOpen);
        },
        countUsers() {
            axios
                .post("api/count-tenant-users", {
                    tenant_id: this.$tenantId
                })
                .then(response => {
                    this.userCount = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        UpdateClock() {
            // from http://jsfiddle.net/mplungjan/mQrJn/
            var clockID;
            var yourTimeZoneFrom = this.$timezoneOffset; //time zone value where you are at

            var d = new Date();
            //get the timezone offset from local time in minutes
            var tzDifference = yourTimeZoneFrom * 60 + d.getTimezoneOffset();
            //convert the offset to milliseconds, add to targetTime, and make a new Date
            var offset = tzDifference * 60 * 1000;

            var tDate = new Date(new Date().getTime() + offset);
            var in_hours = tDate.getHours();
            var in_minutes = tDate.getMinutes();
            var in_seconds = tDate.getSeconds();

            if (in_minutes < 10) in_minutes = "0" + in_minutes;
            if (in_seconds < 10) in_seconds = "0" + in_seconds;
            if (in_hours < 10) in_hours = "0" + in_hours;

            document.getElementById("theTime").innerHTML =
                "" + in_hours + ":" + in_minutes + ":" + in_seconds;
        },

        startclock() {
            setInterval(this.UpdateClock, 500);
        }
    },
    mounted() {
        this.startclock();
        // console.log('Tenant ID: ' + this.$tenantId);
        this.countUsers();
        navToggleBus.$on("toggle-nav-event", value => {
            this.sidebarOpen = value;
        });
    },
    filters: {
        pageTitle: function(value) {
            let withoutSlash = value.substr(1);
            return withoutSlash.charAt(0).toUpperCase() + withoutSlash.slice(1);
        }
    },
    computed: {
        currentPage() {
            return this.$route.path;
        }
    },

    created() {
        window.addEventListener("click", this.close);
    },

    beforeDestroy() {
        window.removeEventListener("click", this.close);
    }
};
</script>

<style>
#menu-toggle:checked + #menu {
    display: block;
}

#usermenuli:first-child:before {
    border-color: transparent transparent #fff transparent;
    border-style: solid;
    border-width: 0 10px 10px 10px;
    content: "";
    height: 0;
    position: absolute;
    top: 6px;
    right: 50px;
    width: 0;
}
</style>
