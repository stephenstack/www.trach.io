<template>
    <div>
        <div v-show="isLoading" class="linePreloader w-full"></div>
        <div v-show="!isLoading" class="flex justify-between w-full my-4 ml-8" >
            <div class="items-center">
                <dropdown title="Date Range" :items="dateRangeList" btnType="blue" v-on:dropdown-select-event="changeChartRange"/>
            </div>
        </div>
        <reactive-bar-chart v-if="chartData" :chart-data="chartData" :options="options"></reactive-bar-chart>
    </div>
</template>

<script>
import ReactiveBarChart from "./ReactiveBarChart.js";
import Dropdown from "../Dropdown";

export default {
    components: {
        ReactiveBarChart,
        Dropdown
    },
    props: ['chartname', 'days', 'color', 'model'],
    data: () => ({
        isLoading: false,
        chartData: null,
        daterange: 7,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            height: 500
        },
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
        changeChartRange(values){
            // this.$emit('change-date-range', values);
            // console.log(values);
            this.daterange = values.id;
        },
        create_graph() {
            axios
                .post('api/chart/create_graph', {
                    days: this.daterange,
                    chart_name: this.chart_name,
                    color: this.color,
                    model: this.model
                })
                .then(response => {
                    let result = response.data;
                    this.chartData = {
                        labels: result.labels,
                        datasets: [{
                            label: result.title,
                            fill: result.color,
                            backgroundColor: result.color,
                            data: result.data
                        }]
                    };
                    this.isLoading = false;
                })
                .catch(error => {
                    console.log(error)
                })
        },
    },
    mounted() {
        this.isLoading = true;
        this.create_graph();
    },
    watch: {
        daterange: function (newVal, oldVal) { // watch it
            this.days = newVal;
            this.create_graph();
            // console.log('Prop changed: ', newVal, ' | was: ', oldVal)
        }
    }
}
</script>