<template>
    <chart-template
      :chartname="'Medication'"  
      :days="7"  
      :color="'#ed64a6'"  
      :model="'Med'"  
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