<template>
    <chart-template
      :chartname="'Nebulizers'"  
      :days="7"  
      :color="'#4299e1'"  
      :model="'Neb'"  
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