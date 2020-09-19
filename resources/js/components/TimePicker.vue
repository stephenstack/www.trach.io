<template>
<!--
    https://laracasts.com/discuss/channels/vue/close-dropdown-when-click-another-element
    https://codesandbox.io/s/yp7j65270j
-->
  <span class="dropdown" :class="{'is-active': open}">
    <div class="rounded dropdown-trigger">
      <button
        class="rounded mx-auto w-48 bg-gray-300 hover:bg-gray-200 font-xl text-lg text-gray-800 px-4 py-2"
        @click.prevent="toggle">
        <span>{{selectedName || title}}</span>
        <span class="float-right ">
            [clock logo]
        </span>
      </button>
    </div>
    <transition name="slide-fade">
        <div v-if="open" class="h-64 rounded shadow-md absolute pin-t pin-l w-40 ml-4 bg-white overflow-auto" >
            <a href="#" class="px-4 py-2 block text-gray-800  hover:bg-gray-200" v-for="(time) in times" :key="time" @click.prevent="input(time)">{{time}}</a>
        </div>
    </transition>
  </span>
</template>

<script>
export default {
    props: {
        times: '',
    },
    data() {
        return {
            open: false,
            selectedName: '00:00',
        };
    },
    created() {
        window.addEventListener("click", this.close);
    },

    beforeDestroy() {
        window.removeEventListener("click", this.close);
    },
    mounted() {

    },
    methods: {
        input(value){
            this.$emit('input', value);
            this.setDropdownTitleOnSelect(value);
            this.open = false;
        },
        setDropdownTitleOnSelect(name){
            this.selectedName = name;
        },
        toggle() {
            this.open = !this.open;
        },

        close(e) {
            if (!this.$el.contains(e.target)) {
                this.open = false;
            }
        }
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
    transition: all .2s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateY(-0px);
    opacity: 0;
    }
</style>
