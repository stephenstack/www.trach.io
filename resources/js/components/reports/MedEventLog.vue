<template>
    <event-log-template
        :model="'Med'"
        :eventTitle="'Medication'"
    ></event-log-template>
</template>

<script>
import EventLogTemplate from "./EventLogTemplate";

    export default {
        components: {
            EventLogTemplate
        },
    }
</script>
