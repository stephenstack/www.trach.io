<template>
    <div class="w-full xl:w-3/5">
        <div class="w-full mb-6 lg:mb-0 px-2 flex flex-col">
            <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="border-b">
                    <div class="flex justify-between px-6 items-center">
                        <h3 class="text-gray-800 py-2 font-bold text-normal">Your Assigned Tasks</h3>

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
                <div class="flex-grow flex px-2 py-2 text-grey-darker items-center border-b -mx-4">
                    <div class="w-1/2 xl:w-3/4 px-4 flex items-center">
                        <div class="rounded-full inline-flex mr-3">
                            <div :class="antibiotic_state ===  null ? '' :'hidden'"
                                class="bg-white border-2 rounded border-gray-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mx-2 focus-within:border-blue-500">
                                <input type="checkbox" id="announce_radio" class="announce_radio opacity-0 absolute"
                                    checked>
                                <svg class="fill-current hidden w-3 h-3 text-gray-500 pointer-events-none block"
                                    viewBox="0 0 20 20">
                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg>
                            </div>
                            <div :class="antibiotic_state === 1 || antibiotic_state === 0 ? '' :'hidden'"
                                class="bg-white border-2 rounded border-green-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mx-2 focus-within:border-blue-500 block">
                                <input type="checkbox" id="announce_radio" class="announce_radio opacity-0 absolute "
                                    checked>
                                <svg class="fill-current w-3 h-3 text-green-500 pointer-events-none block"
                                    viewBox="0 0 20 20">
                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <p class="text-sm font-semibold text-gray-700 w-full">Antibiotic?</p>
                            <p class="text-xs text-gray-500">Is the patient currently on an Antibiotic?</p>
                        </div>
                    </div>
                    <div class="flex justify-end w-1/2 mr-4 lg:mr-8">
                        <div class="flex inline-block">
                            <button type="button" @click="toggleAntibioticState(1)"
                                :class="antibiotic_state === 1 ? 'font-semibold text-blue-500 border-blue-500 bg-blue-100' :''"
                                class="border border-gray-400 bg-white text-gray-400 px-4 py-2 rounded rounded-r-none leading-none flex items-center hover:font-semibold hover:text-blue-500 hover:border-blue-500 hover:bg-blue-100">
                                Yes
                            </button>
                            <button type="button" @click="toggleAntibioticState(0)"
                                :class="antibiotic_state === 0 ? 'font-semibold text-blue-500 border-blue-500 bg-blue-100' :''"
                                class="border border-gray-400 bg-white text-gray-400 px-4 py-2 rounded rounded-l-none leading-none flex items-center hover:font-semibold hover:text-blue-500 hover:border-blue-500 hover:bg-blue-100">
                                No
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex-grow flex px-2 py-2 text-grey-darker items-center border-b -mx-4">
                    <div class="w-1/2 xl:w-3/4 px-4 flex items-center">
                        <div class="rounded-full inline-flex mr-3">
                            <div :class="hospital_state ===  null ? '' :'hidden'"
                                class="bg-white border-2 rounded border-gray-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mx-2 focus-within:border-blue-500">
                                <input type="checkbox" id="announce_radio" class="announce_radio opacity-0 absolute"
                                    checked>
                                <svg class="fill-current hidden w-3 h-3 text-gray-500 pointer-events-none block"
                                    viewBox="0 0 20 20">
                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg>
                            </div>
                            <div :class="hospital_state === 1 || hospital_state === 0 ? '' :'hidden'"
                                class="bg-white border-2 rounded border-green-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mx-2 focus-within:border-blue-500 block">
                                <input type="checkbox" id="announce_radio" class="announce_radio opacity-0 absolute "
                                    checked>
                                <svg class="fill-current w-3 h-3 text-green-500 pointer-events-none block"
                                    viewBox="0 0 20 20">
                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <p class="text-sm font-semibold text-gray-700 w-full">Hospital Visit or Illness?</p>
                            <p class="text-xs text-gray-500">Is the patient in hospital or Ill?</p>
                        </div>
                    </div>
                    <div class="flex justify-end w-1/2 mr-4 lg:mr-8">
                        <div class="flex inline-block">
                            <button type="button" @click="toggleHospitalState(1)"
                                :class="hospital_state === 1 ? 'font-semibold text-blue-500 border-blue-500 bg-blue-100' :''"
                                class="border border-gray-400 bg-white text-gray-400 px-4 py-2 rounded rounded-r-none leading-none flex items-center hover:font-semibold hover:text-blue-500 hover:border-blue-500 hover:bg-blue-100">
                                Yes
                            </button>
                            <button type="button" @click="toggleHospitalState(0)"
                                :class="hospital_state === 0 ? 'font-semibold text-blue-500 border-blue-500 bg-blue-100' :''"
                                class="border border-gray-400 bg-white text-gray-400 px-4 py-2 rounded rounded-l-none leading-none flex items-center hover:font-semibold hover:text-blue-500 hover:border-blue-500 hover:bg-blue-100">
                                No
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex-grow flex px-2 py-2 text-grey-darker items-center border-b -mx-4">
                    <div class="w-1/2 xl:w-3/4 px-4 flex items-center">
                        <div class="rounded-full inline-flex mr-3">
                            <div :class="ipap === null || epap === null || rate === null ? '' :'hidden'"
                                class="bg-white border-2 rounded border-gray-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mx-2 focus-within:border-blue-500">
                                <input type="checkbox" id="announce_radio" class="announce_radio opacity-0 absolute"
                                    checked>
                                <svg class="fill-current hidden w-3 h-3 text-gray-500 pointer-events-none block"
                                    viewBox="0 0 20 20">
                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg>
                            </div>
                            <div :class="ipap !== null && epap !== null && rate !== null ? '' : 'hidden'"
                                class="bg-white border-2 rounded border-green-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mx-2 focus-within:border-blue-500 block">
                                <input type="checkbox" id="announce_radio" class="announce_radio opacity-0 absolute "
                                    checked>
                                <svg class="fill-current w-3 h-3 text-green-500 pointer-events-none block"
                                    viewBox="0 0 20 20">
                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg>
                            </div>
                        </div>
                        <div class="flex flex-wrap justify-start">
                            <p class="text-sm font-semibold text-gray-700 w-full">Vent Settings</p>
                            <p class="text-xs text-gray-500">Vent settings (ipap/ epap/ rate)</p>
                        </div>
                    </div>
                    <div class="flex justify-end w-1/2 mr-4 lg:mr-8">
                        <div class="flex inline-block">
                            <input id="ipap" type="number" min="1" max="3" @change="changeInput"
                                class="px-3 w-12 py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white"
                                placeholder="0" name="ipap" v-model="ipap">
                            <input id="epap" type="number" min="1" max="3" @change="changeInput"
                                class="px-3 w-12 py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white"
                                placeholder="0" name="epap" v-model="epap">
                            <input id="rate" type="number" min="1" max="3" @change="changeInput"
                                class="px-3 w-12 py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white"
                                placeholder="0" name="rate" v-model="rate">
                        </div>
                    </div>
                </div>
                <div class="px-6 py-2 bg-gray-100">
                    <div class="flex justify-between text-sm ">
                        <span class="text-gray-600">Percent Complete: <span class="" :class="percentComplete === 100 ? 'text-green-500' :'text-orange-400'">{{percentComplete}}%</span></span>
                        <transition name="fade" >
                           <span v-if="show_saved" class="text-orange-400">saved</span>
                        </transition>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            percentComplete: 0,
            percentComplete1: 0,
            percentComplete2: 0,
            percentComplete3: 0,
            antibiotic_state: null,
            hospital_state: null,
            ipap: null,
            epap: null,
            rate: null,
            show_saved: false,
        }),
        methods:{
            toggleAntibioticState(value){
                this.antibiotic_state = value;
                this.commitShiftTasks();
            },
            toggleHospitalState(value){
                this.hospital_state = value;
                this.commitShiftTasks();
            },
            changeInput(){
               this.commitShiftTasks();
            },
            getLatestShiftTasks(){
               axios
                  .post('api/get-latest-shift-task', {
                     shift_id: this.$store.getters.shift.id
                  })
                  .then(response => {
                     if(response.data.shift_id === this.$store.getters.shift.id){
                        this.antibiotic_state = response.data.antibiotic;
                        this.hospital_state = response.data.hospital_illness;
                        this.ipap = response.data.vent_ipap;
                        this.epap = response.data.vent_epap;
                        this.rate = response.data.vent_rate;
                     }
                  })
                  .catch(error => {
                      console.log(error)
                  })
            },
            commitShiftTasks(){
               axios
                  .post('api/set-shift-tasks', {
                     shift_id: this.$store.getters.shift.id,
                     antibiotic: this.antibiotic_state,
                     hospital_illness: this.hospital_state,
                     vent_ipap: this.ipap,
                     vent_epap: this.epap,
                     vent_rate: this.rate,
                  })
                  .then(response => {
                        this.show_saved = true;
                        var that = this;
                           setTimeout(function() {
                               that.show_saved = false;
                           }, 1000); // hide the message after 3 seconds
                     //  console.log(response.data);
                  })
                  .catch(error => {
                      console.log(error)
                  })
            }
        },
        mounted() {
            this.getLatestShiftTasks();
            this.$watch(vm => [vm.antibiotic_state, vm.hospital_state_on, vm.ipap, vm.epap, vm.rate], val => {

               if(this.antibiotic_state !== null){
                  this.percentComplete1 = 33;
               }
               if(this.hospital_state !== null){
                  this.percentComplete2 = 33;
               }
               if(this.ipap !== null && this.epap !== null && this.rate !== null ){
                  this.percentComplete3 = 34;
               }
                  this.percentComplete = this.percentComplete1 + this.percentComplete2 + this.percentComplete3;
            }, {
               immediate: true, // run immediately
               deep: true // detects changes inside objects. not needed here, but maybe in other cases
            })
        }
    }
</script>


<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s
}

.fade-enter,
.fade-leave-to
/* .fade-leave-active in <2.1.8 */

{
  opacity: 0
}
</style>