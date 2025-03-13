<script setup>
const props = defineProps({
  international:{
    type:Object,
  },
});
</script>
<template>
  <div class="shadow-md p-4 rounded-lg mb-8">
    <div class="flex flex-col">
      <div class="w-full">
        <div class="flex items-center mb-3">
          <div class="text-2xl md:text-2xl flex-shrink-0 self-end">আন্তর্জাতিক</div>
          <div class="h-1 bg-red-600 flex-grow ml-2"></div>
        </div>
      </div>

      <div class="flex flex-col md:flex-row gap-4">
        <div class="w-full md:w-5/12">
          <a href="https://news.muslimdm.com/news/69">
            <img :src="international.internationalLead.thumbnail" class="w-full rounded-lg" :alt="international.internationalLead.headline">
          </a>
          <div class="py-2">
            <a href="https://news.muslimdm.com/news/69">
              <h3 class="text-2xl font-medium"> {{international.internationalLead.headline}}
                </h3>
            </a>
            <p class="text-sm mt-2 mb-1 text-gray-600" v-if="international.internationalLead.details && international.internationalLead.details.body" v-html="international.internationalLead.details.body.slice(0,400)+(international.internationalLead.details.body.length > 400 ? '...':'')"></p>

          </div>
        </div>

        <div class="w-full md:w-7/12">
          <div class="flex flex-col gap-4">
            <div class="flex flex-row gap-4">

              <div class="w-1/3" v-for="(item, index) in (international.internationalSide || [])" :key="index">

                <div class="bg-transparent" >
                  <a href="">
                    <div class="relative">
                      <img :src="item.thumbnail" class="w-full rounded-lg" >
                    </div>
                    <div class="py-2">
                      <h3 class="text-lg font-medium">
                        {{ item.headline }}
                      </h3>
                    </div>
                  </a>
                </div>
              </div>

              <!--              <div class="w-1/3">-->
<!--                <div class="bg-transparent">-->
<!--                  <a href="https://news.muslimdm.com/news/67">-->
<!--                    <div class="relative">-->
<!--                      <img src="" class="w-full rounded-lg" alt="ট্রাম্পের জাতীয় জরুরি অবস্থা ঘোষণা, মেক্সিকো সীমান্তে সেনা মোতায়েন">-->
<!--                    </div>-->
<!--                    <div class="py-2">-->
<!--                      <h3 class="text-lg font-medium">-->
<!--                        ট্রাম্পের জাতীয় জরুরি অবস্থা ঘোষণা, মেক্সিকো সীমান্তে সেনা মোতায়েন-->
<!--                      </h3>-->
<!--                    </div>-->
<!--                  </a>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="w-1/3">-->
<!--                <div class="bg-transparent">-->
<!--                  <a href="https://news.muslimdm.com/news/66">-->
<!--                    <div class="relative">-->
<!--                      <img src="" class="w-full rounded-lg" alt="অবশেষে হামাস-ইসরায়েল যুদ্ধবিরতি কার্যকর">-->
<!--                    </div>-->
<!--                    <div class="py-2">-->
<!--                      <h3 class="text-lg font-medium">-->
<!--                        অবশেষে হামাস-ইসরায়েল যুদ্ধবিরতি কার্যকর-->
<!--                      </h3>-->
<!--                    </div>-->
<!--                  </a>-->
<!--                </div>-->
<!--              </div>-->



            </div>

            <hr class="border-gray-300 my-4">

            <div class="flex flex-row gap-4">

              <div class="w-1/3">
                <div class="bg-transparent">
                  <a href="https://news.muslimdm.com/news/65">
                    <div class="relative">
                      <img src="" class="w-full rounded-lg" alt="পদত্যাগ করতে পারেন ট্রুডো">
                    </div>
                    <div class="py-2">
                      <h3 class="text-lg font-medium">
                        পদত্যাগ করতে পারেন ট্রুডো
                      </h3>
                    </div>
                  </a>
                </div>
              </div>
              <div class="w-1/3">
                <div class="bg-transparent">
                  <a href="https://news.muslimdm.com/news/64">
                    <div class="relative">
                      <img src="" class="w-full rounded-lg" alt="ভিসা, ইকামাসহ সাতটি সেবায় ফি বাড়াল সৌদি আরব">
                    </div>
                    <div class="py-2">
                      <h3 class="text-lg font-medium">
                        ভিসা, ইকামাসহ সাতটি সেবায় ফি বাড়াল সৌদি আরব
                      </h3>
                    </div>
                  </a>
                </div>
              </div>
              <div class="w-1/3">
                <div class="bg-transparent">
                  <a href="https://news.muslimdm.com/news/63">
                    <div class="relative">
                      <img src="" class="w-full rounded-lg" alt="পর্ন তারকাকে ঘুষ দেওয়ার মামলায় সাজা হচ্ছে ডোনাল্ড ট্রাম্পের">
                    </div>
                    <div class="py-2">
                      <h3 class="text-lg font-medium">
                        পর্ন তারকাকে ঘুষ দেওয়ার মামলায় সাজা হচ্ছে ডোনাল্ড ট্রাম্পের
                      </h3>
                    </div>
                  </a>
                </div>
              </div>


            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>