<template>

    <div class="flex flex-wrap bg-gray-200 my-4 py-3 px-2 rounded">
        <div class="w-full flex">
            <p class="font-bold text-gray-900 ml-2 mt-2">{{item.owner_name}} </p>
            <p class="ml-2 mt-2 text-sm text-gray-500">{{item.updated_at | moment }}</p>
        </div>
        <div class="w-full">
            <p class="mx-4 w-full m-2"><span class="font-normal font-light text-gray-900">{{item.comment }}</span></p>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['item'],
        data: () => ({

        }),
        methods: {

        },
        filters: {
            moment: function (date) {
                return moment(date).format('MMMM Do YYYY - H:m');
            },
        }
    }
</script>
