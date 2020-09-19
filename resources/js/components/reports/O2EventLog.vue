<template>
    <event-log-template
        :model="'O2'"
        :eventTitleHeader="'Status'"
        :eventTitle="'O2'"
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
