<template>
    <div class="w-full xl:w-2/5">
        <div class="w-full mb-6 lg:mb-  px-2 flex flex-col">
            <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="border-b">
                    <div class="flex justify-between px-6 items-center">
                        <h3 class="text-gray-800 py-2 font-bold text-normal">Current Status</h3>
                        <svg viewBox="0 0 100 125"
                        @click="openModal"
                            class="fill-current h-6 w-6 text-gray-500 cursor-pointer hover:text-gray-700 pt-1"
                            alt="settings" title="settings">
                            <g data-name="Group">
                                <path data-name="Compound Path"
                                    d="M93,40.82,86.15,40a37.12,37.12,0,0,0-3.55-8.55l4.3-5.4a3,3,0,0,0-.23-4L77.9,13.33a3,3,0,0,0-4-.23l-5.4,4.3A37.09,37.09,0,0,0,60,13.85L59.18,7a3,3,0,0,0-3-2.66H43.8a3,3,0,0,0-3,2.66L40,13.85a37.1,37.1,0,0,0-8.55,3.55l-5.4-4.3a3,3,0,0,0-4,.23L13.33,22.1a3,3,0,0,0-.23,4l4.3,5.4A37.12,37.12,0,0,0,13.85,40L7,40.82a3,3,0,0,0-2.66,3V56.2a3,3,0,0,0,2.66,3l6.85.77a37.06,37.06,0,0,0,3.55,8.55l-4.3,5.4a3,3,0,0,0,.23,4l8.77,8.77a3,3,0,0,0,4,.23l5.4-4.3A37.11,37.11,0,0,0,40,86.14L40.82,93a3,3,0,0,0,3,2.66H56.2a3,3,0,0,0,3-2.66L60,86.14a37.11,37.11,0,0,0,8.55-3.55l5.4,4.3a3,3,0,0,0,4-.23l8.77-8.77a3,3,0,0,0,.23-4l-4.3-5.4A37.06,37.06,0,0,0,86.15,60L93,59.18a3,3,0,0,0,2.66-3V43.8A3,3,0,0,0,93,40.82ZM62.09,62.09a16.91,16.91,0,0,1-24.18,0,16.91,16.91,0,0,1,0-24.18,16.91,16.91,0,0,1,24.18,0,16.91,16.91,0,0,1,0,24.18Z" />
                            </g>
                        </svg>
                    </div>
                </div>
<!-- Grayed out object - for template use only -->
                <!-- <div class="flex-grow flex px-4 py-2 text-grey-darker items-center">
                    <div class="">
                        <span class="gray-dot"></span>
                    </div>
                    <div class="block w-1/2">
                        <p class="text-sm font-semibold ml-6">O2</p>
                        <p class="text-sm text-gray-500 ml-6">--</p>
                    </div>
                    <div class="block w-1/2 mr-4">
                        <p class="text-sm font-semibold text-right">--</p>
                        <p class="text-sm text-gray-500 text-right">--</p>
                    </div>
                </div> -->
                <div class="flex-grow flex px-4 py-2 text-grey-darker items-center">
                    <div class="">
                        <span class="gray-dot" v-if="$store.getters.o2Status.status === 0"></span>
                        <span class="orange-dot" v-else-if="$store.getters.o2Status.status === 1"></span>
                        <span class="gray-dot" v-else></span>
                    </div>
                    <div class="block w-1/2">
                        <p class="text-sm font-semibold ml-6">O2</p>
                        <p class="text-sm  ml-6" :class="$store.getters.o2Status.value > $store.getters.event_actions[0].thresholds  ? 'text-red-500 ' : 'text-gray-500'"  v-if="$store.getters.o2Status.status">{{$store.getters.o2Status.value}} Litres</p>
                        <p class="text-sm text-gray-500 ml-6" v-else>--</p>
                    </div>
                    <div class="block w-1/2 mr-4">
                        <p class="text-sm font-semibold text-right" v-if="$store.getters.o2Status.status === 1">On</p>
                        <p class="text-sm font-semibold text-right" v-else-if="$store.getters.o2Status.status === 0">Off</p>
                        <p class="text-sm font-semibold text-right" v-else> -- </p>
                        <p class="text-sm text-gray-500 text-right">{{$store.getters.o2Status.created_at | countTimeAgo}}</p>
                    </div>
                </div>

                <div class="flex-grow flex px-4 py-2 text-grey-darker items-center">
                    <div class="">
                        <span class="green-dot" v-if="$store.getters.coughStatus.id"></span>
                        <span class="gray-dot" v-else></span>
                    </div>
                    <div class="block w-1/2">
                        <p class="text-sm font-semibold ml-6">Cough Assist</p>
                        <p class="text-sm text-gray-500 ml-6">Given</p>
                    </div>
                    <div class="block w-1/2 mr-4">
                        <p class="text-sm font-semibold text-right text-green-600" v-if="$store.getters.coughStatus.id">&#10003;</p>
                        <p class="text-sm text-gray-500 text-right">{{$store.getters.coughStatus.created_at | countTimeAgo}}</p>
                    </div>
                </div>
                <div class="flex-grow flex px-4 py-2 text-grey-darker items-center">
                    <div class="">
                        <span class="green-dot" v-if="$store.getters.desatStatus.desat_value >= $store.getters.event_actions[3].thresholds"></span>
                        <span class="red-dot" v-if="$store.getters.desatStatus.desat_value < $store.getters.event_actions[3].thresholds"></span>
                    </div>
                    <div class="block w-1/2">
                        <p class="text-sm font-semibold ml-6">Desat </p>
                        <p class="text-sm ml-6" :class="$store.getters.o2Status.value > $store.getters.event_actions[3].thresholds  ? 'text-red-500 ' :'text-gray-500'" >{{$store.getters.desatStatus.desat_value}}</p>
                    </div>
                    <div class="block w-1/2 mr-4">
                        <p class="text-sm font-semibold text-right text-green-600" v-if="$store.getters.desatStatus.desat_value >= $store.getters.event_actions[3].thresholds">&#10003;</p>
                        <p class="text-sm font-semibold text-right text-red-600" v-if="$store.getters.desatStatus.desat_value < 90">&#x2715;</p>
                        <p class="text-sm text-gray-500 text-right">{{$store.getters.desatStatus.created_at | countTimeAgo}}</p>
                    </div>
                </div>
                <div class="flex-grow flex px-4 py-2 text-grey-darker items-center">
                    <div class="">
                        <span class="green-dot" v-if="$store.getters.nebStatus.id"></span>
                        <span class="gray-dot" v-else></span>
                    </div>
                    <div class="block w-1/2">
                        <p class="text-sm font-semibold ml-6">Nebulizer</p>
                        <p class="text-sm text-gray-500 ml-6">2mls</p>
                    </div>
                    <div class="block w-1/2 mr-4">
                        <p class="text-sm font-semibold text-right text-green-600" v-if="$store.getters.nebStatus.id">&#10003;</p>
                        <p class="text-sm text-gray-500 text-right">{{$store.getters.nebStatus.created_at | countTimeAgo}}</p>
                    </div>
                </div>

                <div class="flex-grow flex px-4 py-2 text-grey-darker items-center">
                    <div class="">
                        <span class="green-dot" v-if="$store.getters.envStatus.id"></span>
                        <span class="gray-dot" v-else></span>
                    </div>
                    <div class="block w-1/2">
                        <p class="text-sm font-semibold ml-6">Environment</p>
                        <p class="text-sm ml-6" :class="$store.getters.envStatus.humidity < env_numarray[0] || $store.getters.envStatus.temperature < env_numarray[1] ? 'text-gray-500 ' :'text-red-500'" >
                            {{$store.getters.envStatus.humidity}}% / {{$store.getters.envStatus.temperature}}{{$store.getters.env_temp_scale.temp_scale_value}}</p>
                    </div>
                    <div class="block w-1/2 mr-4">
                        <p class="text-sm font-semibold text-right text-green-600" v-if="$store.getters.envStatus.id">&#10003;</p>
                        <p class="text-sm text-gray-500 text-right">{{$store.getters.envStatus.created_at | countTimeAgo}}</p>
                    </div>
                </div>

                <div class="flex-grow flex px-4 py-2 text-grey-darker items-center border-b">
                    <div class="">
                        <span class="green-dot" v-if="$store.getters.suctionStatus.id"></span>
                        <span class="gray-dot" v-else></span>
                    </div>
                    <div class="block w-1/2">
                        <p class="text-sm font-semibold ml-6">Suction</p>
                        <p class="text-sm text-gray-500 ml-6">Given</p>
                    </div>
                    <div class="block w-1/2 mr-4">
                        <p class="text-sm font-semibold text-right text-green-600" v-if="$store.getters.suctionStatus.id">&#10003;</p>
                        <p class="text-sm text-gray-500 text-right">{{$store.getters.suctionStatus.created_at | countTimeAgo}}</p>
                    </div>
                </div>

                <div class="px-6 py-2 bg-gray-100">
                    <div class="flex justify-between text-sm ">
                        <span class="text-gray-600">Overall Status: <span :class="status_color">{{status_text}}</span></span>
                    </div>
                </div>

            </div>
        </div>

        <status-settings-modal :showModal="showStatusSettingsModal" @close="closeModal" :event_actions="this.$store.getters.event_actions" @alert="alert($event)"></status-settings-modal>
        <alert v-if="showAlert" :messagedata="alertmessage" @close="showAlert = false"></alert>
    </div>
</template>

<script>
import Alert from '../../components/Alert';
import StatusSettingsModal from './StatusSettingsModal.vue'
export default {
    data: () => ({
        showAlert: false,
        showStatusSettingsModal: false,
        env_numarray: []
    }),
    components: {
        Alert,
        StatusSettingsModal
    },
    methods: {
        alert(event) {
            this.sendMessage(event.status, event.message);
            this.closeModal();
            //  this.sendMessage(event.status, event.message);
        },
        openModal(){
            this.showStatusSettingsModal = true;
        },
        closeModal(){
            this.showStatusSettingsModal = false;
        },
        reset(){
            this.recipient_email = null;
        },
        setEnvNumArray(){
            this.env_numarray = this.$store.getters.event_actions[5].thresholds.split('.');
        },
    },
    mounted(){
        this.$store.dispatch('GET_COUGHSSTATUS');
        this.$store.dispatch('GET_DESATSTATUS');
        this.$store.dispatch('GET_SUCTIONSSTATUS');
        this.$store.dispatch('GET_NEBSSTATUS');
        this.$store.dispatch('GET_ENVSSTATUS');
        this.$store.dispatch('GET_EVENTACTIONS');
        this.$store.dispatch('GET_ENVTEMPSCALE');
        this.setEnvNumArray();
    },
    filters: {
        countTimeAgo: function (value) {
            return moment(value).fromNow();
        }
    },
    computed: {
        status_color: function() {
            let status1 = this.$store.getters.o2Status.status === 0 ? 1 : 0; // if O2 Off, set to 1
            let status2 = 1;
            if(this.$store.getters.o2Status.status){
                let status2 = this.$store.getters.o2Status.value > this.$store.getters.event_actions[0].thresholds ? 0 : 1 ; // if O2 is higher than threashold, set to 1
            }

            let status3 = this.$store.getters.desatStatus.desat_value < this.$store.getters.event_actions[3].thresholds ? 0 : 1 ;
            let status4 = this.$store.getters.envStatus.humidity > this.env_numarray[0] ? 0 : 1 ;
            let status5 = this.$store.getters.envStatus.temperature > this.env_numarray[1] ? 0 : 1 ;
            let status = 1;
            if (status1 === 0 || status2 === 0 || status3 === 0 || status4 === 0 || status5 === 0) {
                status = 0;
            }

            let color = status === 1 ? 'text-green-500' : 'text-red-500';
            return color;
        },
        status_text: function() {
            let status1 = this.$store.getters.o2Status.status === 0 ? 1 : 0; // if O2 Off, set to 1
            let status2 = 1;
            if(this.$store.getters.o2Status.status){
                let status2 = this.$store.getters.o2Status.value > this.$store.getters.event_actions[0].thresholds ? 0 : 1 ; // if O2 is higher than threashold, set to 1
            }

            let status3 = this.$store.getters.desatStatus.desat_value < this.$store.getters.event_actions[3].thresholds ? 0 : 1 ;
            let status4 = this.$store.getters.envStatus.humidity > this.env_numarray[0] ? 0 : 1 ;
            let status5 = this.$store.getters.envStatus.temperature > this.env_numarray[1] ? 0 : 1 ;
            let status = 1;
            if (status1 === 0 || status2 === 0 || status3 === 0 || status4 === 0 || status5 === 0) {
                status = 0;
            }
            let text = status === 1 ? 'Good' : 'Not great!';
            return text;
        }
    }
}
</script>
