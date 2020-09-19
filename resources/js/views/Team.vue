<template>
  <div class="flex-1 overflow-auto border-l-2 border-gray-200 px-2">
    <!-- https://medium.com/@obapelumi/pagination-with-vuejs-1f505ce8d15b -->
    <div class="flex-1">
      <div class="w-full sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto">
        <div class="w-full text-gray-700 font-semibold text-xl"></div>
        <div class="flex w-full justify-between py-4 text-gray-700 font-semibold">
          <header class="w-full text-gray-700 font-semibold text-xl">
            Team Listing
            <span class="text-sm text-gray-600">({{ rows.length}})</span>
            <span v-if="rows.length >= rows[0].plan.user_count" class=" px-2 text-sm text-orange-600">
              You have reached your user count limit for this plan -
              <a
                class="text-sm bg-transparent rounded-lg text-indigo-500 hover:text-indigo-400"
                href="/profile/billing"
              >upgrade</a>
            </span>
          </header>
          <button
            v-if="rows.length < rows[0].plan.user_count"
            @click="addModal()"
            class="flex py-2 px-6 text-white rounded shadow-xl block bg-green-500 hover:bg-green-700"
          >
            <span class>New</span>
          </button>
          <button
            v-if="rows.length < rows[0].plan.user_count"
            @click="inviteModal()"
            class="flex py-2 px-6 ml-4 text-white rounded shadow-xl block bg-indigo-500 hover:bg-indigo-700"
          >
            <span class>Invite</span>
          </button>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4">
          <div class="inline-block min-w-full shadow-md rounded-lg">
            <table class="min-w-full leading-normal">
              <thead>
                <tr>
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                  >Name</th>
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell"
                  >Role</th>
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell"
                  >Last Login</th>
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell"
                  >Status</th>
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell"
                  >Date Created</th>
                  <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                  >Actions</th>
                </tr>
              </thead>
              <td v-show="isLoading" colspan="6" class="linePreloader w-full"></td>
              <tbody v-show="!isLoading">
                <tr v-for="(user, index) in displayedRows" :key="index">
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <div class="flex">
                      <div class="w-full flex flex-wrap">
                        <div>
                          <p class="text-gray-900 whitespace-no-wrap font-semibold">
                            <a
                              href="#"
                              @click="editModal(user.id, index)"
                              class="text-indigo-500 hover:text-indigo-400 hover:underline"
                            >{{user.name}}</a>
                          </p>
                          <p class="text-gray-600 whitespace-no-wrap">{{user.email}}</p>
                          <p
                            v-if="user.role_id"
                            class="text-gray-600 whitespace-no-wrap block md:hidden"
                          >{{user.role.role_name}}</p>
                          <span
                            class="inline-block md:hidden mt-2 md:mt-0 px-3 py-1 font-semibold leading-tight rounded-full"
                            :class="user.active_status == 1 ? 'bg-green-200 text-green-900' : 'bg-red-200 text-red-900'"
                          >{{ user.active_status == 1 ? 'Activated' : 'Deactivated' }}</span>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td
                    class="px-3 py-3 border-b border-gray-200 bg-white text-sm hidden md:table-cell"
                  >
                    <p
                      v-if="user.role_id"
                      class="flex items-center text-gray-600 whitespace-no-wrap"
                      :class="user.role_id === 2 ? 'text-orange-500' :''"
                    >
                      <svg
                        v-if="user.role_id === 2"
                        class="fill-current text-orange-500 h-8"
                        viewBox="0 0 29 36.25"
                      >
                        <path
                          d="M15.397 4.687l2.579 5.225a1 1 0 00.753.547l5.766.838a1 1 0 01.554 1.706l-4.173 4.067c-.236.23-.343.561-.288.885l.985 5.743a1 1 0 01-1.451 1.054l-5.158-2.712a1.002 1.002 0 00-.931 0l-5.158 2.712a1 1 0 01-1.451-1.054l.985-5.743a.999.999 0 00-.288-.885l-4.173-4.067a1 1 0 01.554-1.706l5.766-.838a1 1 0 00.753-.547L13.6 4.687c.37-.743 1.43-.743 1.797 0z"
                        />
                      </svg>
                      {{user.role.role_name}}
                    </p>
                  </td>
                  <td
                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden md:table-cell"
                  >
                    <p
                      v-if="user.last_login_at"
                      class="text-gray-900 whitespace-no-wrap"
                    >{{user.last_login_at | countTimeAgo}}</p>
                    <p class="text-gray-600 whitespace-no-wrap">{{user.last_login_ip}}</p>
                  </td>
                  <td
                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden md:table-cell"
                  >
                    <span
                      class="inline-block mt-2 md:mt-0 px-3 py-1 font-semibold leading-tight rounded-full"
                      :class="user.active_status == 1 ? 'bg-green-200 text-green-900' : 'bg-red-200 text-red-900'"
                    >{{ user.active_status == 1 ? 'Activated' : 'Deactivated' }}</span>
                  </td>
                  <td
                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden md:table-cell"
                  >
                    <span
                      class="relative inline-block py-1 font-semibold leading-tight"
                    >{{user.created_at | moment }}</span>
                  </td>
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-center">
                    <div class="dropdown relative inline-block">
                      <a class href="#">
                        <svg
                          viewBox="0 0 16 16"
                          class="fill-current text-gray-600 svg-icon svg-fill"
                          style="width: 20px;"
                        >
                          <path
                            pid="0"
                            d="M13 7a2 2 0 1 1 .001 3.999A2 2 0 0 1 13 7zM8 7a2 2 0 1 1 .001 3.999A2 2 0 0 1 8 7zM3 7a2 2 0 1 1 .001 3.999A2 2 0 0 1 3 7z"
                          />
                        </svg>
                      </a>
                      <div
                        class="dropdown-content absolute right-0 z-40 bg-white rounded border shadow-lg text-left w-56"
                      >
                        <router-link
                          :to="'/useractions/' + user.id"
                          href="#"
                          class="no-underline block px-4 py-2 hover:bg-blue-100 text-gray-600 bg-white hover:text-indigo-600"
                        >Activity</router-link>
                        <router-link
                          :to="'/shifthistory/' + user.id"
                          href="#"
                          class="no-underline block px-4 py-2 hover:bg-blue-100 text-gray-600 bg-white hover:text-indigo-600"
                        >Shift History</router-link>
                        <a
                          href="#"
                          @click="editModal(user.id, index)"
                          class="no-underline block px-4 py-1 hover:bg-blue-100 pt-1 text-gray-600 bg-white hover:text-indigo-600"
                        >Edit</a>
                        <a
                          href="#"
                          @click="setUserStatus(user.id, user.active_status, index)"
                          class="no-underline block px-4 py-1 hover:bg-blue-100 text-gray-600 bg-white hover:text-indigo-600"
                        >
                          <span v-if="user.active_status === 1">Deactivate</span>
                          <span v-else>Activate</span>
                        </a>
                        <a
                          href="#"
                          @click="openDeleteModal(user.id, user.name, index)"
                          class="no-underline block px-4 py-2 hover:bg-blue-100 text-gray-600 bg-white hover:text-indigo-600"
                        >Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="flex mx-6 border-b-2 border-gray-200 bg-white"></div>
            <div class="flex px-6 justify-between h-12 bg-white">
              <div class="flex justify-start">
                <div
                  class="text-gray-600 text-sm text-center px-2 py-2"
                >page {{page}} of {{pages.length}}</div>
              </div>
              <div class="flex justify-start my-2">
                <div
                  class="text-gray-700 text-center bg-white px-4 py-1 mr-2 rounded cursor-pointer hover:font-bold"
                  v-if="page != 1"
                  @click="page--"
                >Previous</div>
                <div
                  :class="page === pageNumber ? 'text-white bg-purple-400' : 'text-gray-700 bg-white' "
                  class="text-center px-4 py-1 mr-2 rounded cursor-pointer hover:font-bold"
                  v-for="pageNumber in pages"
                  @click="page = pageNumber"
                  :key="pageNumber"
                >{{pageNumber}}</div>
                <div
                  class="text-gray-700 text-center bg-white px-4 py-1 mr-2 rounded cursor-pointer hover:font-bold"
                  @click="page++"
                  v-if="page < pages.length"
                >Next</div>
              </div>
            </div>
          </div>
        </div>
        <pending-approvals
          v-if="showPendingApprovalsTable"
          :count="showPendingApprovalsCount"
          @user_approved="addApprovedUser($event)"
        ></pending-approvals>
      </div>
    </div>
    <alert v-if="showAlert" :messagedata="alertmessage" @close="showAlert = false"></alert>

    <user-modal
      :showModal="showModal"
      v-on:addrow="addLatestRow"
      v-on:editrow="updateRow"
      :selectedIndexUpdateProp="selectedIndex"
      :editIdProp="editId"
      :title="modalTitle"
      @close="showModal = false"
    ></user-modal>

    <delete-modal
      :showModal="showDeleteModal"
      :selectedIdProp="selectedId"
      :selectedIndexProp="selectedIndex"
      :pagenameProp="'tenant-users'"
      v-on:deleterow="removeRow"
      @closeDelete="showDeleteModal = false"
    >
      <span slot="delete-modal-title">Delete {{pagename}}</span>
      <span slot="delete-modal-body">
        Are you sure you wish to delete this {{pagename}}?
        <p>
          <b>{{ selectedItemName }}</b>
        </p>
      </span>
    </delete-modal>

    <invite-modal
      :showModal="showInviteModal"
      @close="showInviteModal = false"
      @inviteSent="inviteSent"
    ></invite-modal>
  </div>
</template>
<script>
import Alert from "../components/Alert";
import DeleteModal from "../components/DeleteModal.vue";
import UserModal from "../components/team/UserModal.vue";
import InviteModal from "../components/team/InviteModal.vue";
import PendingApprovals from "../components/team/PendingApprovals.vue";
export default {
  data: () => ({
    pagename: "user",
    isLoading: false,
    showModal: false,
    showAlert: false,
    alertmessage: null,
    showDeleteModal: false,
    rows: [],
    page: 1,
    pages: [],
    pageNumber: "",
    tablePerPage: 10,
    tableTotalRows: "",
    selectedIndex: "",
    selectedItemName: "",
    showInviteModal: false,
    showPendingApprovalsTable: false,
    showPendingApprovalsCount: null,
    editId: null,
    selectedId: null,
    modalTitle: "Add user"
  }),
  components: {
    Alert,
    DeleteModal,
    UserModal,
    InviteModal,
    PendingApprovals
  },
  methods: {
    openDeleteModal(id, name, index) {
      this.deleteModalProps(id, name, index);
    },
    inviteModal() {
      this.showInviteModal = true;
    },
    inviteSent() {
      this.sendMessage(
        "success",
        "Invite sent, please approve once the user has signed up!"
      );
    },
    addApprovedUser(value) {
      axios
        .post("api/notify-approved-user", {
          id: value.id
        })
        .then(response => {
          this.sendMessage(
            "success",
            "User approved, an email will be sent to them!"
          );
          this.getUsers();
        })
        .catch(error => {
          console.log(error);
        });
    },
    setUserStatus(id, status, index) {
      axios
        .post("api/tenant-users/set-status", {
          id: id,
          status: !status,
          index: index
        })
        .then(response => {
          response.index = index;
          this.updateRow(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    getUsers() {
      this.isLoading = true;
      axios
        .post("api/get-tenant-users", {
          tenant_id: this.$tenantId
        })
        .then(response => {
          this.rows = response.data.reverse();
          this.isLoading = false;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getPendingApprovalsCount() {
      axios
        .post("api/get-pending-user-approvals-count", {
          tenant_id: this.$tenantId
        })
        .then(response => {
          if (response.data > 0) {
            this.showPendingApprovalsTable = true;
            this.showPendingApprovalsCount = response.data;
          }
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  filters: {
    countTimeAgo: function(value) {
      return moment(value).fromNow();
    },
    moment: function(date) {
      return moment(date).format("MMMM D, YYYY");
    }
  },
  mounted() {
    this.getUsers();
    this.getPendingApprovalsCount();
  }
};
</script>

<style>
.dropdown-content {
  display: none;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>