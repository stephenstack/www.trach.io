<template>
    <div>
        <div v-if="item.card_name === 'o2' && item.status === 1">
            <button @click="handle_function_call(item.btnMethod)"
                class=" flex items-center bg-white justify-center text-gray-700 rounded shadow block hover:shadow-xl h-28 w-11/12 mx-2 lg:h-32 sm:w-11/12">
                <div class="">
                    <component :is="item.icon" :o2Status="o2Status"> </component>
                    <span
                        class="block mt-2 lg:mt-0 text-sm font-base sm:font-base lg:font-semibold text-lg">{{item.title}}
                        <small v-if="$store.getters.o2Status.status === 1">(on)</small><small v-else>(off)</small>
                    </span>
                </div>
            </button>
        </div>

        <div v-else-if="item.card_name === 'awakesleep' && item.status === 1">
            <button @click="handle_function_call(item.btnMethod)"
                class=" flex items-center bg-white justify-center text-gray-700 rounded shadow block hover:shadow-xl h-28 w-11/12 mx-2 lg:h-32 sm:w-11/12">
                <div class="">
                    <component :is="awakeStatus ? 'icon-awake' : 'icon-sleep'" > </component>
                    <span class="pl-2 lg:font-semibold"><span v-if="awakeStatus">Awake</span><span v-else>Sleeping</span></span>
                </div>
            </button>
        </div>

        <div v-else>
            <button @click="handle_function_call(item.btnMethod)"
                class=" flex items-center bg-white justify-center text-gray-700 rounded shadow block hover:shadow-xl h-28 w-11/12 mx-2 lg:h-32 sm:w-11/12"
                :class="item.status === 1 ? 'bg-white ' : 'bg-gray-700 opacity-50 cursor-not-allowed'">
                <div class="">
                    <component :is="item.icon"> </component>
                    <span class="pl-2 lg:font-semibold">{{item.title}} </span>
                </div>
            </button>

        </div>
    </div>
</template>

<script>
    import IconO2 from "./svgs/IconO2";
    import IconCough from "./svgs/IconCough";
    import IconDesat from "./svgs/IconDesat";
    import IconNeb from "./svgs/IconNeb";
    import IconSuction from "./svgs/IconSuction";
    import IconEnv from "./svgs/IconEnv";
    import IconToilet from "./svgs/IconToilet";
    import IconMeds from "./svgs/IconMeds";
    import IconAwake from "./svgs/IconAwake";
    import IconSleep from "./svgs/IconSleep";

    export default {
        props: ['item'],
        data: () => ({
            o2Status: false,
            awakeStatus: false,
        }),
        components: {
            IconO2,
            IconCough,
            IconDesat,
            IconNeb,
            IconSuction,
            IconEnv,
            IconToilet,
            IconMeds,
            IconAwake,
            IconSleep
        },
        methods: {
            handle_function_call(function_name) {
                this[function_name]();
            },
            setAwakeToggleEvent() {
                this.awakeStatus = !this.awakeStatus;
                let awakeStatusAsInt = this.awakeStatus * 1;
                axios.post('/api/awakesleeps', {
                        owner_id: this.$userId,
                        status: awakeStatusAsInt,
                        shift_id: this.$store.getters.shift.id,
                    })
                    .then((response) => {
                        this.$emit('alert', {
                            status: 'success',
                            message: response.data.message
                        });
                    })
                    .catch((error) => {
                        this.sendMessage('error', error);
                    });
            },
            getLatestAwakeStatus() {
                axios.get('/api/awakeLatestStatus')
                    .then(response => {
                        this.awakeStatus = response.data.status;
                        this.awakeStatus = this.awakeStatus * 1;
                        // console.log(response.data);
                    });
            },
            setSuctionEvent() {
                this.genericSetEvent('suctions');
            },
            setCoughEvent() {
                this.genericSetEvent('coughs');
            },
            setNebEvent() {
                this.genericSetEvent('nebs');
            },
            setToiletEvent() {
                this.genericSetEvent('toilets');
            },
            setMedsEvent() {
                this.genericSetEvent('meds');
            },
            genericSetEvent(eventName) {
                axios.post('/api/' + eventName, {
                        owner_id: this.$userId,
                        shift_id: this.$store.getters.shift.id,
                    })
                    .then((response) => {
                        this.$store.dispatch('SAVE_'+eventName.toUpperCase()+'STATUS', response.data.data);
                        this.$emit('alert', {
                            status: 'success',
                            message: response.data.message
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            openO2Modal() {
                this.$emit('openO2Modal', true);
            },
            openDesatModal() {
                this.$emit('openDesatModal', true);
            },
            openEnvironmentModal() {
                this.$emit('openEnvModal', true);
            },
        },
        mounted() {
            if (this.item.card_name === 'o2') {
                this.$store.dispatch('GET_O2STATUS');
            }
            if (this.item.card_name === 'awakesleep') {
                this.getLatestAwakeStatus();
            }
        }
    }

</script>
