<template>
    <div class="w-full">
        <ul class="flex border-b  border-gray-300">
            <li v-for="(tab, index) in tabs" :key="index">
                <button class="mr-6 pb-2 text-gray-600 font-normal hover:font-semibold px-2" v-text="tab.title" role="tab" @click="activeTab = tab"
                :class="{'border-b-2 border-blue-600 text-blue-600 focus:outline-none': tab == activeTab}"
                :style="tab == activeTab ? 'margin-bottom: -1px' : ''">
                </button>
            </li>
        </ul>
        <slot></slot>
    </div>
</template>

<script>
export default {
    data: () => ({
        tabs: [],
        activeTab: null,

    }),
    methods: {
        setInitialActiveTab(){
           this.activeTab = this.tabs.find(tab => tab.active) || this.tabs[0];
        },
    },
    mounted() {
       this.tabs = this.$children;
       this.setInitialActiveTab();
    },
    watch: {
        activeTab(activeTab){
            this.tabs.map(tab => (tab.show = tab == activeTab));
        }
    }
}
</script>