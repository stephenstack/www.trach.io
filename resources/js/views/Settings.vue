<template>
    <div class="flex-1 overflow-auto border-l-2 border-gray-200">
        <div class="w-full lg:w-3/4 mx-auto px-2 mb-8">
            <div class="flex w-full justify-between py-4 text-gray-700 font-semibold text-xl">
                <header class="w-full text-gray-700 font-semibold text-xl">Settings </header>
            </div>
            <settings-tabs>
                <div v-show="isLoading" class="linePreloader w-full"></div>
                <settings-tab title="System" v-show="!isLoading" active>
                    <div class="bg-white rounded-lg w-full">
                        <div class="w-full bg-white rounded-lg mx-auto flex overflow-hidden rounded-b-none  my-8">
                            <div class="md:w-full w-full my-4">
                                <div class="px-4 lg:px-16 p-3">
                                    <div class="flex flex-wrap items-center w-full">
                                        <div class="flex flex-wrap items-center w-full">
                                            <label class="w-full text-gray-700 tracking-wide text-sm mb-2"
                                                for="desat_value">Timezone Settings</label>
                                            <timezone-select :tenantdata="tenant_settings"
                                                @timezoneset="timezoneNotice($event)"></timezone-select>
                                            <span v-if="timezonemsg"
                                                class="text-sm text-green-500 ml-2 mt-1">{{timezonemsg}}</span>
                                        </div>
                                    </div>
                                    <hr class="border-gray-200 my-8">

                                    <div class="md:w-full w-full ">
                                        <div class="flex flex-wrap items-center w-full">
                                            <label class="w-full text-gray-700 tracking-wide text-sm mb-2"
                                                for="desat_value">Environment Temperature </label>
                                            <div class="flex inline-block w-full">
                                                <button type="button" @click="toggleEnvTemp('c')"
                                                    :class="this.$store.getters.env_temp_scale === 'c' ? 'font-semibold text-blue-500 border-blue-500 bg-blue-100' :''"
                                                    class="border border-gray-400 bg-white text-gray-400 px-4 py-2 rounded rounded-r-none leading-none flex items-center hover:font-semibold hover:text-blue-500 hover:border-blue-500 hover:bg-blue-100">
                                                    C
                                                </button>
                                                <button type="button" @click="toggleEnvTemp('f')"
                                                    :class="this.$store.getters.env_temp_scale === 'f' ? 'font-semibold text-blue-500 border-blue-500 bg-blue-100' :''"
                                                    class="border border-gray-400 bg-white text-gray-400 px-4 py-2 rounded rounded-l-none leading-none flex items-center hover:font-semibold hover:text-blue-500 hover:border-blue-500 hover:bg-blue-100">
                                                    F
                                                </button>
                                            </div>
                                            <span v-if="tempscalemsg"
                                                class="text-sm text-green-500 ml-2 mt-1">{{tempscalemsg}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </settings-tab>
                <settings-tab title="Event Actions">
                    <div class="flex justify-between items-center">
                        <header class="text-gray-700 font-semibold text-xl">Enabled Actions</header>
                        <button @click="openSuggestionModal()"
                            class="px-2 text-sm bg-transparent p-3 rounded-lg text-indigo-500 hover:text-indigo-400 mr-2 w-20 md:w-1/4">Send an action suggestion</button>
                    </div>
                    <div class="px-2 md:px-0 lg:px-2">
                        <div class="flex flex-wrap w-full -mx-2">
                            <settings-event-action-card v-for="(item, index) in eventActionRowsEnabled" :key="item.id"
                                :id="item.id" :cardEnable="item.status" :cardName="item.card_name" :icon="item.icon"
                                :order="item.order" v-on:action-card-updated="updateCard" :selectedIndexProp="index">
                                <span slot="title"
                                    class="text-lg font-semibold uppercase tracking-wide">{{item.title}}</span>
                                <p slot="descr" class="text-sm">{{item.description}}</p>
                            </settings-event-action-card>
                        </div>
                    </div>
                    <header class="text-gray-700 font-semibold text-xl mt-8">Disabled Actions</header>
                    <div class="px-2">
                        <div class="flex flex-wrap w-full -mx-2">
                            <settings-event-action-card v-for="(item, index) in eventActionRowsDisabled" :key="item.id"
                                :id="item.id" :cardEnable="item.status" :cardName="item.card_name" :icon="item.icon"
                                :order="item.order" v-on:action-card-updated="updateCard" :selectedIndexProp="index">
                                <span slot="title"
                                    class="text-lg font-semibold uppercase tracking-wide">{{item.title}}</span>
                                <p slot="descr" class="text-sm">{{item.description}}</p>
                            </settings-event-action-card>
                        </div>
                    </div>
                </settings-tab>
            </settings-tabs>
        </div>
        <alert v-if="showAlert" :messagedata="alertmessage" @close="showAlert = false"></alert>
        <action-suggestion-modal :showModal="showSuggestionModal" @close="showSuggestionModal = false"
            @alert="alert($event)"></action-suggestion-modal>
    </div>
</template>

<script>
import Alert from '../components/Alert';
import DeleteModal from '../components/DeleteModal.vue'
import SettingsTabs from '../components/SettingsTabs';
import SettingsTab from '../components/SettingsTab';
import SettingsEventActionCard from '../components/SettingsEventActionCard';
import ActionSuggestionModal from '../components/settings/ActionSuggestionModal';
import TimezoneSelect from '../components/settings/TimezoneSelect';
export default {
    data: () => ({
        pagename: 'settings',
        isLoading: false,
        showModal: false,
        showAlert: false,
        showSuggestionModal: false,
        alertmessage: null,
        dataLoading: false,
        showDeleteModal: false,
        rows: [],
        eventActionRowsEnabled: [],
        eventActionRowsDisabled: [],
        page: 1,
        pages: [],
        pageNumber: '',
        tablePerPage: 10,
        tableTotalRows: '',
        buttonOn: true,
        selectedIndex: null,
        tenant_settings: {},
        tempscalemsg: null,
        timezonemsg: null,
        errors: [],
    }),
    components: {
        'alert': Alert,
        'settings-tabs': SettingsTabs,
        'settings-tab': SettingsTab,
        'settings-event-action-card': SettingsEventActionCard,
        'action-suggestion-modal': ActionSuggestionModal,
        TimezoneSelect,
    },
    methods: {
        alert(event) {
            this.sendMessage(event.status, event.message);
        },
        timezoneNotice(event) {
            this.timezonemsg = event;
        },
        toggleEnvTemp(value) {
            axios
                .post('api/set-env-temp-scale', {
                    temp_scale_value: value
                })
                .then(response => {
                    this.$store.dispatch('SAVE_ENVTEMPSCALE', value);
                    let word = (this.$store.getters.env_temp_scale === 'c') ? 'Celsius' : 'Fahrenheit ';
                    this.tempscalemsg = 'Temp scale set to ' + word;
                })
                .catch(error => {
                    console.log(error)
                })
        },
        updateCard(values) {
            let msgtype = "success";
            let msg = "Card updated successfully";
            this.sendMessage(msgtype, msg);
            if (values.status === 1) {
                this.$delete(this.eventActionRowsDisabled, [values.index], values);
                this.$set(this.eventActionRowsEnabled, [this.eventActionRowsEnabled.length], values);
            } else {
                this.$delete(this.eventActionRowsEnabled, [values.index], values);
                this.$set(this.eventActionRowsDisabled, [this.eventActionRowsDisabled.length], values);
            }
        },
        getTenantSettings() {
            axios
                .get('api/get-tenant-settings')
                .then(response => {
                    this.tenant_settings = response.data;
                    this.$store.dispatch('SAVE_ENVTEMPSCALE', this.tenant_settings.temp_scale_value);
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getEventActionCardData(status) {
            axios
                .get('api/event-action-' + status)
                .then(response => {
                    if (status === 'enabled') {
                        this.eventActionRowsEnabled = response.data;
                    } else {
                        this.eventActionRowsDisabled = response.data;
                    }
                this.isLoading = false;
                })
                .catch(error => {
                    console.log(error)
                })
        },
        openSuggestionModal() {
            this.showSuggestionModal = true
        },
    },
    created() {
        this.isLoading = true;
        this.getTenantSettings();
        this.getEventActionCardData('enabled');
        this.getEventActionCardData('disabled');

    },
    mounted() {

    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMM Do YYYY');
        }
    }
}

</script>

