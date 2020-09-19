<template>
  <div>
    <div class="flex w-full justify-between py-4 text-gray-700 font-semibold">
      <header class="w-full text-gray-700 font-semibold text-xl">
        Pending Users
        <span class="text-sm text-gray-600">({{ count}})</span>
      </header>
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
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
              >Status</th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
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
                          class="text-indigo-500 hover:text-indigo-400 hover:underline"
                        >{{user.name}}</a>
                      </p>
                      <p class="text-gray-600 whitespace-no-wrap">{{user.email}}</p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                  <span
                    :class="user.active_status == 3 ? 'bg-orange-200' : 'bg-red-200'"
                    class="absolute inset-0 opacity-50 rounded-full"
                  ></span>
                  <span
                    v-if="user.active_status == 3"
                    class="relative text-orange-900"
                  >Pending Approval</span>
                </span>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                      @click="deleteModalProps(user.id, user.name, index)"
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
  </div>
</template>

<script>
export default {
  props: ["count"],
  data: () => ({
    pagename: "user",
    isLoading: false,
    rows: [],
    page: 1,
    pages: [],
    pageNumber: "",
    tablePerPage: 10,
    tableTotalRows: "",
    selectedIndex: "",
    selectedItemName: ""
  }),
  components: {},
  methods: {
    setUserStatus(id, status, index) {
      axios
        .post("api/tenant-users/set-status", {
          id: id,
          status: 1,
          index: index
        })
        .then(response => {
          response.index = index;
          this.$delete(this.rows, index, response.data);
          this.$emit("user_approved", { id: id });
        })
        .catch(error => {
          console.log(error);
        });
    },
    getPendingUsers() {
      this.isLoading = true;
      axios
        .post("api/get-pending-users", {
          tenant_id: this.$tenantId
        })
        .then(response => {
          this.rows = response.data.reverse();
          this.isLoading = false;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  filters: {
    moment: function(date) {
      return moment(date).format("MMMM D, YYYY");
    },
    countTimeAgo: function(value) {
      return moment(value).fromNow();
    }
  },
  mounted() {
    this.getPendingUsers();
  }
};
</script>