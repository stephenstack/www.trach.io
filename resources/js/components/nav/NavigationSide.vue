<template>
    <div class="h-screen overflow-none bg-white sticky top-0">
        <div :class="sidebarOpen ? 'block' : 'hidden'"
            class="fixed inset-0 bg-black opacity-50 transition-opacity lg:hidden" @click="sidebarOpen = false"></div>
        <div :class="sidebarOpen ? 'translate-x-0 ease-out transition-medium' : '-translate-x-full ease-in transition-medium'"
            class="h-full fixed z-30 inset-y-0 left-0 w-64 overflow-auto bg-white lg:static lg:inset-auto lg:translate-x-0">
            <div class="flex items-center justify-between py-4">
                <span class="flex items-center px-8 ">
                    <img src="images/logos/FullColor_SideBySide_TransparentBg_2700_72dpi-126_x_48.png" />
                </span>
                <button @click="sidebarOpen = false" class="text-xl text-gray-600 lg:hidden mr-2">
                    <svg viewBox="0 0 100 125" class="fill-current text-gray-500 hover:text-gray-600 h-8 w-8">
                        <g transform="translate(0,-952.36218)">
                            <path
                                d="m 76.8701,975.49204 c -1.56215,-1.5621 -4.09479,-1.562 -5.65687,0 l -21.21326,21.2133 -21.21321,-21.2132 c -1.56206,-1.5621 -4.0947,-1.5621 -5.65685,0 -1.56215,1.5622 -1.56208,4.0948 10e-6,5.6569 l 21.21319,21.21316 -21.21313,21.2131 c -1.56207,1.5621 -1.56215,4.0947 0,5.6569 1.56214,1.5621 4.09478,1.562 5.65686,0 l 21.21313,-21.2132 21.21321,21.2132 c 1.56206,1.5621 4.0947,1.5622 5.65685,0 1.56214,-1.5621 1.56207,-4.0947 -1e-5,-5.6568 l -21.2132,-21.2132 21.21328,-21.21326 c 1.56206,-1.5621 1.56214,-4.0947 0,-5.6569 z" />
                        </g>
                    </svg>
                </button>
            </div>
            <nav class="mt-4 px-8 ">
                <!-- <h2 class="text-xs font-semibold text-gray uppercase tracking-wide">Iss</h2> -->
                <div class="">
                    <nav class="mt-2">
                        <div class="flex mt-4">
                            <router-link to="/"
                                :class="currentPage === '/' || currentPage === '/' ? 'text-blue-600' : ''"
                                class="flex items-center no-underline text-gray-600 hover:text-blue-600">
                                <svg viewBox="0 0 576 512"
                                    class="fill-current w-6 h-6 mr-2 group-hover:text-blue-600 h-6">
                                    <path fill="currentColor"
                                        d="M280.37 148.26L96 300.11V464a16 16 0 0016 16l112.06-.29a16 16 0 0015.92-16V368a16 16 0 0116-16h64a16 16 0 0116 16v95.64a16 16 0 0016 16.05L464 480a16 16 0 0016-16V300L295.67 148.26a12.19 12.19 0 00-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 00-12-12h-56a12 12 0 00-12 12v72.61L318.47 43a48 48 0 00-61 0L4.34 251.47a12 12 0 00-1.6 16.9l25.5 31A12 12 0 0045.15 301l235.22-193.74a12.19 12.19 0 0115.3 0L530.9 301a12 12 0 0016.9-1.6l25.5-31a12 12 0 00-1.7-16.93z" />
                                </svg>
                                <span
                                    :class="currentPage === '/' || currentPage === '/' ? 'font-semibold text-blue-600' : ''"
                                    class="pl-2">Dashboard</span>
                            </router-link>
                        </div>

                        <div class="flex mt-4">
                            <router-link to="/reports" :class="currentPage === '/reports'  ? 'text-blue-600' : ''"
                                class="flex items-center no-underline text-gray-600 hover:text-blue-600">
                                <svg viewBox="0 0 512 512"
                                    class="fill-current w-6 h-6 mr-2 group-hover:text-blue-600 h-6">
                                    <path fill="currentColor"
                                        d="M496 384H64V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM464 96H345.94c-21.38 0-32.09 25.85-16.97 40.97l32.4 32.4L288 242.75l-73.37-73.37c-12.5-12.5-32.76-12.5-45.25 0l-68.69 68.69c-6.25 6.25-6.25 16.38 0 22.63l22.62 22.62c6.25 6.25 16.38 6.25 22.63 0L192 237.25l73.37 73.37c12.5 12.5 32.76 12.5 45.25 0l96-96 32.4 32.4c15.12 15.12 40.97 4.41 40.97-16.97V112c.01-8.84-7.15-16-15.99-16z" />
                                </svg>
                                <span :class="currentPage === '/reports' ? 'font-semibold text-blue-600' : ''"
                                    class="pl-2">Reports</span>
                            </router-link>
                        </div>

                        <div class="flex mt-4">
                            <router-link to="/notes" :class="currentPage === '/notes'  ? 'text-blue-600' : ''"
                                class="flex items-center no-underline text-gray-600 hover:text-blue-600">
                                <svg viewBox="0 0 448 512"
                                    class="fill-current w-6 h-6 mr-2 group-hover:text-blue-600 h-6">
                                    <path fill="currentColor"
                                        d="M312 320h136V56c0-13.3-10.7-24-24-24H24C10.7 32 0 42.7 0 56v400c0 13.3 10.7 24 24 24h264V344c0-13.2 10.8-24 24-24zm129 55l-98 98c-4.5 4.5-10.6 7-17 7h-6V352h128v6.1c0 6.3-2.5 12.4-7 16.9z" />
                                </svg>
                                <span :class="currentPage === '/notes' ? 'font-semibold text-blue-600' : ''"
                                    class="pl-2">Notes</span>
                            </router-link>
                        </div>

                        <div class="mt-4">
                            <router-link to="/notifications"
                                :class="currentPage === '/notifications' ? 'text-blue-600' : ''"
                                class="flex items-center relative no-underline text-gray-600 group hover:text-blue-600">
                                <svg viewBox="0 0 448 512"
                                    class="fill-current w-6 h-6 mr-2 group-hover:text-blue-600 h-6">
                                    <path fill="currentColor"
                                        d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z" />
                                </svg>
                                <span v-if="this.$store.getters.notification_count > 0"
                                    class="absolute pin-r pin-t -mt-2 ml-2 rounded-full bg-red-600 px-1 text-xs shadow text-white">{{this.$store.getters.notification_count}}</span>
                                <span :class="currentPage === '/notifications' ? 'font-semibold text-blue-600' : ''"
                                    class="pl-2">Notifications</span>
                            </router-link>
                        </div>
                        <div v-if="this.$roleId <= 2" class="mt-4">
                            <router-link to="/team" :class="currentPage === '/team' ? 'text-blue-600' : ''"
                                class="flex items-center no-underline text-gray-600 group hover:text-blue-600">
                                <svg viewBox="0 0 640 512"
                                    class="fill-current w-6 h-6 mr-2 group-hover:text-blue-600 h-6">
                                    <path fill="currentColor"
                                        d="M610.5 341.3c2.6-14.1 2.6-28.5 0-42.6l25.8-14.9c3-1.7 4.3-5.2 3.3-8.5-6.7-21.6-18.2-41.2-33.2-57.4-2.3-2.5-6-3.1-9-1.4l-25.8 14.9c-10.9-9.3-23.4-16.5-36.9-21.3v-29.8c0-3.4-2.4-6.4-5.7-7.1-22.3-5-45-4.8-66.2 0-3.3.7-5.7 3.7-5.7 7.1v29.8c-13.5 4.8-26 12-36.9 21.3l-25.8-14.9c-2.9-1.7-6.7-1.1-9 1.4-15 16.2-26.5 35.8-33.2 57.4-1 3.3.4 6.8 3.3 8.5l25.8 14.9c-2.6 14.1-2.6 28.5 0 42.6l-25.8 14.9c-3 1.7-4.3 5.2-3.3 8.5 6.7 21.6 18.2 41.1 33.2 57.4 2.3 2.5 6 3.1 9 1.4l25.8-14.9c10.9 9.3 23.4 16.5 36.9 21.3v29.8c0 3.4 2.4 6.4 5.7 7.1 22.3 5 45 4.8 66.2 0 3.3-.7 5.7-3.7 5.7-7.1v-29.8c13.5-4.8 26-12 36.9-21.3l25.8 14.9c2.9 1.7 6.7 1.1 9-1.4 15-16.2 26.5-35.8 33.2-57.4 1-3.3-.4-6.8-3.3-8.5l-25.8-14.9zM496 368.5c-26.8 0-48.5-21.8-48.5-48.5s21.8-48.5 48.5-48.5 48.5 21.8 48.5 48.5-21.7 48.5-48.5 48.5zM96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm224 32c1.9 0 3.7-.5 5.6-.6 8.3-21.7 20.5-42.1 36.3-59.2 7.4-8 17.9-12.6 28.9-12.6 6.9 0 13.7 1.8 19.6 5.3l7.9 4.6c.8-.5 1.6-.9 2.4-1.4 7-14.6 11.2-30.8 11.2-48 0-61.9-50.1-112-112-112S208 82.1 208 144c0 61.9 50.1 112 112 112zm105.2 194.5c-2.3-1.2-4.6-2.6-6.8-3.9-8.2 4.8-15.3 9.8-27.5 9.8-10.9 0-21.4-4.6-28.9-12.6-18.3-19.8-32.3-43.9-40.2-69.6-10.7-34.5 24.9-49.7 25.8-50.3-.1-2.6-.1-5.2 0-7.8l-7.9-4.6c-3.8-2.2-7-5-9.8-8.1-3.3.2-6.5.6-9.8.6-24.6 0-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h255.4c-3.7-6-6.2-12.8-6.2-20.3v-9.2zM173.1 274.6C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z" />
                                </svg>
                                <span :class="currentPage === '/team' ? 'font-semibold text-blue-600' : ''"
                                    class="pl-2">Team</span>
                            </router-link>
                        </div>

                        <div v-if="this.$roleId <= 2" class="mt-4">
                            <router-link to="/settings" :class="currentPage === '/settings' ? 'text-blue-600' : ''"
                                class="flex items-center no-underline text-gray-600 group hover:text-blue-600 ">
                                <svg viewBox="0 0 640 512"
                                    class="fill-current w-6 h-6 mr-2 group-hover:text-blue-600 h-6">
                                    <path fill="currentColor"
                                        d="M512.1 191l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0L552 6.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zm-10.5-58.8c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.7-82.4 14.3-52.8 52.8zM386.3 286.1l33.7 16.8c10.1 5.8 14.5 18.1 10.5 29.1-8.9 24.2-26.4 46.4-42.6 65.8-7.4 8.9-20.2 11.1-30.3 5.3l-29.1-16.8c-16 13.7-34.6 24.6-54.9 31.7v33.6c0 11.6-8.3 21.6-19.7 23.6-24.6 4.2-50.4 4.4-75.9 0-11.5-2-20-11.9-20-23.6V418c-20.3-7.2-38.9-18-54.9-31.7L74 403c-10 5.8-22.9 3.6-30.3-5.3-16.2-19.4-33.3-41.6-42.2-65.7-4-10.9.4-23.2 10.5-29.1l33.3-16.8c-3.9-20.9-3.9-42.4 0-63.4L12 205.8c-10.1-5.8-14.6-18.1-10.5-29 8.9-24.2 26-46.4 42.2-65.8 7.4-8.9 20.2-11.1 30.3-5.3l29.1 16.8c16-13.7 34.6-24.6 54.9-31.7V57.1c0-11.5 8.2-21.5 19.6-23.5 24.6-4.2 50.5-4.4 76-.1 11.5 2 20 11.9 20 23.6v33.6c20.3 7.2 38.9 18 54.9 31.7l29.1-16.8c10-5.8 22.9-3.6 30.3 5.3 16.2 19.4 33.2 41.6 42.1 65.8 4 10.9.1 23.2-10 29.1l-33.7 16.8c3.9 21 3.9 42.5 0 63.5zm-117.6 21.1c59.2-77-28.7-164.9-105.7-105.7-59.2 77 28.7 164.9 105.7 105.7zm243.4 182.7l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0l8.2-14.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zM501.6 431c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.6-82.4 14.3-52.8 52.8z" />
                                </svg>
                                <span :class="currentPage === '/settings' ? 'font-semibold text-blue-600' : ''"
                                    class="pl-2">Settings</span>
                            </router-link>
                        </div>
                    </nav>
                </div>

                <div class="absolute bottom-0 mb-8">
                    <router-link to="/support" class="no-underline">
                        <div
                            class="flex items-center  w-40 rounded-full bg-blue-600 shadow hover:bg-blue-500 font-normal text-sm text-white px-4 py-1 px-4 cursor-pointer justify-center hover:shadow-xl">
                            <svg viewBox="0 0 512 512" class="px-2 w-8 h-8 h-6">
                                <path fill="currentColor"
                                    d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm107.244-255.2c0 67.052-72.421 68.084-72.421 92.863V300c0 6.627-5.373 12-12 12h-45.647c-6.627 0-12-5.373-12-12v-8.659c0-35.745 27.1-50.034 47.579-61.516 17.561-9.845 28.324-16.541 28.324-29.579 0-17.246-21.999-28.693-39.784-28.693-23.189 0-33.894 10.977-48.942 29.969-4.057 5.12-11.46 6.071-16.666 2.124l-27.824-21.098c-5.107-3.872-6.251-11.066-2.644-16.363C184.846 131.491 214.94 112 261.794 112c49.071 0 101.45 38.304 101.45 88.8zM298 368c0 23.159-18.841 42-42 42s-42-18.841-42-42 18.841-42 42-42 42 18.841 42 42z" />
                            </svg>
                            <span>Support</span>
                        </div>
                    </router-link>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
import {navToggleBus} from '../../app';
export default {
    data: () => ({
        sidebarOpen: false,
        roleId: null,

    }),
    methods: {
        toggleMenu() {
            this.sidebarOpen = !this.sidebarOpen;
            navToggleBus.$emit('toggle-nav-event', this.sidebarOpen);
        }
    },
    mounted() {
        navToggleBus.$on('toggle-nav-event', (value) => {
            this.sidebarOpen = value;
        });
        this.$store.dispatch('GET_NOTIFICATIONCOUNT');
    },
    computed: {
        currentPage(){
            return this.$route.path;
        }
    }
}
</script>