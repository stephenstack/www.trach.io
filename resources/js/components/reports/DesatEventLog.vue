<template>
    <event-log-template
        :model="'Desat'"
        :eventTitleHeader="'Value'"
        :eventTitle="'Desat'"
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
