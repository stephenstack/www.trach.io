<template>
    <event-log-template
        :model="'Neb'"
        :eventTitleHeader="'Description'"
        :eventTitle="'Nebulizer'"
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
