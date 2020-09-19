<template>
    <chart-template
      :chartname="'Cough Assist'"  
      :days="7"  
      :color="'#fc8181'"  
      :model="'Cough'"  
    ></chart-template>
</template>

<script>
import ChartTemplate from './ChartTemplate';

    export default {
        components: {
            ChartTemplate,
        }
    }   
</script>