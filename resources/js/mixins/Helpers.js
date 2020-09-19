import {NotificationBus} from '../app';
export default {
    methods: {

        capitalizeFirstLetter(str) {
            str = str.charAt(0).toUpperCase() + str.slice(1);
            str = str.replace(/-/g, ' ');
            return str;
        },
        addLatestRow(values) {
            axios
                .get('/api/' + this.pagename + 's/' + values.data.id )
                .then(response => {
                    // handle success
                    let msg = this.capitalizeFirstLetter(this.pagename) + " added successfully";
                    let msgtype = "success";
                    this.sendMessage(msgtype, msg);
                    this.rows.unshift(response.data[0]);
                })
                .catch(error => {
                    // handle error
                    this.errorMsg = error;
                    this.showErrorAlert = true;
                    console.log(error);
                })
                .finally(() => {
                    setTimeout(() => {
                        this.showSuccessAlert = false;
                        this.showErrorAlert = false;
                      }, 3000)
                });
        },
        updateRow(values) {
            let msg = this.capitalizeFirstLetter(this.pagename) + " edited successfully";
            let msgtype = "success";
            this.sendMessage(msgtype, msg);
            Object.assign(this.rows[values.index], values.data);
        },
        deleteModalProps(id, name, index) {
            this.showDeleteModal = true;
            this.selectedId = id;
            this.selectedItemName = name;
            this.selectedIndex = index;
        },
        addModal() {
            this.showModal = true;
            this.editId = null;
            this.modalTitle = "Add " +  this.capitalizeFirstLetter(this.pagename);
        },
        editModal(id, index) {
            this.modalTitle = "Edit " + this.capitalizeFirstLetter(this.pagename);
            this.editId = id;
            this.selectedIndex = index;
            this.showModal = true;
        },
        removeRow(index) {
            let msg = this.capitalizeFirstLetter(this.pagename) + " deleted successfully";
            let msgtype = "success";
            this.sendMessage(msgtype, msg);
            this.$delete(this.rows, index);
        },
        sendMessage(msgtype, msg) {
            this.alertmessage = {
                text: msg,
                type: msgtype
            };
            this.showAlert = true;
        },
        setPages() {
            let numberOfPages = Math.ceil(this.rows.length / this.tablePerPage);
            for (let index = 1; index <= numberOfPages; index++) {
                //check if index exists in this.pages, and push if it does not
                this.pages.indexOf(index) === -1 ? this.pages.push(index) : '';
            }
        },
        paginate(rows) {
            let page = this.page;
            let tablePerPage = this.tablePerPage;
            let from = (page * tablePerPage) - tablePerPage;
            let to = (page * tablePerPage);
            return rows.slice(from, to);
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.tableTotalRows = filteredItems.length;
            this.page = 1
        }
    },
    computed: {
        displayedRows() {
            return this.paginate(this.rows);
        }
    },
    watch: {
        rows() {
            this.setPages();
        },
        tablePerPage() {
            this.pages = [];
            this.setPages();
        },
    },

};