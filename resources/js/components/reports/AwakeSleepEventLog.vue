<template>
    <event-log-template
        :model="'Awakesleep'"
        :eventTitle="'Awake/Sleep'"
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
