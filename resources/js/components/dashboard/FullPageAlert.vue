<template>
    <transition name="fade">
        <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div @click="$emit('closeInfo')" class="modal-overlay absolute w-full h-full opacity-80"
                :class="status === 'success' ? 'bg-indigo-900' :'bg-red-900'"></div>

            <div class="h-screen flex  justify-center items-center  modal-content container ">

                <div @click="close"
                    class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                    (Esc)
                </div>

                <div class="w-full bg-transparent rounded-lg fixed mx-2">
                    <div class="flex flex-wrap justify-center items-end pb-2">
                        <svg class="fill-current text-white h-20 w-20" viewBox="0 0 100 125" v-if="status === 'success'">
                            <path
                                d="M92.83,15.17a4,4,0,0,0-5.66,0L50,52.34,36.83,39.17a4,4,0,0,0-5.66,5.66l16,16a4,4,0,0,0,5.66,0l40-40A4,4,0,0,0,92.83,15.17Z" />
                            <path
                                d="M93.12,41.18a4,4,0,1,0-7.84,1.6,36,36,0,1,1-17.7-24.2,4,4,0,0,0,3.92-7A44,44,0,1,0,94,50,44.87,44.87,0,0,0,93.12,41.18Z" />
                        </svg>

                        <svg class="fill-current text-white h-40 w-40" viewBox="0 0 100 125" v-else>
                            <g>
                                <path
                                    d="M50,19.121582c-17.0263672,0-30.8779297,13.8520508-30.8779297,30.878418S32.9736328,80.878418,50,80.878418   S80.8779297,67.0263672,80.8779297,50S67.0263672,19.121582,50,19.121582z M50,77.878418   c-15.3720703,0-27.8779297-12.5063477-27.8779297-27.878418S34.6279297,22.121582,50,22.121582   S77.8779297,34.6279297,77.8779297,50S65.3720703,77.878418,50,77.878418z" />
                                <path
                                    d="M66.4013672,33.5986328c-0.5859375-0.5859375-1.5351563-0.5859375-2.1210938,0L50,47.8789063L35.7197266,33.5986328   c-0.5859375-0.5859375-1.5351563-0.5859375-2.1210938,0c-0.5859375,0.5854492-0.5859375,1.5356445,0,2.1210938L47.8789063,50   L33.5986328,64.2802734c-0.5859375,0.5854492-0.5859375,1.5356445,0,2.1210938   c0.2929688,0.2929688,0.6767578,0.4394531,1.0605469,0.4394531s0.7675781-0.1464844,1.0605469-0.4394531L50,52.1210938   l14.2802734,14.2802734c0.2929688,0.2929688,0.6767578,0.4394531,1.0605469,0.4394531s0.7675781-0.1464844,1.0605469-0.4394531   c0.5859375-0.5854492,0.5859375-1.5356445,0-2.1210938L52.1210938,50l14.2802734-14.2802734   C66.9873047,35.1342773,66.9873047,34.184082,66.4013672,33.5986328z" />
                            </g>
                        </svg>

                    </div>
                    <div class="flex flex-wrap justify-center items-end pb-2">
                        <p class="text-4xl font-bold text-white" v-if="status === 'success'">Thank you!</p>
                        <p class="text-4xl font-bold text-white" v-else><i>Sorry!</i></p>
                    </div>
                    <div class="flex flex-wrap justify-center items-end pb-2">
                        <p class="text-xl text-white" v-if="status === 'success'">{{message}}</p>
                    </div>
                    <div class="flex flex-wrap justify-center items-end pb-10">
                        <p class="text-xl text-white text-center" v-if="status === 'success'">The intervention was recorded successfully</p>
                        <p class="text-xl text-white" v-else>Something went wrong.
                            <span class="text-xl text-white" v-if="message">{{message}}</span>
                            <span class="text-xl text-white" v-else>Please send us a support ticket.</span>
                            </p>
                    </div>

                    <div class="flex flex-wrap justify-center items-end pb-2">
                        <button
                            class="px-4 bg-white p-3 rounded-lg text-gray-900 hover:bg-gray-100 hover:text-indigo-400 mr-2 w-1/2 lg:w-64 cursor-pointer"
                            @click="close" autofocus>OKAY</button>
                    </div>
                </div>

                <!--Body-->

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <!-- <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button>
                <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button> -->
                </div>

            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: [
            'status', 'message'
        ],
        data() {
            return {

            }
        },
        methods: {
            close() {
                this.$emit('close');
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
        }
    }

</script>
