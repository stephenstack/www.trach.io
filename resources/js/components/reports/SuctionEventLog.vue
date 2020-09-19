<template>
    <event-log-template
        :model="'Suction'"
        :eventTitleHeader="'Description'"
        :eventTitle="'Suction'"
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
