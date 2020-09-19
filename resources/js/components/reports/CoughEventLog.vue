<template>
    <event-log-template
        :model="'Cough'"
        :eventTitleHeader="'Description'"
        :eventTitle="'Cough assist'"
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
