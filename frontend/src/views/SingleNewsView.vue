<script setup>
import {onMounted,ref} from "vue";

const articleUrl = "https://bangla18.com/national/637";
import {useSingleNewsStore} from "@/stores/single.js";
import {useRoute} from "vue-router";
const singleNews = useSingleNewsStore();
const route = useRoute();

onMounted(()=>{
    singleNews.fetchNews(route.path);
})
</script>

<template>
  <div class="container mx-auto px-4 md:px-16 lg:px-32 py-8">
    <!-- Article Header -->
    <div class="mb-5">
      <p class="text-xl mb-7 underline underline-offset-8" v-for="item in singleNews.category">
        <router-link to=""  :aria-label="item.category_name" class="font-semibold text-blue-600">
          {{ item.category_name }}
        </router-link>
      </p>

      <p class="text-lg font-medium text-red-600" v-if="singleNews.article.shoulder">{{ singleNews.article.shoulder }}</p>
      <h1 class="text-3xl font-bold mt-3">
        <strong>{{singleNews.article.headline}}</strong>
      </h1>
    </div>

    <!-- Author Information -->
    <div class="flex items-center gap-3 mt-2">
      <img
          src="https://bangla18.com/uploads/settings/2-1---Copyicon-2-1734105703.png"
          class="rounded-full w-12 h-12"
          alt="Icon"
      />
      <div>
        <p class="text-sm font-medium">অনলাইন ডেস্ক</p>
        <p class="text-xs text-gray-600">প্রকাশ: {{ singleNews.article.created_at }}</p>
      </div>
    </div>

    <!-- Share Buttons -->
    <div class="mt-4 hidden-print">
      <div class="sharethis-inline-share-buttons" data-url="articleUrl"></div>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
      <!-- Main Content (Spans 2 Columns on Medium & Larger Screens) -->
      <div class="md:col-span-2 bg-white p-6 shadow-lg rounded-lg">
        <!-- News Image -->

          <img
              :src="'../'+singleNews.article.thumbnail"
              class="w-full rounded-lg"
              :alt="singleNews.article.headline"
          />

        <div v-if="singleNews?.article?.details?.body" class="prose max-w-none" v-html="singleNews.article.details.body"></div>
        <p v-else>Loading...</p>

      </div>
      <!-- Sidebar / Related News -->
      <aside class="md:col-span-1 bg-white p-6 shadow-lg rounded-lg">
        <h2 class="text-xl font-bold mb-4">সম্পর্কিত খবর</h2>
        <ul class="space-y-2">
          <li><a href="#" class="text-blue-600 hover:underline">অন্য একটি গুরুত্বপূর্ণ সংবাদ</a></li>
          <li><a href="#" class="text-blue-600 hover:underline">রাজনৈতিক বিশ্লেষণ</a></li>
          <li><a href="#" class="text-blue-600 hover:underline">আন্তর্জাতিক সম্পর্ক</a></li>
        </ul>
      </aside>
    </div>
  </div>
</template>
