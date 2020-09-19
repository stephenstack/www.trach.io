<template>
    <transition name="fade">
        <div v-show="showModal">
        <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div @click="$emit('close')" class="modal-backdrop modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div
                class="modal modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto -mt-40">
                <div class="bg-white rounded-lg w-full">

                        <div class="w-full bg-white rounded-lg mx-auto flex overflow-hidden rounded-b-none">
                            <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                                <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Shift Sign-in</h2>
                                <p class="text-xs text-gray-500">Sign in to your shift here. Make sure an select an estimated sign out time. Its useful for reporting statistics later. Thanks!</p>
                            </div>
                            <div class="md:w-full w-full">
                            <div @click="close" class="modal-close flex justify-end cursor-pointer z-50 p-3">
                                <svg class="fill-current text-gray-500 hover:text-gray-800 " xmlns="http://www.w3.org/2000/svg"
                                    width="18" height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>

                                <div class="pb-8 px-4 lg:px-16">
                                    <div class="w-full">
                                        <div class="items-start">
                                            <p class="w-full"><strong>User:</strong> {{this.$userName}}</p>
                                            <p class="w-full"><strong>Time:</strong> {{datenow}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <p class="w-1/2"><strong>Expected sign-out time:</strong><p class="text-sm text-gray-500">Click to select time</p>
                                            <Timepicker v-model="timepicker" :options="pickerSetting"  class="absolute z-50"></Timepicker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 lg:p-16 py-4 lg:py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                            <p class="hidden md:flex hidden md:flex float-left text-xs text-gray-500 tracking-tight mt-2">We'll get you signed in!</p>
                            <button
                                @click="signIn()"
                                class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:shadow-xl">Sign in</button>
                            <button @click="close()"
                                class="bg-transparent text-indigo-300 text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:text-indigo-500">Cancel</button>

                        </div>
                </div>
            </div>
        </div>
        </div>
    </transition>
</template>

<script>
import Timepicker from 'vue-simple-timepicker';

export default {
    props: [ 'showModal' ],
    data: () => ({
        datenow: '',
        timepicker: {
            hours: 0,
            minutes: 0,
        },
        pickerSetting: {
            headerShow: false,
        },
    }),
    components: {Timepicker},
    methods: {
        signIn(){
            axios
                .post('api/shift-sign-in', {
                    expected_time_out_hours: this.timepicker.hours,
                    expected_time_out_minutes: this.timepicker.minutes,
                })
                .then(response => {
                    this.$emit('signedIn', response.data.message);
                    this.close();
                })
                .catch(error => {
                     console.log(error)
                })
        },
        close() {
            this.$emit('close');
        },
        time(){
            var self = this;
            this.datenow = new Date().toLocaleString("en-US", {timeZone: this.$timezone});
        },
    },
    created() {
        document.onkeydown = evt => {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
                this.$emit("close");
            }
            if (evt.keyCode == 13) {
                this.$emit("close");
                event.preventDefault();
            }
        };
    },
    mounted() {
        this.time();
    }

}

</script>
