<template>
    <transition name="fade">
        <div v-show="showModal">
            <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
                <div @click="$emit('close')" class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                <div
                    class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto -mt-40">

                    <div class="bg-white rounded-lg w-full">

                        <div class="w-full bg-white rounded-lg mx-auto flex overflow-hidden rounded-b-none">
                            <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                                <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Set O2</h2>
                                <p class="text-xs text-gray-500">Turn on O2, and set value in litres</p>
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
                                            <label class="w-full text-gray-700 tracking-wide text-sm mb-4"
                                                for="desat_value">Select Value</label>

                                            <div v-for="(o2value, index) in o2values" :key="'o2value-'+index"
                                                class="w-1/2 ">
                                                <input type="radio" :id="index+'-value'" name="o2value"
                                                    class="radio-plan hidden" v-model="o2SelectedRadioValue"
                                                    :value="o2value">
                                                <label
                                                    :class="{'light-orange': index % 2 === 0, 'ml-2': index % 2 !== 0 }"
                                                    :for="index+'-value'"
                                                    class="text-gray-700 border-2 border-indigo-200 px-3 py-2 block rounded-lg cursor-pointer mb-3 relative hover:border hover:border-indigo-500">
                                                    <div class="flex">
                                                        <div>
                                                            <span class="block">{{o2value}} Litre</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                        <p class="hidden md:flex float-left text-xs text-gray-500 tracking-tight mt-2">Save your settings</p>
                        <button @click="saveForm()"
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
    props: [ 'showModal' ],
    data: () => ({
            desat_value: null,
            returnedError: null,
            o2values: [1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5],
            o2SelectedRadioValue: null,
            o2StatusAsInt: 0,
    }),
    methods: {
        close() {
            this.$emit('close');
        },
        saveForm() {
            axios.post('/api/o2s', {
                    owner_id: this.$userId,
                    status: !this.$store.getters.o2Status.status,
                    value: this.o2SelectedRadioValue,
                    shift_id: this.$store.getters.shift.id,
                })
                .then(response => {
                    this.$emit('alert', {
                        status: 'success',
                        message: response.data.message
                    });
                    this.$store.dispatch('SAVE_O2STATUS',response.data.data);
                    this.close();
                })
                .catch(error => {
                    this.$emit('alert', {
                        status: 'error',
                        message: error.response.data.data.value[0]
                    });
                    this.close();

                });
        },
    },
    mounted(){

    },
}

</script>
