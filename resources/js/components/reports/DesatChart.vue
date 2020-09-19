<template>
    <chart-template
      :chartname="'Desat'"  
      :days="7"  
      :color="'#38b2ac'"  
      :model="'Desat'"  
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