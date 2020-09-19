<template>
<!--
    https://laracasts.com/discuss/channels/vue/close-dropdown-when-click-another-element
    https://codesandbox.io/s/yp7j65270j
-->
  <span class="dropdown" :class="{'is-active': open}">
    <div class="dropdown-trigger">
      <button
        :class="btnType === 'blue' ? 'mx-auto w-48 rounded-full bg-blue-700 hover:bg-blue-600 shadow-lg font-normal text-sm text-white px-4 py-2' : 'mx-auto w-48 rounded-full bg-gray-100 hover:bg-gray-200 hover:shadow-lg font-normal text-sm text-gray-800 px-4 py-2 border border-gray-400'"
        @click.prevent="toggle">
        <span>{{selectedName || title}}</span>
        <span class="">
            <svg class="h-4 float-right mt-1 fill-current" :transform="open ? 'rotate(180)' : ''" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                <g>
                    <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"/>
                </g>
            </svg>
        </span>
      </button>
    </div>
    <transition name="slide-fade">
        <div v-if="open" class="rounded shadow-md absolute pin-t pin-l w-40 ml-4 bg-white" >
            <a href="#" class="px-4 py-2 block text-gray-800  hover:bg-gray-200" v-for="(item) in items" :key="item.id" @click.prevent="sendActionBacktoParent(item.id, item.name, item.link)">
                {{item.name}}
            </a>
        </div>
    </transition>
  </span>
</template>

<script>
export default {
    props: {
        title: '',
        btnType: '',
        items: {
            type: Array,
            default: []
        },
    },
    data() {
        return {
            open: false,
            selectedName: ''
        };
    },

    created() {
        window.addEventListener("click", this.close);
    },

    beforeDestroy() {
        window.removeEventListener("click", this.close);
    },

    methods: {
        sendActionBacktoParent(id, name, link){
            this.$emit('dropdown-select-event', { id: id, name: name, link: link});
            this.setDropdownTitleOnSelect(name);
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
