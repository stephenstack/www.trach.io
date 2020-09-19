<template>
  <div class="mt-1">
    <div
      :class="value ? 'bg-green-500' : 'bg-gray-400'"
      class="w-8 h-4 rounded-full shadow inline-block cursor-pointer"
      @click="registerClick(value)"
    >
      <div
        :style="{ transform: `translateX(${value ? 100 : 0}%)` }"
        class="w-1/2 h-full bg-white rounded-full shadow"
      />
    </div>
  </div>
</template>

<script>
export default {
    data: () => ({
        newValue: false,
    }),
  model: {
    event: 'change',
  },
  methods:{
      registerClick(v){
          this.newValue = !v;
          this.$emit('change', this.newValue)
      }
  },
  props: {
    value: {
      type: Boolean,
      required: true,
    },
  },
};
</script>