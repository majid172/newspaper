<template>
  <div class="bg-[#BB4430] text-white">
    <!-- Use mx-auto and px-4 to center content and add padding, avoiding overflow -->
    <div class="container mx-auto px-4 flex items-center justify-between py-4">

      <!-- Left: Menu Items (Rendered Conditionally for Responsiveness) -->
      <div class="hidden md:flex space-x-6 font-semibold text-sm">
        <router-link to="/" @click="handleClick('/')" class="hover:underline">হোম</router-link>
        <router-link to="/latest" @click="handleClick('/')" class="hover:underline">সর্বশেষ </router-link>
        <router-link to="/national" @click="handleClick('national')" class="hover:underline">জাতীয়</router-link>
        <router-link to="/politics" @click="handleClick('politics')" class="hover:underline">রাজনীতি</router-link>
        <router-link to="/world" @click="handleClick('world')" class="hover:underline">আন্তর্জাতিক</router-link>
        <router-link to="/sports" @click="handleClick('sports')" class="hover:underline">খেলা</router-link>
        <router-link to="/entertainment" @click="handleClick('entertainment')" class="hover:underline">বিনোদন</router-link>
        <router-link to="/economics" @click="handleClick('economics')" class="hover:underline">অর্থনীতি</router-link>
        <router-link to="/emigration" @click="handleClick('emigration')" class="hover:underline">প্রবাস</router-link>
      </div>

      <!-- Right: Search & Menu Icon (Mobile Menu Trigger) -->
      <div class="flex items-center space-x-4">
        <button class="text-white focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"/>
          </svg>
        </button>

        <!-- Mobile Menu Button (Hidden on Desktop) -->
        <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
      </div>

      <!-- Mobile Menu (Initially Hidden) -->
      <div id="mobile-menu" class="md:hidden absolute top-16 left-0 w-full bg-[#BB4430] py-2 shadow-md z-10">
        <div class="flex flex-col items-center space-y-2">
          <router-link to="/" @click="handleClick('/')" class="hover:underline text-white block py-2 px-4">হোম</router-link>
          <router-link to="/latest" @click="handleClick('/')" class="hover:underline text-white block py-2 px-4">সর্বশেষ</router-link>
          <router-link to="/national" @click="handleClick('national')" class="hover:underline text-white block py-2 px-4">জাতীয়</router-link>
          <router-link to="/politics" @click="handleClick('politics')" class="hover:underline text-white block py-2 px-4">রাজনীতি</router-link>
          <router-link to="/world" @click="handleClick('world')" class="hover:underline text-white block py-2 px-4">আন্তর্জাতিক</router-link>
          <router-link to="/sports" @click="handleClick('sports')" class="hover:underline text-white block py-2 px-4">খেলা</router-link>
          <router-link to="/entertainment" @click="handleClick('entertainment')" class="hover:underline text-white block py-2 px-4">বিনোদোন</router-link>
          <router-link to="/economics" @click="handleClick('economics')" class="hover:underline text-white block py-2 px-4">অর্থনীতি</router-link>
          <router-link to="/emigration" @click="handleClick('emigration')" class="hover:underline text-white block py-2 px-4">প্রবাস</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {onMounted} from 'vue';
import {useArticleStore} from "@/stores/article.js";
const articleStore = useArticleStore();

const handleClick = async (path) => {
  await articleStore.fetchArticles(path);
};

onMounted(() => {
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }
});
</script>