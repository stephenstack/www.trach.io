<template>
  <transition name="fade">
    <div v-show="showModal">
      <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div
          @click="$emit('close')"
          class="modal-backdrop modal-overlay absolute w-full h-full bg-gray-900 opacity-50"
        ></div>

        <div
          class="modal modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto -mt-40"
        >
          <div class="bg-white rounded-lg w-full">
            <div class="w-full bg-white rounded-lg mx-auto flex overflow-hidden rounded-b-none">
              <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">{{title}}</h2>
                <p class="text-xs text-gray-500">
                  This user will be sent an email to verify their email
                  address. Please let them know that this step must completed in order to login.
                </p>
              </div>
              <div class="md:w-full w-full">
                <div @click="close" class="modal-close flex justify-end cursor-pointer z-50 p-3">
                  <svg
                    class="fill-current text-gray-500 hover:text-gray-800"
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                  >
                    <path
                      d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"
                    />
                  </svg>
                </div>

                <div v-if="errors.length" class="bg-red-500 text-white p-4 m-4 mb-6 rounded-lg">
                  <p class="font-bold">Error:</p>
                  <ul class="list-disc ml-8">
                    <li>{{ errors }}</li>
                  </ul>
                </div>

                <div class="pb-8 px-4 lg:px-16">
                  <div class="flex flex-wrap mb-6">
                    <label class="w-full text-gray-700 tracking-wide text-sm" for="name">
                      Users
                      Name
                    </label>
                    <input
                      id="name"
                      type="text"
                      class="tcl-input"
                      name="name"
                      v-model="name"
                      required
                      autofocus
                      autocomplete="nothing"
                    />
                    <span
                      v-if="errors.name"
                      class="text-sm font-light text-red-400 tracking-wide"
                      role="alert"
                    >
                      <strong>{{errors.name[0]}}</strong>
                    </span>
                  </div>
                  <div class="flex flex-wrap mb-6">
                    <label class="w-full text-gray-700 tracking-wide text-sm" for="email">
                      Email
                      Address
                    </label>
                    <input
                      id="email"
                      type="text"
                      class="tcl-input"
                      name="email"
                      v-model="email"
                      required
                      autofocus
                      autocomplete="nothing"
                    />
                    <span
                      v-if="errors.email"
                      class="text-sm font-light text-red-400 tracking-wide"
                      role="alert"
                    >
                      <strong>{{errors.email[0]}}</strong>
                    </span>
                  </div>
                  <div class="flex flex-wrap mb-6">
                    <label class="w-full text-gray-700 tracking-wide text-sm" for="email">Password</label>
                    <input
                      id="password"
                      type="password"
                      class="tcl-input"
                      name="password"
                      v-model="password"
                      required
                      autofocus
                      autocomplete="nothing"
                    />
                    <span
                      v-if="errors.password"
                      class="text-sm font-light text-red-400 tracking-wide"
                      role="alert"
                    >
                      <strong>{{errors.password[0]}}</strong>
                    </span>
                  </div>
                  <div class="flex flex-wrap mb-6">
                    <label class="w-full text-gray-700 tracking-wide text-sm" for="email">
                      Users
                      Role
                    </label>
                    <select id="role" name="role" v-model="selectedRole" class="tcl-input">
                      <option
                        v-for="item in roles"
                        :key="item.id"
                        :value="item.id"
                      >{{item.role_name}}</option>
                    </select>
                    <span
                      v-if="errors.role"
                      class="text-sm font-light text-red-400 tracking-wide"
                      role="alert"
                    >
                      <strong>{{errors.role[0]}}</strong>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
              <p
                class="hidden md:flex float-left text-xs text-gray-500 tracking-tight mt-2"
              >Click save to create user and send notification away</p>
              <button
                @click.prevent="onSubmitSave()"
                v-if="editIdProp == null"
                class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:shadow-xl"
              >Save</button>
              <button
                @click.prevent="onSubmitEdit(editIdProp)"
                v-if="editIdProp !== null"
                class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:shadow-xl"
              >Edit</button>
              <button
                @click="close()"
                class="bg-transparent text-indigo-300 text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer hover:text-indigo-500"
              >Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  props: ["editIdProp", "selectedIndexUpdateProp", "showModal", "title"],
  data: () => ({
    editId: "",
    someId: "",
    roles: [],
    name: "",
    email: "",
    password: "",
    selectedRole: "3",
    errors: [],
    newTenantUserId: null
  }),
  methods: {
    onSubmitSave() {
      axios
        .post("/api/users", {
          name: this.name,
          email: this.email,
          password: this.password,
          role_id: this.selectedRole,
          tenant_user_id: this.newTenantUserId,
          tenant_id: this.$tenantId,
          active_status: 1
        })
        .then(response => {
          this.$emit("addrow", response);
          this.reset();
          this.openModal = null;
          this.$emit("close");
        })
        .catch(error => {
          //   console.log(error.response.data);
          if (error.response.data.errors) {
            // tenant user count check error
            this.errors = error.response.data.errors.exceed_plan_error[0];
          }
          if (error.response.data.data) {
            this.errors = error.response.data.data;
          }
        });
    },
    onSubmitEdit(editId) {
      axios
        .put("/api/users/" + editId, {
          _method: "PUT",
          name: this.name,
          email: this.email,
          password: this.password,
          role_id: this.selectedRole
        })
        .then(response => {
          response.index = this.selectedIndexUpdateProp;
          this.$emit("editrow", response);
          this.reset();
          this.$emit("close");
        })
        .catch(error => {
          console.log(error);
          this.errors = error.response.data.data;
        });
    },
    getUser(id) {
      axios
        .get("/api/users/" + id)
        .then(response => {
          this.name = response.data[0].name;
          this.email = response.data[0].email;
          this.selectedRole = response.data[0].role_id;
          this.role_id = response.data[0].role_id;
        })
        .catch(error => {
          console.log(error);
        });
    },
    nonGlobalRoles() {
      axios
        .get("/api/nonGlobalRoles")
        .then(response => {
          this.roles = response.data.slice().reverse(); //reverse order so Subscription Member is first in the list
        })
        .catch(error => {
          console.log(error);
        });
    },
    close() {
      this.reset();
      this.$emit("close");
    },
    reset() {
      this.name = null;
      this.email = null;
      this.password = null;
      this.role_id = 3;
    }
  },
  mounted() {
    this.nonGlobalRoles();
  },
  created() {},
  watch: {
    editIdProp: function(newVal, oldVal) {
      // watch it
      this.getUser(newVal);
    }
  }
};
</script>
