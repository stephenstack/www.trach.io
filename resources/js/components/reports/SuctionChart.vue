<template>
    <chart-template
      :chartname="'Suction'"  
      :days="7"  
      :color="'#ed8936'"  
      :model="'Suction'"  
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