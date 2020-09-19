<template>
    <chart-template
      :chartname="'Toilet'"  
      :days="7"  
      :color="'#9f7aea'"  
      :model="'Toilet'"  
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