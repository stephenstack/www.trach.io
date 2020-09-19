<template>
    <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/3 px-2">
        <div :class="cardEnable === 1 ? 'border-l-4 border-green-500' : 'border-l-4 border-gray-500'"
            class="flex bg-white shadow-xl rounded-lg mt-4 pr-4">
            <div class="w-1/4 flex justify-center mt-2">
                <component :is="icon"> </component>
            </div>
            <div class="w-3/4 mt-4">
                <slot name="title"></slot>
                <slot name="descr"></slot>
                <div class="flex justify-end ">
                    <div class="flex mt-6 mb-6">
                        <label class="flex items-center">
                            <span v-if="cardEnable === 1"
                                class="rounded-full bg-green-200 ml-2 px-2 mr-4 text-green-900">Enabled</span>
                            <span v-else class="rounded-full bg-gray-200 ml-2 px-2 mr-4 text-gray-900">Disabled</span>
                            <input :name="cardName" :id="id" type="checkbox" class="form-checkbox" :checked="cardEnable"
                                @change="checkBoxEvent($event)">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import IconO2 from "./dashboard/svgs/IconO2";
import IconCough from "./dashboard/svgs/IconCough";
import IconDesat from "./dashboard/svgs/IconDesat";
import IconNeb from "./dashboard/svgs/IconNeb";
import IconSuction from "./dashboard/svgs/IconSuction";
import IconEnv from "./dashboard/svgs/IconEnv";
import IconToilet from "./dashboard/svgs/IconToilet";
import IconMeds from "./dashboard/svgs/IconMeds";
import IconAwakesleep from "./dashboard/svgs/IconAwakeSleep";
import IconSleep from "./dashboard/svgs/IconSleep";
export default {
    props: ['id', 'cardName', 'cardEnable', 'icon', 'order','selectedIndexProp'],
    data: () => ({

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
            IconAwakesleep,
            IconSleep
        },
    methods: {
        checkBoxEvent(event){
            this.updateEventInDB(event.target.id, +event.target.checked);
        },
        updateEventInDB(id, status){
            axios
                .put('api/event-action/'+id, {
                    _method: 'PUT',
                    id: id,
                    status: status
                })
                .then(response => {

                    this.$store.dispatch('SAVE_EVENTACTION_STATUS', {id: id, status: status});
                    response.data.index = this.selectedIndexProp;
                    this.$emit('action-card-updated', response.data);
                })
                .catch(error => {
                     console.log(error)
                })
        },

    },
}

</script>

