<template>
  <div class="rounded-md overflow-hidden relative">
    <img
        :src="articleStore.leadArticle.thumbnail"
        class="w-full h-auto object-cover rounded-md"
        :alt="articleStore.leadArticle.headline"
    />
    <div class="p-4">
      <h1 class="text-xl font-semibold mb-2">
        {{ articleStore.leadArticle.headline }}
      </h1>
      <p v-if="articleStore.leadArticle.details && articleStore.leadArticle.details.body" class="text-gray-700 sm:block" v-html="articleStore.leadArticleDesc.slice(0, 400) + (articleStore.leadArticleDesc.length > 400 ? '...' : '')"></p>
      <p v-else class="text-gray-500">No content available</p>

    </div>
<!--    :to="{ name: 'news', params: { id: item.id } }"-->
    <router-link
        v-if="articleStore.leadArticle && articleStore.leadArticle.id"
        :to="{ name: 'news', params: { id: articleStore.leadArticle.id } }"
        class="absolute inset-0"
    >
      <span class="sr-only">{{ articleStore.leadArticle.headline }}</span>
    </router-link>

  </div>
</template>

<script setup>
import { computed } from "vue";
defineProps({
  articleStore: {
    type: Object,
    required: true,
  },
});

</script>
