<template>
    <div role="tabpanel" v-if="show" class="flex-1">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-2 overflow-x-auto">
            <div class=" flex w-full content-center">
                <!-- <div class="w-1/2 uppercase text-gray-600 text-lg">{{ showGraph ? 'Graph' : 'Logs' }}</div> -->
                <div class="flex w-full justify-end mt-2">
                    <!-- GRAPH BUTTON -->
                    <button class="font-bold py-1 px-2 rounded-lg inline-flex items-center" @click="setSlotType"
                        :class="showGraph ? 'bg-blue-700 text-white shadow-lg' : 'text-gray-500 hover:text-gray-600 hover:font-semibold '">
                        <svg viewBox="0 0 254 244.35" class="fill-current text-white h-6 w-6 mx-4 mt-1"
                            :class="!showGraph ? 'text-gray-500 hover:text-gray-600 hover:font-semibold' :''">
                            <g data-name="Calque 2">
                                <g data-name="Calque 1">
                                    <rect y="108.4" width="49.64" height="87.08" rx="5.67" />
                                    <rect x="67.42" y="78.2" width="49.64" height="117.28" rx="5.67" />
                                    <rect x="136.45" y="30.2" width="49.64" height="165.28" rx="5.67" />
                                    <rect x="204.36" width="49.64" height="195.48" rx="5.67" />
                                </g>
                            </g>
                        </svg>
                    </button>
                    <!-- LOG BUTTON -->
                    <button class="font-bold py-1 px-2 rounded-lg inline-flex items-center" @click="setSlotType"
                        :class="showGraph ? 'text-gray-500 hover:text-gray-600 hover:font-semibold ' : 'bg-blue-700 text-white shadow-lg' ">
                        <svg viewBox="0 0 147.77778 166.25" class="fill-current text-white h-6 w-6 mx-4 mt-1"
                            :class="showGraph ? 'text-gray-500 hover:text-gray-600 hover:font-semibold' :''">
                            <circle cx="14.77778" cy="14.77778" r="14.77778" />
                            <circle cx="14.77778" cy="66.5" r="14.77778" />
                            <circle cx="14.77778" cy="118.22222" r="14.77778" />
                            <path
                                d="M135.22222,105.66667H216.5a7.38889,7.38889,0,1,0,0-14.77778H135.22222a7.38889,7.38889,0,1,0,0,14.77778Z"
                                transform="translate(-76.11111 -83.5)" />
                            <path
                                d="M216.5,142.61111H135.22222a7.38889,7.38889,0,1,0,0,14.77778H216.5a7.38889,7.38889,0,0,0,0-14.77778Z"
                                transform="translate(-76.11111 -83.5)" />
                            <path
                                d="M216.5,194.33333H135.22222a7.38889,7.38889,0,1,0,0,14.77778H216.5a7.38889,7.38889,0,0,0,0-14.77778Z"
                                transform="translate(-76.11111 -83.5)" /></svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="w-full  mt-4 p-4 bg-white shadow-lg rounded-lg text-gray-900 ">
            <slot name="graph"></slot>
            <slot name="logs"></slot>
        </div>
    </div>
</template>


<script>
import Dropdown from "../Dropdown";

export default {
    props: {
        title: {},
        active: {
            type: Boolean,
            default: false
        },
        showGraph: {
            type: Boolean,
            default: true
        },
    },
    components: {
        Dropdown,
    },
    data: () => ({
        show: false,
        dateRangeList: [
            { "id": 7, "name": "Last 7 days", "link": "#" },
            { "id": 30, "name": "Last 30 days", "link": "#" },
            { "id": 60, "name": "Last 60 days", "link": "#" },
            { "id": 90, "name": "Last 90 days", "link": "#" },
            { "id": 180, "name": "Last 180 days", "link": "#" },
            { "id": 365, "name": "Last year", "link": "#" },
            { "id": 7, "name": "Reset", "link": "#" },
        ],

    }),
    methods: {
        setSlotType(){
            this.showGraph = !this.showGraph;
            this.$emit('graph-or-log-view', this.showGraph);
        },
    },
    mounted(){

    }
}
</script>