<template>
    <transition name="slide-fade">
        <!-- SVGs from https://thenounproject.com/mikicon/collection/attention-collection/ -->
        <div class="w-full md:w-auto flex md:block fixed top-0 right-0 mr-0 md:mr-8 mt-0 md:mt-12">
            <div class="flex border-l-4  rounded bg-white py-4 px-2 max-w-3xl" :class="{
                        'border-red-600': messagedata.type === 'error',
                        'border-green-600': messagedata.type === 'success'}">
                <div class="flex  ml-2 items-center">

                    <svg v-if="messagedata.type === 'success'" viewBox="0 0 100 112"
                        class="fill-current text-green-600 w-12 h-12 mt-1">
                        <path
                            d="M50,88.6c21.3,0,38.6-17.3,38.6-38.6S71.3,11.4,50,11.4c-21.3,0-38.6,17.3-38.6,38.6S28.7,88.6,50,88.6z M31,44.8  c1.7-1.7,4.3-1.7,6,0l8.1,8.1l16.2-16.2c1.7-1.7,4.3-1.7,6,0c1.7,1.7,1.7,4.3,0,6L48.1,61.8c-0.8,0.8-1.9,1.2-3,1.2s-2.2-0.4-3-1.2  l-11-11C29.4,49.1,29.4,46.5,31,44.8z" />
                    </svg>

                    <svg v-if="messagedata.type === 'error'" viewBox="0 0 100 112"
                        class="fill-current text-red-600 w-12 h-12 mt-1">
                        <path
                            d="M88.6,50c0-21.3-17.3-38.6-38.6-38.6c-21.3,0-38.6,17.3-38.6,38.6S28.7,88.6,50,88.6C71.3,88.6,88.6,71.3,88.6,50z   M41.2,64.8c-0.8,0.8-1.9,1.2-3,1.2s-2.2-0.4-3-1.2c-1.7-1.7-1.7-4.3,0-6L44,50l-8.8-8.8c-1.7-1.7-1.7-4.3,0-6c1.7-1.7,4.3-1.7,6,0  L50,44l8.8-8.8c1.7-1.7,4.3-1.7,6,0c1.7,1.7,1.7,4.3,0,6L56,50l8.8,8.8c1.7,1.7,1.7,4.3,0,6c-0.8,0.8-1.9,1.2-3,1.2  c-1.1,0-2.2-0.4-3-1.2L50,56L41.2,64.8z" />
                    </svg>
                </div>
                <div class="flex flex-wrap w-3/4 items-center">
                    <p v-if="messagedata.type === 'success'"
                        class="w-full text-gray-900 font-semibold whitespace-no-wrap mx-4">Success</p>
                    <p v-if="messagedata.type === 'error'"
                        class="w-full text-gray-900 font-semibold whitespace-no-wrap mx-4">Error</p>
                    <p class="w-full text-gray-700 mx-4">{{ messagedata.text }}</p>
                </div>
                <div class="flex justify-end">
                    <button @click="$emit('close')"
                        class="text-4xl text-gray-400 cursor-pointer mb-2 px-3 hover:text-gray-600">
                        &#10799;
                    </button>
                </div>
            </div>
        </div>

    </transition>
</template>

<script>
export default {
    props: ['messagedata'],
    data() {
        return {

        };
    },
    mounted() {
        let timer;
            clearTimeout(timer);
            timer = setTimeout(() => {
                this.$emit('close');
            }, 3000);
    }
};
</script>

<style scoped>
/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>