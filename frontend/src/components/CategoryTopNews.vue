<script setup>
const props = defineProps({
  topArticles: {
    type: Object,
    required: true,
  },
})
</script>
<template>

  <div class="w-full sm:w-1/2 px-2 mb-4" v-for="item in props.topArticles">
    <router-link :to="{ name: 'news', params: { id: item.id } }">
      <div class="relative">
      <img
          :src="item.thumbnail"
          class="w-full h-auto object-cover rounded-md"
          :alt="item.headline"
      />

      <div class="p-2">
        <h3 class="text-lg font-semibold">
          {{item.headline}}
        </h3>
      </div>

    </div>
    </router-link>
  </div>
</template>