<template>
    <event-log-template
        :model="'Envvar'"
        :eventTitleHeader="'Temp/ Humidity'"
        :eventTitle="'Environment Variables'"
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
