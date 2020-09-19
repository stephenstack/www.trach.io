<template>
    <div class="flex-1 overflow-auto border-l-2 border-gray-200" >

        <!-- https://medium.com/@obapelumi/pagination-with-vuejs-1f505ce8d15b -->
            <div class="w-full sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto px-2">
                <div class="w-full text-gray-700 font-semibold text-xl"></div>
                <div class="w-full py-4 text-gray-700 font-semibold text-xl">
                    <header>Reports</header>
                </div>
                <report-tabs v-if="eventActions" >
                    <report-tab title="Oxygen" v-if="eventActions['o2'] === 1" v-on:graph-or-log-view="setGraphOrLogView" :showGraph="showGraph" active>
                            <o2-chart slot="graph" v-if="showGraph"></o2-chart>
                            <o2-event-log slot="logs" v-if="!showGraph"></o2-event-log>
                    </report-tab>
                    <report-tab title="Suction" v-if="eventActions['suction'] === 1" v-on:graph-or-log-view="setGraphOrLogView" :showGraph="showGraph">
                            <suction-chart slot="graph" v-if="showGraph"></suction-chart>
                            <suction-event-log slot="logs" v-if="!showGraph"></suction-event-log>
                    </report-tab>
                    <report-tab title="Cough Assist" v-if="eventActions['cough'] === 1" v-on:graph-or-log-view="setGraphOrLogView" :showGraph="showGraph">
                            <cough-chart slot="graph" v-if="showGraph"></cough-chart>
                            <cough-event-log slot="logs" v-if="!showGraph"></cough-event-log>
                    </report-tab>
                    <report-tab title="Desat" v-if="eventActions['desat'] === 1" v-on:graph-or-log-view="setGraphOrLogView" :showGraph="showGraph">
                            <desat-chart slot="graph" v-if="showGraph"></desat-chart>
                            <desat-event-log slot="logs" v-if="!showGraph"></desat-event-log>
                    </report-tab>
                    <report-tab title="Nebulisers" v-if="eventActions['neb'] === 1" v-on:graph-or-log-view="setGraphOrLogView" :showGraph="showGraph">
                            <neb-chart slot="graph" v-if="showGraph"></neb-chart>
                            <neb-event-log slot="logs" v-if="!showGraph"></neb-event-log>
                    </report-tab>
                    <report-tab title="Environment" v-if="eventActions['environment'] === 1" v-on:graph-or-log-view="setGraphOrLogView" :showGraph="showGraph">
                            <env-chart  slot="graph" v-if="showGraph"></env-chart>
                            <env-event-log slot="logs" v-if="!showGraph"></env-event-log>
                    </report-tab>
                    <report-tab title="Toilet" v-if="eventActions['toilet'] === 1" v-on:graph-or-log-view="setGraphOrLogView" :showGraph="showGraph">
                            <toilet-chart  slot="graph" v-if="showGraph"></toilet-chart>
                            <toilet-event-log slot="logs" v-if="!showGraph"></toilet-event-log>
                    </report-tab>
                    <report-tab title="Meds" v-if="eventActions['meds'] === 1" v-on:graph-or-log-view="setGraphOrLogView" :showGraph="showGraph">
                            <meds-chart slot="graph" v-if="showGraph"></meds-chart>
                            <med-event-log slot="logs" v-if="!showGraph"></med-event-log>
                    </report-tab>
                    <report-tab title="Awake Sleep" v-if="eventActions['awakesleep'] === 1" v-on:graph-or-log-view="setGraphOrLogView" :showGraph="showGraph">
                            <awake-sleep-chart slot="graph" v-if="showGraph"></awake-sleep-chart>
                            <awake-sleep-event-log slot="logs" v-if="!showGraph"></awake-sleep-event-log>
                    </report-tab>
                </report-tabs>

            </div>
        <alert v-if="showAlert" :messagedata="alertmessage"  @close="showAlert = false"></alert>
    </div>
</template>

<script>

import Alert from '../components/Alert';
import ReportTabs from '../components/reports/ReportTabs';
import ReportTab from '../components/reports/ReportTab';
import O2Chart from "../components/reports/O2Chart";
import SuctionChart from "../components/reports/SuctionChart";
import CoughChart from "../components/reports/CoughChart";
import DesatChart from "../components/reports/DesatChart";
import NebChart from "../components/reports/NebChart";
import EnvChart from "../components/reports/EnvChart";
import ToiletChart from "../components/reports/ToiletChart";
import MedsChart from "../components/reports/MedsChart";
import AwakeSleepChart from "../components/reports/AwakeSleepChart";
import O2EventLog from "../components/reports/O2EventLog";
import SuctionEventLog from "../components/reports/SuctionEventLog";
import CoughEventLog from "../components/reports/CoughEventLog";
import DesatEventLog from "../components/reports/DesatEventLog";
import NebEventLog from "../components/reports/NebEventLog";
import EnvEventLog from "../components/reports/EnvEventLog";
import ToiletEventLog from "../components/reports/ToiletEventLog";
import MedEventLog from "../components/reports/MedEventLog";
import AwakeSleepEventLog from "../components/reports/AwakeSleepEventLog";

export default {
    data: () => ({
        pagename: 'report',
        showModal: false,
        showAlert: false,
        alertmessage: null,
        eventActions: null,
        showGraph: true,
    }),
    components: {
        Alert,
        ReportTabs,
        ReportTab,
        O2Chart,
        SuctionChart,
        CoughChart,
        DesatChart,
        NebChart,
        EnvChart,
        ToiletChart,
        MedsChart,
        AwakeSleepChart,
        O2EventLog,
        SuctionEventLog,
        CoughEventLog,
        DesatEventLog,
        NebEventLog,
        EnvEventLog,
        ToiletEventLog,
        MedEventLog,
        AwakeSleepEventLog,
    },
    methods: {
        setGraphOrLogView(value){
            this.showGraph = value;
        },
        getEventActions(){
            axios
                .get('api/event-action' )
                .then(response => {
                    this.eventActions = response.data;

                    var i, len = this.eventActions.length;
                    for (i = 0; i < len; i++) {
                        this.eventActions[this.eventActions[i]['card_name']] = this.eventActions[i]['status'];
                        // this.eventActions['status'] = this.eventActions[i]['status'];
                        delete this.eventActions[i];
                    }

                    //  console.log(this.eventActions);
                })
                .catch(error => {
                     console.log(error)
                })
        },
        saveFavouriteTab(e){

        },
    },
    filters: {

    },

    mounted() {
        this.getEventActions();
    },
}
</script>