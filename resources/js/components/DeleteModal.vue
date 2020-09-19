<template>
    <transition name="fade">
        <div v-show="showModal">
            <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
                <div @click="$emit('close')"
                    class="modal-backdrop modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                <div class="relative px-4 min-h-screen flex items-center justify-center">
                    <div
                        class="bg-white rounded-lg md:max-w-md md:mx-auto p-4 fixed inset-x-0 z-50 mb-4 mx-4 md:relative">

                        <div class="md:flex items-center">
                            <div class="rounded-full flex items-center justify-center w-16 h-16 flex-shrink-0 mx-auto">
                                <svg viewBox="0 0 576 512" class="text-yellow-500 h-10 w-10">
                                    <path fill="currentColor"
                                        d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z" />
                                </svg>
                            </div>
                            <div class="mt-4 md:mt-0 md:ml-6 text-center md:text-left">
                                <p class="font-bold">
                                    <slot name="delete-modal-title"></slot>
                                </p>
                                <p class="text-sm text-gray-700 mt-1">
                                    <slot name="delete-modal-body"></slot>
                                </p>
                            </div>
                        </div>
                        <div class="text-center md:text-right mt-4 md:flex md:justify-end">
                            <button @click.prevent="deleteItem(selectedIdProp, pagenameProp)" autofocus
                                class="block w-full md:inline-block md:w-auto px-4 py-3 md:py-2 bg-red-100 text-red-700 rounded-lg font-semibold text-sm md:ml-2 md:order-2 hover:text-white hover:bg-red-600 hover:shadow">Delete</button>
                            <button @click.prevent="close"
                                class="block w-full md:inline-block md:w-auto px-4 py-3 md:py-2 rounded-lg font-semibold text-sm mt-4 md:mt-0 md:order-1 text-gray-500 hover:text-gray-700  ">Cancel</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: [
        'selectedIdProp',
        'selectedIndexProp',
        'pagenameProp',
        'showModal'
    ],
    data() {
        return {

        }
    },
    methods: {
        deleteItem(id, pagenameProp) {

            axios
            .post('/api/'+pagenameProp+'/' + id, {
                    _method: 'delete'
                })
                .then(response => {
                    this.$emit('deleterow', this.selectedIndexProp);
                    this.$emit('closeDelete');
                    //emit event
                })
                .catch(error => {
                    // error
                });
        },
        close(){
            this.$emit('closeDelete');
        },
    },
    created() {

    }
}
</script>
