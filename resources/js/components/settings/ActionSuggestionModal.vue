<template>
    <transition name="fade">
        <div v-show="showModal">
            <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
                <div @click="$emit('close')"
                    class="modal-backdrop modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                <div
                    class="modal modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto -mt-40">
                    <div class="bg-white rounded-lg w-full">

                        <div class="w-full bg-white rounded-lg mx-auto flex overflow-hidden rounded-b-none">
                            <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                                <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Send action suggestion
                                </h2>
                                <p class="text-xs text-gray-500">We would love to hear suggestions for more actions/
                                    intervention buttons. Send us a note and we'll get working on it!</p>
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
                                    <div class="w-full">
                                        <label for="email" class="text-sm text-gray-600">Subject</label>
                                        <input name="email" type="text" class="mt-2 tcl-input" value=""
                                            v-model="subject" autocomplete="off">
                                        <span v-if="errors.subject"
                                            class="text-sm font-light text-red-400 tracking-wide" role="alert">
                                            <strong>{{errors.subject[0]}}</strong>
                                        </span>
                                    </div>
                                    <div class="w-full">
                                        <label for="email" class="text-sm text-gray-600">Suggestion Message</label>
                                        <textarea name="email" type="text" rows="5" cols="5" class="mt-2 tcl-input"
                                            value="" v-model="message" autocomplete="off" />
                                        <span v-if="errors.message" class="text-sm font-light text-red-400 tracking-wide" role="alert">
                                        <strong>{{errors.message[0]}}</strong>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                            <p class="hidden md:flex float-left text-xs text-gray-500 tracking-tight mt-2">We will send an invite right
                                away
                            </p>
                            <button
                                 @click.prevent="onSubmitSend"
                                class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:shadow-xl">Send</button>
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

export default {
    props: [   'showModal' ],
    data: () => ({
        subject: '',
        message: '',
        errors: [],
    }),
    methods: {
        onSubmitSend(){
            axios.post('api/notification/send-action-suggestion', {
                    subject: this.subject,
                    message: this.message,
                    tenant_user_id: this.$userId,
                    tenant_id: this.$tenantId,
                })
                .then((response) => {
                    console.log(response);
                    this.$emit('alert', {status: 'success', message: response.data.message});
                    this.reset();
                    this.$emit('close');
                })
                .catch((error) => {
                    console.log(error)
                    this.errors = error.response.data.data;
                    // this.$emit('alert', {status: 'error', message: error.response.data.data});
                });
        },
        close(){
            this.reset();
            this.$emit('close');
        },
        reset(){
            this.subject = null;
            this.message = null;
        }
    },
    mounted(){

    }

}

</script>
