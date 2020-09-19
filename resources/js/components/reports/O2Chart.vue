<template>
    <chart-template
      :chartname="'O2'"  
      :days="7"  
      :color="'#68d391'"  
      :model="'O2'"  
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
