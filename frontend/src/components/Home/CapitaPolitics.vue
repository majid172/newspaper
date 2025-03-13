<script setup>
defineProps({
  capitalPolitics:{
    type:Object
  }
})
</script>
<template>
  <div class="py-8 grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Politics Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div class="flex items-center mb-3 m-3">
        <div class="text-2xl md:text-2xl flex-shrink-0 self-end">রাজণীতি</div>
        <div class="h-1 bg-red-600 flex-grow ml-2"></div>
      </div>
      <div class="flex flex-col md:flex-row items-start gap-4 mx-3">
        <a href="https://news.muslimdm.com/news/61" class="flex flex-col md:flex-row items-start gap-4 mx-3">
          <img :src="capitalPolitics.politicsLead.thumbnail" :alt="capitalPolitics.politicsLead.headline" class="w-full md:w-1/2 rounded-lg">
          <div class="w-full md:w-1/2 flex flex-col">
            <h3 class="text-2xl font-medium  mb-2">
              {{capitalPolitics.politicsLead.headline}}
            </h3>

            <p class="font-lg text-gray-600" v-if="capitalPolitics.politicsLead.details && capitalPolitics.politicsLead.details.body" v-html="capitalPolitics.politicsLead.details.body.slice(0,400)+(capitalPolitics.politicsLead.details.body.length > 400 ? '...':'')"></p>
          </div>
        </a>
      </div>
      <div class="grid grid-cols-3 gap-2 px-4 py-2">


        <div v-for="item in capitalPolitics.politicsSide">
          <router-link :to="{name:'news',params:{id:item.id}}">
            <img src="" :alt="item.headline" class="w-full object-cover rounded">
            <p class="text-md font-medium">
              {{ item.headline }}
            </p>
          </router-link>
        </div>


      </div>
    </div>


    <!-- Capital Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div class="flex items-center mb-3 m-3">
        <div class="text-2xl md:text-2xl flex-shrink-0 self-end">রাজধানী</div>
        <div class="h-1 bg-red-600 flex-grow ml-2"></div>
      </div>
      <div class="flex flex-col md:flex-row items-start gap-4 mx-3">
        <a href="https://news.muslimdm.com/news/60" class="flex flex-col md:flex-row items-start gap-4 mx-3">
          <img :src="capitalPolitics.capitalLead.thumbnail" :alt="capitalPolitics.capitalLead.headline" class="w-full md:w-1/2 rounded-lg">
          <div class="w-full md:w-1/2 flex flex-col">
            <h3 class="text-2xl font-medium  mb-2">
              {{ capitalPolitics.capitalLead.headline }}
            </h3>

            <p class="font-lg text-gray-600" v-if="capitalPolitics.capitalLead.details && capitalPolitics.capitalLead.details.body" v-html="capitalPolitics.capitalLead.details.body.slice(0,400)+(capitalPolitics.capitalLead.details.body.length > 400 ? '...':'')"></p>
          </div>
        </a>
      </div>
      <div class="grid grid-cols-3 gap-2 px-4 py-2">

        <div v-for="item in capitalPolitics.capitalSide">
          <router-link :to="{name:'news',params:{id:item.id}}">
            <img :src="item.thumbnail" :alt="item.headline" class="w-full object-cover rounded">
            <p class="text-md font-medium">
              {{item.headline}}
            </p>
          </router-link>
        </div>


      </div>
    </div>

  </div>
</template>