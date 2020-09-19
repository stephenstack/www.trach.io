<template>

    <select name="timezone_offset" id="timezone-offset" @change="changeTimezone($event)" v-model="timezone" class="tcl-input">
        <option disabled="" selected="" value="">
            -- Select a timezone --
        </option>
        <option v-for="(value, key) in timezonelist" :value="key" :offset-data="value.offset" :key="key">
        {{ key }} ({{value.offset_string}})

        </option>
    </select>
</template>

<script>
export default {
    props: ['tenantdata'],
    data() {
        return {
            timezone: null,
            timezonelist: []
        }
    },
    methods: {
        changeTimezone(event) {
            axios
                .post('/api/update-timezone', {
                    timezone: event.target.value,
                    offset:  event.target.selectedOptions[0].getAttribute('offset-data')
                })
                .then(response => {
                    // handle success
                    this.timezone = event.target.value;
                    var msg = "Timezone set to " + this.timezone;
                    this.$emit('timezoneset', msg)
                    // alert(this.timezone);
                })
                .catch(error => {
                    // handle error
                    console.log(error);
                     this.$emit('timezoneset', error);
                })
        },
        listTimeZones(){
            axios
            .get('/api/list-timezones', {

            })
            .then(response => {
                // handle success
               this.timezonelist = response.data;
            //    console.log(this.timezonelist);
            })
            .catch(error => {
                // handle error
                console.log(error);
            })
        },

    },
    mounted (){
        this.listTimeZones();
    },
    watch: {
        tenantdata: function(newVal, oldVal) { // watch it
            this.timezone= this.tenantdata.timezone;
        }
    }
}
</script>

