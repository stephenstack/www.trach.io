<template>
    <div class="flex-1 overflow-auto border-l-2 border-gray-200">
        <div class="flex-1">
            <div class="w-full sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto ">
                <!-- Welcome Header -->
                <div
                    class="flex justify-between items-center w-full text-gray-600 text-base lg:text-xl mt-2 lg:mt-8 mb-2 lg:mb-4 px-2"
                >
                    <div class="w-1/2 lg:w-3/4">
                        <div class="flex items-center">
                            <div>
                                Welcome Back,
                                <span class="text-gray-700 font-semibold ">{{
                                    this.$firstName
                                }}</span>
                            </div>
                        </div>
                    </div>
                    <transition name="shiftfade">
                        <div
                            class="flex inline-block w-1/2 lg:w-1/4 justify-end"
                            v-if="$store.getters.shift.status === 1"
                        >
                            <button
                                @click="openShiftSignOut"
                                type="button"
                                class="border border-gray-300  bg-white text-indigo-300 text-sm font-medium px-2 lg:px-4 xl:px-6 py-2 rounded float-right uppercase cursor-pointer hover:text-indigo-500 hover:border-gray-500"
                            >
                                Sign out shift
                            </button>
                        </div>
                    </transition>
                </div>
                <!-- Welcome Header -->

                <!-- Other User On Shift Notice -->
                <div
                    v-if="
                        $store.getters.shift.user &&
                            $store.getters.shift.user.id != this.$userId
                    "
                    class="flex items-center bg-blue-500 text-white text-sm font-semibold px-4 py-3 rounded shadow"
                    role="alert"
                >
                    <svg
                        class="fill-current w-4 h-4 mr-2"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"
                        />
                    </svg>
                    <p>
                        {{ $store.getters.shift.user.name }} is on duty, you can
                        sign this person out, or continue working!
                    </p>
                </div>
                <!-- Other User On Shift Notice -->

                <!-- Sign in notice -->
                <transition name="shiftfade">
                    <div
                        class="items-center w-full mt-8 lg:mt-8 mb-2 lg:mb-4 px-2 lg:px-2"
                        v-if="$store.getters.shift.status === 0"
                    >
                        <div
                            class="items-center w-full rounded-lg shadow text-white px-4 lg:px-10 py-4 lg:py-6 "
                            style="background-image: linear-gradient(to right, #805ad5, #9f7aea);"
                        >
                            <div
                                class="w-full text-lg tracking-wider font-semibold mb-2"
                            >
                                Please sign in to get started.
                            </div>
                            <div class="flex justify-between ">
                                <div class="w-full md:w-3/4 lg:w-1/2">
                                    <p
                                        class="text-gray-200 text-justify text-sm lg:text-base"
                                    >
                                        Most trach.io features are available to
                                        use if you do not sign in, but you will
                                        get better analytics and reports if you
                                        sign in to a shift. Even for a short
                                        period, like 30 minutes or one hour.
                                    </p>
                                    <div>
                                        <button
                                            class="w-32 rounded shadow-lg font-normal text-sm text-purple-700 px-2 py-1 mt-4 bg-white border border-purple-700 hover:bg-purple-800 hover:text-white"
                                            @click="openShiftSignIn()"
                                        >
                                            Shift Sign In
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="hidden md:flex justify-end w-1/4 lg:w-1/2 pr-0 lg:pr-6"
                                >
                                    <svg
                                        viewBox="0 0 100 125"
                                        class="fill-current text-white h-16 w-16 "
                                    >
                                        <polygon
                                            points="43.71 8.87 43.71 12.87 89.07 12.87 89.07 87.13 43.71 87.13 43.71 91.13 93.07 91.13 93.07 8.87 43.71 8.87"
                                        />
                                        <polygon
                                            points="50.54 69.23 53.37 72.06 75.06 50.37 53.03 28.34 50.2 31.17 67.07 48.03 6.93 48.03 6.93 52.03 67.73 52.03 50.54 69.23"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
                <!-- Sign in notice -->
                <div v-show="isLoading" class="linePreloader w-full"></div>
                <!-- Action Buttons -->
                <transition name="shiftfade">
                    <div v-if="$store.getters.shift.status === 1">
                        <div
                            class="hidden md:flex justify-between w-full mt-4 lg:mt-8 mb-2 px-2"
                        >
                            <header
                                class="text-gray-600 font-normal tracking-wide"
                            >
                                Interventions
                            </header>
                            <div
                                v-if="this.$roleId <= 2"
                                class="hidden lg:block w-full text-right"
                            >
                                <router-link
                                    :to="'/settings'"
                                    class="px-2 text-sm bg-transparent  rounded-lg text-indigo-500 hover:text-indigo-400"
                                >
                                    Enable/Disable actions</router-link
                                >
                            </div>
                        </div>
                        <div class="flex flex-wrap justify-start mt-6 md:mt-0">
                            <dashboard-event-action-button
                                class="w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/6 mb-4 md:mb-8"
                                v-for="(item, index) in eventActionRowsEnabled"
                                :key="index"
                                :item="item"
                                v-on:alert="alert($event)"
                                v-on:openO2Modal="openO2Modal()"
                                v-on:openDesatModal="openDesatModal()"
                                v-on:openEnvModal="openEnvironmentModal()"
                            >
                            </dashboard-event-action-button>
                        </div>
                    </div>
                </transition>
            </div>
            <!-- Action Buttons -->

            <transition name="shiftfade">
                <div
                    class="flex flex-wrap justify-between w-full sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto mt-4 lg:mt-0"
                    v-if="$store.getters.shift.status === 1"
                >
                    <!-- Status Boxes -->
                    <current-status-info-box></current-status-info-box>
                    <!-- Status Boxes -->

                    <!-- Assiged Tasks Boxes -->
                    <assigned-task-box></assigned-task-box>
                    <!-- Assiged Tasks Boxes -->
                </div>
            </transition>

            <!-- Activity Box -->
            <transition name="shiftfade">
                <user-actions-partial
                    :key="userActionsKey"
                ></user-actions-partial>
            </transition>
            <!-- Activity Box -->
        </div>

        <alert
            v-if="showAlert"
            :messagedata="alertmessage"
            @close="showAlert = false"
        ></alert>

        <modal-o2
            :showModal="showO2Modal"
            @alert="alert($event)"
            @close="showO2Modal = false"
        ></modal-o2>
        <modal-desat
            :showModal="showDesatModal"
            @alert="alert($event)"
            @close="showDesatModal = false"
        ></modal-desat>
        <modal-environment
            :showModal="showEnvModal"
            @alert="alert($event)"
            @close="showEnvModal = false"
        ></modal-environment>

        <full-page-alert
            v-if="showFullPageModal"
            @close="showFullPageModal = false"
            :status="eventStatus"
            :message="eventMessage"
        ></full-page-alert>
        <sign-in-modal
            :showModal="showSignInModal"
            @signedIn="signedInOrOut('success', $event)"
            @close="showSignInModal = false"
        ></sign-in-modal>
        <sign-out-modal
            :showModal="showSignOutModal"
            @signedOut="signedInOrOut('success', $event)"
            @close="showSignOutModal = false"
        ></sign-out-modal>
    </div>
</template>

<script>
import Alert from "../components/Alert";
import ModalO2 from "../components/dashboard/ModalO2";
import ModalDesat from "../components/dashboard/ModalDesat";
import ModalEnvironment from "../components/dashboard/ModalEnvironment";
import CurrentStatusInfoBox from "../components/dashboard/CurrentStatusInfoBox";
import AssignedTaskBox from "../components/dashboard/AssignedTaskBox";
import UserActionsPartial from "../components/dashboard/UserActionsPartial";
import DashboardEventActionButton from "../components/dashboard/EventActionButton";
import FullPageAlert from "../components/dashboard/FullPageAlert";
import SignInModal from "../components/dashboard/SignInModal";
import SignOutModal from "../components/dashboard/SignOutModal";

export default {
    data: () => ({
        pagename: "dashboard",
        isLoading: false,
        antibioticValue: false,
        hospitalValue: false,
        openMoreActions: false,
        o2Status: false,
        showAlert: false,
        alertmessage: null,
        showFullPageModal: false,
        showO2Modal: false,
        showDesatModal: false,
        showEnvModal: false,
        showSignInModal: false,
        showSignOutModal: false,
        desatValue: null,
        showVentModal: false,
        infoModalTag: "",
        infoModalData: {},
        infoModalIcon: "",
        ventComponentKey: 0,
        nurseOnDuty: false,
        eventActionRowsEnabled: [],
        eventActionRowsDisabled: [],
        eventStatus: "",
        eventMessage: "",
        userActionsKey: 0
    }),
    components: {
        Alert,
        UserActionsPartial,
        CurrentStatusInfoBox,
        AssignedTaskBox,
        ModalO2,
        ModalEnvironment,
        ModalDesat,
        DashboardEventActionButton,
        FullPageAlert,
        SignInModal,
        SignOutModal
    },
    methods: {
        signedInOrOut(status, event) {
            this.getLatestShiftInfo();
            this.sendMessage(status, event);
        },
        openShiftSignIn() {
            this.showSignInModal = true;
        },
        openShiftSignOut() {
            this.showSignOutModal = true;
        },
        openO2Modal() {
            this.showO2Modal = true;
        },
        openDesatModal() {
            this.showDesatModal = true;
        },
        openEnvironmentModal() {
            this.showEnvModal = true;
        },
        alert(event) {
            this.eventStatus = event.status;
            this.eventMessage = event.message;
            this.showFullPageModal = true;
            this.forceUserActionsRerender();
            //  this.sendMessage(event.status, event.message);
        },
        forceUserActionsRerender() {
            this.userActionsKey += 1;
        },
        showDailyInfoModal(value) {
            this.infoModalTag = value.tag;
            this.infoModalData = value.record;
            this.infoModalIcon = value.icon;
            this.showInfoModal = true;
        },
        toggleMoreActions() {
            this.openMoreActions = !this.openMoreActions;
        },
        getEventActionCardData(status) {
            console.log(this.$store.getters.event_actions);

            if (status === "enabled") {
                this.eventActionRowsEnabled = this.$store.getters.event_actions.filter(
                    element => element.status === 1
                );
            }
        },
        getLatestShiftInfo() {
            axios
                .get("api/get-latest-shift")
                .then(response => {
                    this.$store.commit("SET_SHIFT", response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.isLoading = true;
        this.$store.dispatch("GET_EVENTACTIONS").then(profile => {
            this.getLatestShiftInfo();
            this.getEventActionCardData("enabled");
            this.$store.dispatch("GET_NOTIFICATIONCOUNT");
            this.isLoading = false;
        });
    }
};
</script>

<style>
/* width */
::-webkit-scrollbar {
    width: 10px;
}
</style>
