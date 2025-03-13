<script setup>
// Define the prop
const props = defineProps({
  national: {
    type: Object,
    required: true,
  },
});

</script>

<template>
  <div class="grid grid-cols-1 md:grid-cols-4 gap-3 my-8">
    <!-- Left Section -->
    <div class="md:col-span-3 shadow-md p-4 bg-white rounded-lg">
      <div class="flex items-center mb-3">
        <div class="text-2xl md:text-2xl flex-shrink-0 ">জাতীয়</div>
        <div class="h-1 bg-red-600 flex-grow ml-2"></div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Main News -->
        <div>
          <div>
            <router-link :to="{name:'news',params:{id:1}}">

              <img :src="national.nationalLead.thumbnail" :alt="national.nationalLead.headline" class="w-full object-cover rounded-lg">
              <div class="p-3">
                <h5 class="text-2xl md:text-2xl font-medium">
                  <span class="text-red-500" v-if="national.nationalLead.hanger">{{ national.nationalLead.hanger }}</span>
                  <span class="text-gray-400 text-xl font-bold mx-1" v-if="national.nationalLead.hanger">•</span>
                  {{national.nationalLead.headline}}
                </h5>

                <p class="font-lg text-gray-600" v-if="national.nationalLead.details && national.nationalLead.details.body" v-html="national.nationalLead.details.body.slice(0,400)+(national.nationalLead.details.body.length > 400 ? '...':'')">

                </p>
              </div>
            </router-link>
          </div>
        </div>

        <!-- Sidebar (More News) -->
        <div>

          <div v-if="national.nationalSide">
            <div class="relative flex items-start mb-3" v-for="item in national.nationalSide">
              <!-- Image Section -->
              <div class="flex-shrink-0">
                <router-link :to="{name:'news',params:{id:item.id}}">
                  <img
                      class="rounded-lg w-32 h-20 object-cover"
                      :src="item.thumbnail"
                      :alt="item.headline"
                  />
                </router-link>
              </div>

              <div class="ml-5">
                <router-link :to="{name:'news',params:{id:item.id}}">
                  <p class="text-lg font-medium md:text-lg md:font-medium">
                    <span class="text-red-500" v-if="item.hanger">{{ item.hanger }}</span>
                    <span class="text-gray-400 text-xl font-bold mx-1" v-if="item.hanger">•</span>
                    {{ item.headline }}
                  </p>
                </router-link>
              </div>
            </div>
          </div>


        </div>
      </div>
      <!-- End Grid -->
    </div>
    <!-- End Left Section -->

    <!-- Right Section -->
    <div class="md:col-span-1 shadow p-4 bg-white rounded-lg">
      <div class="flex items-center mb-3">
        <div class="text-2xl md:text-2xl flex-shrink-0 self-end">বিশেষ সংবাদ</div>
        <div class="h-1 bg-red-600 flex-grow ml-2"></div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="mb-3" v-for="item in national.specialArticles">
          <router-link :to="{name:'news',params:{id:item.id}}">
            <img class="w-full h-16 object-cover rounded-md mb-2" :src="item.thumbnail" :alt="item.headline">
          </router-link>

          <h3 class="font-medium text-lg">
            <router-link :to="{name:'news',params:{id:item.id}}">
              {{item.headline}}
            </router-link>
          </h3>
        </div>
      </div>
    </div>
    <!-- End Right Section -->
  </div>
</template>