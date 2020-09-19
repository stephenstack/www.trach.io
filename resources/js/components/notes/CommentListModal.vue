<template>
    <transition name="fade">
        <div v-show="showModal">
            <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
                <div @click="$emit('close')"
                    class="modal-backdrop modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
                <div
                    class="modal modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto -mt-40">
                    <div class="bg-white rounded-lg w-full">
                        <div class="w-full bg-white rounded-lg mx-auto flex overflow-hidden rounded-b-none">
                            <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                                <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Comment History</h2>
                                <p class="text-xs text-gray-500">View a record of all comments made on this note.</p>
                            </div>
                            <div class="md:w-full w-full">
                                <div @click="close" class="modal-close flex justify-end cursor-pointer z-50 p-3">
                                    <svg class="fill-current text-gray-500 hover:text-gray-800 "
                                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                        <path
                                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="pb-8 px-4 lg:px-16">
                                <comment-list-item
                                    v-for="(item, index) in comments" :key="index"
                                    :item="item"
                                ></comment-list-item>

                                </div>
                            </div>
                        </div>
                        <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                            <button @click="close()"
                                class="bg-transparent text-indigo-300 text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:text-indigo-500">Close</button>

                        </div>
                </div>
            </div>
        </div>
        </div>
    </transition>
</template>

<script>
import CommentListItem from './CommentListItem'
export default {
    props: [  'parentId', 'showModal' ],
    data: () => ({
        note: null,
        comments: null,
    }),
    components: {
        CommentListItem,
    },
    methods: {
        getCommentsForThisNote(pid){
            axios
                .get('/api/note/' + pid )
                .then(response => {
                    this.note = response.data[0];
                    this.comments = this.note.comments.reverse();
                })
                .catch(error => {
                     console.log(error)
                })
        },
        close(){
            this.$emit('close');
        },
    },
    mounted(){
        this.getCommentsForThisNote(this.parentId);
    }

}

</script>
