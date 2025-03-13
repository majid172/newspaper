<template>
  <div class="bg-white py-4 shadow-md">
    <div class="container mx-auto  flex flex-col md:flex-row justify-between items-center px-4 md:px-12 lg:px-32 space-y-4 md:space-y-0">
      <div>
        <a href="javascript:void(0)">
          <img src="@/assets/image/logo.png" alt="Logo" class="h-12">
        </a>
      </div>
      <div>
        <a href="javascript:void(0)">
                <img src="@/assets/image/ads.jpg" alt="Ads" class="h-12">
        </a>
      </div>

      <div class="flex w-full md:w-auto items-center border border-gray-300 rounded-lg overflow-hidden">
        <input type="text" placeholder="Search" class="p-2 outline-none w-full md:w-60">
        <button class="bg-red-800 hover:bg-red-600 text-white px-3 py-2">
          <i class="fas fa-search"></i>
        </button>
      </div>

    </div>
  </div>

</template>
<script setup lang="ts">
</script>