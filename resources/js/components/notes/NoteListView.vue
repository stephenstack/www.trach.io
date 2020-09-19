<template>
    <div :class="'border-'+itemCatColor+'-600'" class="w-full mt-4 bg-white shadow-lg text-gray-900 border-t-2">
        <div class="w-full flex justify-between px-6 pt-4">
            <div class="font-bold text-gray-800 text-xl">{{item.title}}</div>
            <div class="text-gray-600"><span :class="'text-'+itemCatColor+'-400'">{{itemCatName}}</span></div>
        </div>
        <div class="w-full text-sm font-semibold text-gray-600 px-6">{{item.updated_at | moment }}</div>
        <div class="w-full px-6 pt-4 h-12 truncate">
            {{item.note}}
        </div>
        <div class="flex w-full px-6 pb-4 mt-2 pt-3 border-t border-gray-300">
            <div class="flex w-1/2 ">
                <div class="flex w-1/3 text-gray-600 items-center">
                    <svg class="fill-current text-gray-600 h-6 w-6 mt-1" viewBox="0 0 100 125">
                    <path fill="none" d="M50.84 69.943l9.656-15.657-9.656 15.657zM49.896 71.474l.52-.842-.52.842zM49.378 72.313l.189-.306-.189.306z"/>
                    <circle cx="49.303" cy="28.005" r="23.005"/>
                    <path d="M85.532 89.628c-1.713-17.054-11.489-31.032-24.521-36.176l-23.135.457c-12.473 5.485-21.744 19.153-23.408 35.719C14.181 92.491 16.365 95 19.242 95h61.516c2.877 0 5.061-2.509 4.774-5.372zM60.496 54.286L50.84 69.943l9.656-15.657zM50.415 70.632l-.52.842.52-.842zm-.848 1.375l-.189.306.189-.306z"/>
                    </svg>
                    <span class="text-sm">{{item.owner_name}}</span>
                </div>
                <div class="flex w-2/3 items-center">
                    <svg class="fill-current text-gray-600 h-6 w-6 mt-1" viewBox="0 0 333 416.25">
                    <path d="M159 234c59-10 117-51 102-110 72 18 87 83 26 115 0 16 9 26 20 37-18-2-40-13-58-24 0 0-50 9-90-18zM130 57c67 0 122 38 122 84 0 44-50 80-114 83-25 20-57 41-72 44 12-13 25-27 23-49-47-11-81-42-81-78 0-46 55-84 122-84z" />
                    </svg>
                    <a href="#" class="text-sm no-underline mr-6 text-indigo-500 hover:text-indigo-400" @click="$emit('viewComments', item.id)">
                        Comments ({{item.comments.length}})
                    </a>
                    <svg @click="$emit('openCommentModal', item.id)" viewBox="0 0 512 512" class="text-gray-700 hover:text-blue-600 cursor-pointer svg-inline--fa fa-plus-circle fa-w-16">
                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/>
                    </svg>
                </div>

            </div>
            <div class="flex justify-end w-1/2" >
                <span @click="deleteThisNote(item)"
                        v-if="this.$roleId <= 2"
                        class="text-sm no-underline text-gray-500 hover:text-indigo-400 hover:font-semibold"><a href="#" class="mx-2">Delete</a></span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['itemCatColor', 'itemCatName', 'item', 'index'],
        data: () => ({

        }),
        methods: {
            deleteThisNote(event){
                event.index= this.index;
                this.$emit('deleteItem', {id: event.id, title: event.title, index: event.index})
            },
        },
        filters: {
            moment: function (date) {
                return moment(date).format('dddd, MMMM Do YYYY h:mm A');
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>