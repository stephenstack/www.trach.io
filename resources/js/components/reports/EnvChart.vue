<template>
    <chart-template
      :chartname="'Environment'"  
      :days="7"  
      :color="'#667eea'"  
      :model="'Envvar'"  
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
