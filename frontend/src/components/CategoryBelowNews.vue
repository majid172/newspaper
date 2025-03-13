<template>
  <div class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4" v-for="item in bottomArticles">
    <router-link :to="{ name: 'news', params: { id: item.id } }">
      <div class="relative rounded-md overflow-hidden">
        <img
            :src="item.thumbnail"
            class="w-full h-auto object-cover"
            :alt="item.headline"
        />
        <div class="p-2">
          <h3 class="text-lg font-semibold leading-snug">{{item.headline}}</h3>
        </div>

      </div>
    </router-link>
  </div>
</template>
<script setup>
  const props = defineProps({
    bottomArticles:{
      type: Object,
      required: true,
    }
  });
</script>