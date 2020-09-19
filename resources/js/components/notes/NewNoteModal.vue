<template>
    <transition name="fade">
        <div v-show="showModal">
        <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div @click="$emit('close')" class="modal-backdrop modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div
                class="modal modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto -mt-40">
                <div class="bg-white rounded-lg w-full">

                        <div class="w-full bg-white rounded-lg mx-auto flex overflow-hidden rounded-b-none">
                            <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                                <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Add a note</h2>
                                <p class="text-xs text-gray-500">You can record event details in notes, and add comments for later use.</p>
                            </div>
                            <div class="md:w-full w-full">
                            <div @click="close" class="modal-close flex justify-end cursor-pointer z-50 p-3">
                                <svg class="fill-current text-gray-500 hover:text-gray-800 " xmlns="http://www.w3.org/2000/svg"
                                    width="18" height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>

                                <div class="pb-8 px-4 lg:px-16">
                                    <div class="w-full">
                                        <label for="email" class="text-sm text-gray-600">Title</label>
                                        <input name="email" type="text"
                                            class="mt-2 tcl-input"
                                            value="" v-model="title">
                                        <span v-if="errors.title" class="text-sm font-light text-red-400 tracking-wide" role="alert">
                                            <strong>{{errors.title[0]}}</strong>
                                        </span>
                                    </div>

                                    <div class="w-full mt-4">
                                        <label for="email" class="text-sm text-gray-600">Note</label>
                                        <textarea name="email" type="text" rows="5" cols="5"
                                            class="mt-2 tcl-input"
                                            value="" v-model="note" />
                                        <span v-if="errors.note" class="text-sm font-light text-red-400 tracking-wide" role="alert">
                                            <strong>{{errors.note[0]}}</strong>
                                        </span>
                                    </div>

                                    <div class="flex flex-wrap mb-6 mt-4">
                                        <label class="w-full text-gray-700 tracking-wide text-sm" for="email">Category</label>
                                        <select id="catId" name="catId" v-model="selectedCategory" class="tcl-input">
                                        <option v-for="item in categoryList" :key="item.id" :value="item.id" :class="'text-'+item.color+'-400'">
                                            {{item.name}}
                                        </option>
                                        </select>
                                        <span v-if="errors.role" class="text-sm font-light text-red-400 tracking-wide" role="alert">
                                            <strong>{{errors.role[0]}}</strong>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                            <p class="hidden md:flex float-left text-xs text-gray-500 tracking-tight mt-2">Record a note!
                            </p>
                            <button
                                @click.prevent="onSubmitSave"
                                class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:shadow-xl">Save</button>
                            <button @click="close()"
                                class="bg-transparent text-indigo-300 text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:text-indigo-500">Cancel</button>

                        </div>
                </div>
            </div>
        </div>
        </div>
    </transition>
</template>

<script>

export default {
    props: [   'showModal' ],
    data: () => ({
        title: '',
        note: '',
        catId: '',
        errors: [],
        categoryList: [],
        selectedCategory: '',
    }),
    methods: {
        onSubmitSave(){
            axios.post('/api/note', {
                    title: this.title,
                    note: this.note,
                    owner_id: this.$userId,
                    owner_name: this.$userName,
                    notecategory_id: this.selectedCategory,
                    permissions: this.$roleId,
                })
                .then((response) => {
                    this.$emit('addrow', response);
                    this.reset();
                    this.$emit('close');
                })
                .catch((error) => {
                    console.log(error)
                    this.errors = error.response.data.data;
                    // this.$emit('alert', {status: 'error', note: error.response.data.data});
                });
        },
        getCategories(){
            axios
                .get('api/note-categories' )
                .then(response => {
                    this.categoryList = response.data;
                })
                .catch(error => {
                     console.log(error)
                })
        },
        close(){
            this.reset();
            this.$emit('close');
        },
        reset(){
            this.title = null;
            this.note = null;
        }
    },
    mounted(){
        this.getCategories();
    }

}

</script>
