<template>
    <div class="flex-1 overflow-auto border-l-2 border-gray-200 px-2" >
        <!-- https://medium.com/@obapelumi/pagination-with-vuejs-1f505ce8d15b -->
            <div class="w-full sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto">
                <div class="w-full text-gray-700 font-semibold text-xl">
                </div>
                <div class="flex w-full justify-between  py-4 text-gray-700 font-semibold ">
                    <header class=" text-gray-700 font-semibold text-xl">Notes <span class="text-sm text-gray-600">({{rows.length}})</span></header>
                </div>

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="flex justify-between w-full">
                        <div class="w-1/2 items-center">
                            <dropdown title="Filter by Category" :items="categoryList" btnType="blue" v-on:dropdown-select-event="actionsDropdownSelectEvent"/>
                        </div>
                        <div class="flex justify-between">
                            <!-- <button class="flex py-2 px-6 text-white rounded shadow-xl block bg-indigo-500 hover:bg-indigo-700">Edit Categorys</button> -->
                            <button @click="showNewNoteModal = true" class="flex py-2 px-6 ml-4 text-white rounded shadow-xl block bg-green-500 hover:bg-green-700">New Note</button>
                        </div>
                    </div>
                        <p class="text-gray-600 font-normal mt-3"><span class=" hover:text-blue-600 cursor-pointer">{{this.selectedAction.name}} ({{rows.length}})</span></p>

                    <note-list-view
                        v-for="(item, index) in displayedRows" :key="item.id"
                        :item="item"
                        :index="index"
                        :itemCatColor="item.category.color"
                        :itemCatName="item.category.name"
                        @deleteItem="deleteModalProps(item.id, item.title, index)"
                        @viewItem="viewItemModal($event)"
                        @openCommentModal="commentModal($event)"
                        @viewComments="openViewCommentsModal($event)"
                    >
                    </note-list-view>


                    <div class="flex px-6 justify-between h-12 bg-white mt-4">
                        <div class="flex justify-start ">
                            <div class="text-gray-600 text-sm text-center px-2 py-2">page {{page}} of
                                {{pages.length}} </div>
                        </div>
                        <div class="flex justify-start my-2">
                            <div class="text-gray-700 text-center bg-white px-4 py-1 mr-2  rounded  cursor-pointer hover:font-bold"
                                v-if="page != 1" @click="page--">Previous</div>
                            <div :class="page === pageNumber ? 'text-white bg-purple-400' : 'text-gray-700 bg-white' "
                                class=" text-center px-4 py-1 mr-2 rounded cursor-pointer hover:font-bold"
                                v-for="pageNumber in pages" @click="page = pageNumber" :key="pageNumber">
                                {{pageNumber}}</div>
                            <div class="text-gray-700 text-center bg-white px-4 py-1 mr-2  rounded  cursor-pointer hover:font-bold"
                                @click="page++" v-if="page < pages.length">Next</div>
                        </div>
                    </div>
                </div>
            </div>
        <alert v-if="showAlert" :messagedata="alertmessage"  @close="showAlert = false"></alert>

        <new-note-modal :showModal="showNewNoteModal" @close="showNewNoteModal = false" v-on:addrow="addLatestRow"></new-note-modal>
        <new-comment-modal :showModal="showNewCommentModal" @close="showNewCommentModal = false" :parentId="newCommentParentId" v-on:addrow="addLatestRowComment"></new-comment-modal>
        <list-comment-modal :showModal="showViewCommentsModal" @close="showViewCommentsModal = false" :parentId="commentParentId" :key="commentParentId"></list-comment-modal>

        <delete-modal :showModal="showDeleteModal" :selectedIdProp="selectedId" :selectedIndexProp="selectedIndex"
            :pagenameProp="pagename" v-on:deleterow="removeRow" @closeDelete="showDeleteModal = false">
            <span slot="delete-modal-title">Delete {{pagename}}</span>
            <span slot="delete-modal-body">Are you sure you wish to delete this {{pagename}}? <p></p></span>
        </delete-modal>
    </div>
</template>
<script>

import Alert from '../components/Alert';
import Dropdown from "../components/Dropdown";
import NoteListView from "../components/notes/NoteListView.vue";
import NewNoteModal from '../components/notes/NewNoteModal.vue'
import NewCommentModal from '../components/notes/NewCommentModal.vue'
import CommentListModal from '../components/notes/CommentListModal.vue'
import DeleteModal from '../components/DeleteModal.vue'

export default {
    data: () => ({
        pagename: 'note',
        showModal: false,
        showAlert: false,
        alertmessage: null,
        showNewNoteModal: false,
        showNewCommentModal: false,
        showViewNoteModal: false,
        showViewCommentsModal: false,
        commentParentId: null,
        newCommentParentId: null,
        showDeleteModal: false,
        rows: [],
        categoryList: [],
        filterList: [],
        selectedAction: {
            name: 'View All'
        },
        page: 1,
        pages: [],
        pageNumber: '',
        tablePerPage: 10,
        tableTotalRows: '',
        viewItem: null,
    }),
    components: {
        'new-note-modal': NewNoteModal,
        'new-comment-modal': NewCommentModal,
        'list-comment-modal': CommentListModal,
        'delete-modal': DeleteModal,
        'alert': Alert,
        'dropdown': Dropdown,
        'note-list-view': NoteListView,
    },
    methods: {
        commentModal(event){
            this.newCommentParentId = event;
            this.showNewCommentModal = true;
        },
        openViewCommentsModal(event){
            this.commentParentId = event;
            this.showViewCommentsModal = true;
        },
        viewItemModal(event){
            // console.log(event);
            this.viewItem = event;
            this.showViewNoteModal = true;
        },
        actionsDropdownSelectEvent(value){
            this.selectedAction = value;
            this.filteredDataForList();
        },
        filteredDataForList(){
            this.rows = [];
            if(this.selectedAction.id){
                    axios
                        .post('/api/notes-where-category', {
                            id: this.selectedAction.id,
                            requestingUserId: this.$userId
                        })
                        .then(response => {
                            if(response.data){
                                this.rows = response.data;
                            }
                        })
                        .catch(error => {
                             console.log(error)
                        })
                } else {
                    // if there is no ID, then this is the 'Reset List' action
                    this.getAllNotes();
                    // this.sendMessage('error', 'Unable to apply filter - please report this error!');
                }
        },
        addLatestRow(values) {
            let msgtype = "success";
            let msg = "Note added successfully";
            this.sendMessage(msgtype, msg);
            this.sendNewNoteNotification(values);
            this.getAllNotes();
        },
        addLatestRowComment() {
            let msgtype = "success";
            let msg = "Comment added successfully";
            this.sendMessage(msgtype, msg);
            this.getAllNotes();
        },
        sendNewNoteNotification(values){
            axios
                .post('api/notification/send-newnote-notification', {
                    data: values,
                    user_id: this.$userId,
                    tenant_id: this.$tenantId,
                })
                .then(response => {
                     console.log(response.data);
                })
                .catch(error => {
                     console.log(error)
                })
        },
        getAllNoteCats(){
            axios
                .get('api/note-categories' )
                .then(response => {
                    this.categoryList = response.data;
                    this.categoryList[this.categoryList.length] = {name: 'View all', color: 'gray'}
                    // console.log("TCL: getAllNoteCats -> this.categoryList ", this.categoryList )
                })
                .catch(error => {
                     console.log(error)
                })
        },
        getAllNotes(){
            axios
                .post('api/get-all-notes', {
                    requestingUserId: this.$userId
                })
                .then(response => {
                    this.rows = response.data;
                })
                .catch(error => {
                     console.log(error)
                })
        },
    },
    filters: {

    },

    mounted() {
        this.getAllNotes();
        this.getAllNoteCats();
    },
}
</script>