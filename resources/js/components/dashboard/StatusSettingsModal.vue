<template>
    <transition name="fade">
        <div v-show="showModal">
        <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" >
            <div @click="$emit('close')" class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div
                class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto -mt-40">

                <div class="bg-white rounded-lg w-full">

                    <div class="w-full bg-white rounded-lg mx-auto flex overflow-hidden rounded-b-none">
                        <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                            <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Status Thresholds</h2>
                            <p class="text-xs text-gray-500">Configure warning and alert settings for various
                                interventions.</p>
                                <br/>
                            <p><a href="#" @click="resetThresholds()" class="text-sm rounded-lg text-indigo-500 hover:text-indigo-400">Reset Thresholds</a></p>
                        </div>
                        <div class="md:w-full w-full">
                            <div @click="close" class="modal-close flex justify-end cursor-pointer z-50 p-3">
                                <svg class="fill-current text-gray-500 hover:text-gray-800 "
                                    xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                            <div class="pb-8 px-4 lg:px-16">
                                <div class="flex items-center w-full">
                                    <div class="flex flex-wrap items-center w-full">
                                        <div class="w-1/2 py-3">
                                            <span for="o2_threshold" class="text-gray-600">O2 Threshold</span>
                                        </div>
                                        <div class="w-1/2 flex items-center">
                                            <input name="o2_threshold" type="number"
                                                class="w-16 my-2 border-2 border-gray-300 px-2 py-1 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                                                v-model="o2_threshold">
                                                <span for="o2_threshold" class="text-gray-600 px-2">litres</span>
                                        </div>

                                        <div class="w-1/2 py-3">
                                            <span for="cough_threshold" class="text-gray-600">Cough Assist</span>
                                        </div>
                                        <div class="w-1/2 flex items-center">
                                            <input name="cough_threshold" type="number"
                                                class="w-16 my-2 border-2 border-gray-300 px-2 py-1 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                                                v-model="cough_threshold"><span for="o2_threshold"
                                                class="text-gray-600 px-2">minutes </span>
                                        </div>

                                        <div class="w-1/2 py-3">
                                            <span for="desat_threshold" class="text-gray-600">Desat</span>
                                        </div>
                                        <div class="w-1/2 flex items-center">
                                            <input name="desat_threshold" type="number"
                                                class="w-16 my-2 border-2 border-gray-300 px-2 py-1 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                                                v-model="desat_threshold"><span for="o2_threshold"
                                                class="text-gray-600 px-2">o2 sats </span>
                                        </div>

                                        <div class="w-1/2 py-3">
                                            <span for="neb_threshold" class="text-gray-600">Nebulizer</span>
                                        </div>
                                        <div class="w-1/2 flex items-center">
                                            <input name="neb_threshold" type="number"
                                                class="w-16 my-2 border-2 border-gray-300 px-2 py-1 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                                                v-model="neb_threshold"><span for="o2_threshold"
                                                class="text-gray-600 px-2">minutes </span>
                                        </div>

                                        <div class="w-1/2 py-3">
                                            <span for="env_numarray" class="text-gray-600">Environment</span>
                                        </div>
                                        <div class="w-1/2 flex items-center">
                                            <input name="env_numarray1" type="number"
                                                class="w-16 my-2 border-2 border-gray-300 px-2 py-1 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                                                v-model="env_numarray[1]">
                                            <input name="env_numarray0" type="number"
                                                class="w-16 my-2 border-2 border-gray-300 px-2 py-1 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                                                v-model="env_numarray[0]"><span for="o2_threshold"
                                                class="text-gray-600 px-2">{{this.$store.getters.env_temp_scale}} / % </span>
                                        </div>

                                        <div class="w-1/2 py-3">
                                            <span for="suction_threshold" class="text-gray-600">Suction</span>
                                        </div>
                                        <div class="w-1/2 flex items-center">
                                            <input name="suction_threshold" type="number"
                                                class="w-16 my-2 border-2 border-gray-300 px-2 py-1 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                                                v-model="suction_threshold"><span for="o2_threshold"
                                                class="text-gray-600 px-2">minutes </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                    <p class="hidden md:flex float-left text-xs text-gray-500 tracking-tight mt-2">Save your settings</p>
                    <button @click="saveSettings()"
                        class="bg-indigo-500 text-white text-sm font-medium ml-2 px-6 py-2 rounded float-right uppercase cursor-pointer hover:shadow-xl">Save</button>
                    <button @click="close()"
                        class="bg-transparent text-indigo-300 text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:text-indigo-500">Cancel</button>
                </div>
            </div>
        </div>
        </div>
    </transition>
</template>

<script>

export default {
    props: [ 'showModal', 'event_actions' ],
    data: () => ({
        recipient_email: null,
        errors: [],
        env_numarray: [],
    }),
    methods: {
        resetThresholds(){
        axios
            .post('api/set-event-action-thresholds', {
                o2: 1,
                cough: 0,
                desat: 92,
                neb: 120,
                environment: 50.33,
                suction: 60
            })
            .then(response => {
                this.$store.dispatch('GET_EVENTACTIONS');
                this.$emit('alert', {status: 'success', message: 'Action thresholds reset to defaults, thanks!'});
            })
            .catch(error => {
                console.log(error)
            })
        },
        saveSettings(){
        axios
            .post('api/set-event-action-thresholds', {
                o2: this.o2_threshold,
                cough: this.cough_threshold,
                desat: this.desat_threshold,
                neb: this.neb_threshold,
                environment: this.env_numarray[0]+'.'+this.env_numarray[1],
                suction: this.suction_threshold
            })
            .then(response => {
                this.$emit('alert', {status: 'success', message: 'Action thresholds updated, thanks!'});
            })
            .catch(error => {
                console.log(error)
            })
        },
        close(){
            this.$emit('close');
        },
        reset(){
            this.recipient_email = null;
        },
       setEnvNumArray(){
            this.env_numarray = this.$store.getters.event_actions[5].thresholds.split('.');
        }
    },
    mounted(){
        this.setEnvNumArray();
    },
    computed: {
        o2_threshold: {
            get () {
                return this.$store.getters.event_actions[0].thresholds;
            },
            set (value) {
                this.$store.commit('SET_EVENTACTIONS_O2_THRESHOLD', value)
            }
        },
        cough_threshold: {
            get () {
                return this.$store.getters.event_actions[2].thresholds;
            },
            set (value) {
                this.$store.commit('SET_EVENTACTIONS_COUGH_THRESHOLD', value)
            }
        },
        desat_threshold: {
            get () {
                return this.$store.getters.event_actions[3].thresholds;
            },
            set (value) {
                this.$store.commit('SET_EVENTACTIONS_DESAT_THRESHOLD', value)
            }
        },
        neb_threshold: {
            get () {
                return this.$store.getters.event_actions[4].thresholds;
            },
            set (value) {
                this.$store.commit('SET_EVENTACTIONS_NEB_THRESHOLD', value)
            }
        },
        suction_threshold: {
            get () {
                return this.$store.getters.event_actions[1].thresholds;
            },
            set (value) {
                this.$store.commit('SET_EVENTACTIONS_SUCTION_THRESHOLD', value)
            }
        },
    }
}

</script>
