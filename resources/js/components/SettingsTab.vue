<template>
    <div role="tabpanel" v-show="show" class="flex-1">
        <div class="flex justify-between m-2">

        </div>
        <slot></slot>
    </div>
</template>


<script>
export default {
    props: {
        title: {},
        descr: {},
        active: {
            type: Boolean,
            default: false
        },
    },
    data: () => ({
        show: false,
    }),
    method: {

    },
    mounted(){

    }
}
</script>