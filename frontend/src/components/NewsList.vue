<script setup>
import { computed } from "vue";

// Define props to get otherArticles from parent component
const props = defineProps({
  otherArticles: {
    type: Object, // Assuming otherArticles is an array of article objects
    required: true,
  },
});

// Computed property for short description (if needed)
const desc = computed(() => {
  return props.otherArticles.map(article => {
    const body = article.details?.body; // Safely access nested properties
    const maxLength = 200;
    return body && body.length > maxLength ? body.substring(0, maxLength) + '...' : body;
  });
});
</script>

<template>
  <div
      class="flex flex-col sm:flex-row items-start mb-5 last:mb-0"
      v-for="(item, index) in otherArticles"
      :key="index">

    <div class="flex-1">
      <router-link :to="{ name: 'news', params: { id: item.id } }">
      <!-- Article Headline -->
      <h4 class="text-xl font-medium mt-0.5">
        {{ item.headline }}
      </h4>
      <p class="text-sm text-gray-700 mt-2 hidden sm:block leading-relaxed"></p>

      <!-- Article Timestamp -->
      <p class="text-xs text-gray-500 mt-3">
        <i class="fa fa-regular fa-clock mr-1"></i> {{ item.created_at }}
      </p>
      </router-link>
    </div>

    <!-- Article Thumbnail -->
    <div class="ml-0 sm:ml-4 mt-2 sm:mt-0">
      <router-link to="">
      <img
          class="rounded-md w-full lg:w-64 object-cover"
          :src="item.thumbnail"
          :alt="item.headline"
      />
      </router-link>
    </div>

  </div>
</template>