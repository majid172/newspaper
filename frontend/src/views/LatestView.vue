<script setup>
import LeadNews from "@/components/LeadNews.vue";
import CategoryTopNews from "@/components/CategoryTopNews.vue";
import CategoryBelowNews from "@/components/CategoryBelowNews.vue";
import NewsList from "@/components/NewsList.vue";
</script>
<template>
  <div class="container mx-auto px-4 md:px-16 lg:px-32 py-8">
    <div class="flex flex-wrap -mx-2">
      <!-- Category Lead News -->
      <div class="w-full sm:w-1/2 px-2 mb-4">
        <!--    start    lead news-->
<!--        <LeadNews/>-->
        <!--        end lead news-->
      </div>

      <!-- Category Top News -->
      <div class="w-full sm:w-1/2">
        <div class="flex flex-wrap">
          <!-- News Item 1 -->
<!--          <CategoryTopNews/>-->
<!--          <CategoryTopNews/>-->
<!--          <CategoryTopNews/>-->
<!--          <CategoryTopNews/>-->

        </div>
      </div>
    </div>


    <div class="flex flex-wrap mt-2 -mx-2">
      <!-- News Item 1 -->
<!--      <CategoryBelowNews/>-->
<!--      <CategoryBelowNews/>-->
<!--      <CategoryBelowNews/>-->
<!--      <CategoryBelowNews/>-->

    </div>


    <div class="mx-auto w-full sm:w-10/12 md:w-8/12 mt-5">
      <!-- News Item 1 -->
<!--      <NewsList/>-->
<!--      <NewsList/>-->
<!--      <NewsList/>-->


      <!-- Add more news items here -->
    </div>
  </div>
</template>