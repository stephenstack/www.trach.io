<template>
    <chart-template
      :chartname="'Awake/Sleep'"  
      :days="7"  
      :color="'#c05621'"  
      :model="'Awakesleep'"  
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