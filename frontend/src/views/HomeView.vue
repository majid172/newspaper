<script setup>
// Importing necessary components
import LeadNews from "@/components/LeadNews.vue";
import CategoryTopNews from "@/components/CategoryTopNews.vue";
import CategoryBelowNews from "@/components/CategoryBelowNews.vue";
import NewsList from "@/components/NewsList.vue";
import NationalSection from "@/components/Home/NationalSection.vue";
import CapitaPolitics from "@/components/Home/CapitaPolitics.vue";
import InternationalSection from "@/components/Home/InternationalSection.vue";

// Importing the home store and Vue's lifecycle hook
import { useHomeStore } from "@/stores/home.js"; // Ensure this path is correct
import { onMounted } from "vue";

// Initialize the home store
const homeStore = useHomeStore();

// Fetch home data when the component is mounted
onMounted( () => {
  homeStore.fetchHome();

});
</script>
<template>
  <div class="container mx-auto px-4 md:px-16 lg:px-32 py-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
      <!-- Responsive: 1 col on mobile, 4 cols on large screens -->
      <!-- Left Section (2/3 width on desktop, full width on mobile) -->
      <div class="md:col-span-2 shadow p-4 bg-white rounded-lg">
        <!-- Main News -->
        <div class="mb-6">
          <div class="relative">
            <router-link >

              <img :src="homeStore.homeLead.thumbnail" :alt="homeStore.homeLead.url_title" class="w-full h-64 object-top object-cover rounded-lg" style="aspect-ratio: 1 / 1.3;" loading="lazy">
            </router-link>

          </div>

          <div class="mt-2">
            <h1 class="tw-text-black tw-text-xl md:text-2xl font-bold">
              <a href="https://news.muslimdm.com/news/112">
                {{homeStore.homeLead.headline}}
              </a>

            </h1>
            <a href="https://news.muslimdm.com/news/112">
              <p class="text-gray-700 text-sm" v-if="homeStore.homeLead.details && homeStore.homeLead.details.body"  v-html="homeStore.homeLead.details.body.slice(0, 400) + (homeStore.homeLead.details.body.length > 400 ? '...' : '')">

              </p>
            </a>
          </div>
        </div>

        <!-- Divider -->
        <div class="border-b border-gray-300 my-4"></div>

        <!-- Two Smaller News Items -->
        <div class="grid grid-cols-2 gap-2">
          <!-- News Item (from leadBottom) -->
          <div class="shadow-lg rounded-lg overflow-hidden" v-for="item in homeStore.leadBottom">
            <router-link :to="{ name: 'news', params: { id: item.id } }" >
              <img :src="item.thumbnail" :alt="item.headline" class="w-full h-24 object-top object-cover rounded" style="aspect-ratio: 16 / 9;" loading="lazy">
              <div class="p-2">
                <h3 class="text-lg font-medium">
                  {{ item.headline }}
                </h3>
              </div>
            </router-link>
          </div>

        </div>
      </div>

      <!-- End Left Section -->
      <!-- Middle Section (1/3 width on desktop, full width on mobile) -->
      <!-- Sidebar (More News) -->
      <div class="md:col-span-1 shadow p-2 bg-white rounded-lg"> <!-- Reduced padding -->
        <!-- Sidebar (More News) -->

        <div class="space-y-2"> <!-- Reduced space between items -->
          <!-- Take only 4 articles -->
          <div class="overflow-hidden" v-for="item in homeStore.leadRight">
            <router-link :to="{ name: 'news', params: { id: item.id } }">
              <img :src="item.thumbnail" :alt="item.headline" class="w-full h-25 object-top object-cover rounded-md" style="aspect-ratio: 4 / 3;" loading="lazy">
              <div class="p-1"> <!-- Reduced padding inside -->
                <h3 class="text-lg font-medium">
                  {{ item.headline }}
                </h3>
              </div>
            </router-link>
          </div>

        </div>
      </div>
      <!--End  Middle Section  -->

      <!-- Right Section (1/3 width on desktop, full width on mobile) -->
      <div class="md:col-span-1 shadow p-4 bg-white rounded-lg">

        <!-- See All button -->

        <div class="flex items-center space-x-4 mb-2">
          <a href="https://news.muslimdm.com/video" class="text-white block py-3 text-center font-semibold rounded-md hover:bg-red-600 focus:outline-none cursor-pointer w-full" style="background-color:#e36330; display:block;">
            সব ভিডিও
          </a>
        </div>
        <div class="divide-y divide-gray-200 mb-2">
          <div id="latest" class="tab-content h-35 overflow-y-auto scrollbar">
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1740566840-JwaojxdOTx.png" alt="তরুণ অভিনেতা শাহবাজ সানী আর নেই">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/128">
                    তরুণ অভিনেতা শাহবাজ সানী আর নেই
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1740566530-fCr63o7aUB.png" alt="ভারতে অন্য কাউকে ক্ষমতায় বসাতে অর্থায়ন করেছিল বাইডেন প্রশাসন: ট্রাম্প">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/127">
                    ভারতে অন্য কাউকে ক্ষমতায় বসাতে অর্থায়ন করেছিল বাইডেন প্রশাসন: ট্রাম্প
                  </a>
                </h3>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabs -->
        <div class="flex border-b border-gray-200">
          <button class="flex-1 py-2 px-4 text-lg font-semibold text-center rounded-t-md" style="background-color:#e36330; color:white">
            সর্বশেষ
          </button>
        </div>

        <!-- Latest News Content -->

        <div class="divide-y divide-gray-200">
          <div id="latest" class="tab-content h-40 overflow-y-auto scrollbar">
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1740566840-JwaojxdOTx.png" alt="তরুণ অভিনেতা শাহবাজ সানী আর নেই">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/128">
                    তরুণ অভিনেতা শাহবাজ সানী আর নেই
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1740566530-fCr63o7aUB.png" alt="ভারতে অন্য কাউকে ক্ষমতায় বসাতে অর্থায়ন করেছিল বাইডেন প্রশাসন: ট্রাম্প">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/127">
                    ভারতে অন্য কাউকে ক্ষমতায় বসাতে অর্থায়ন করেছিল বাইডেন প্রশাসন: ট্রাম্প
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739732115-kKfpyyMoR0.png" alt="জুলাইয়ের কন্যা">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/125">
                    জুলাইয়ের কন্যা
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739732022-Eco2IJknHc.jpeg" alt="শ্রেষ্ঠ সন্তানদের জন্য শ্রদ্ধা">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/124">
                    শ্রেষ্ঠ সন্তানদের জন্য শ্রদ্ধা
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739731197-R41cNBKvJD.jpg" alt="কেরানীগঞ্জের জমি যেন ‘পুঁথিগত বিদ্যা, পর হস্তে ধন’">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/123">
                    কেরানীগঞ্জের জমি যেন ‘পুঁথিগত বিদ্যা, পর হস্তে ধন’
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739731096-ARI8oTTmkG.jpg" alt="পিক আওয়ারে বেশি ও অফ-পিকে কম টাকায় বিদ্যুৎ দিতে হবে">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/122">
                    পিক আওয়ারে বেশি ও অফ-পিকে কম টাকায় বিদ্যুৎ দিতে হবে
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739730949-7TTFoMODEa.jpg" alt="খুলছে না পাথররাজ্যের দুয়ার">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/121">
                    খুলছে না পাথররাজ্যের দুয়ার
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739730794-lZ8AKTjOYR.jpg" alt="দেশজুড়ে শিশুদের টিকার তীব্র সংকট">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/120">
                    দেশজুড়ে শিশুদের টিকার তীব্র সংকট
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739630340-Aj1pGFowkG.jpg" alt="১৩ বছরের কিশোরীকে গণধর্ষণ-হত্যা, হাতিরঝিলে মিলল লাশ">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/116">
                    ১৩ বছরের কিশোরীকে গণধর্ষণ-হত্যা, হাতিরঝিলে মিলল লাশ
                  </a>
                </h3>
              </div>
            </div>
            <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
              <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739630230-faibVdy2FY.jpg" alt="রাজধানীতে ছিনতাইয়ের কবলে ইতালির নাগরিক, গ্রেপ্তার ২">
              <div>
                <h3 class="text-sm text-gray-800">
                  <a href="https://news.muslimdm.com/news/115">
                    রাজধানীতে ছিনতাইয়ের কবলে ইতালির নাগরিক, গ্রেপ্তার ২
                  </a>
                </h3>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-4 mt-1">
          <div class="flex items-center space-x-2 mt-4">
            <h2 class="text-2xl md:text-2xl flex-shrink-0 self-end">মতামত</h2>
            <div class="h-0.5 bg-[#e36330] flex-grow"></div>
          </div>

          <div class="divide-y divide-gray-200">
            <div id="latest" class="tab-content h-80 overflow-y-auto scrollbar">
              <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
                <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739631499-iPeTDrrNBm.jpg" alt="পতাকা ও পাউরুটির গল্প">
                <div>
                  <h3 class="text-sm text-md text-lg text-gray-800">
                    <a href="https://news.muslimdm.com/news/119">
                      পতাকা ও পাউরুটির গল্প
                    </a>
                  </h3>
                </div>
              </div>
              <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
                <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739631441-TmOYJaTy2h.png" alt="ভোট ছাড়াও ড. ইউনূসের যে ঘোষণাটি খেয়াল করা দরকার">
                <div>
                  <h3 class="text-sm text-md text-lg text-gray-800">
                    <a href="https://news.muslimdm.com/news/118">
                      ভোট ছাড়াও ড. ইউনূসের যে ঘোষণাটি খেয়াল করা দরকার
                    </a>
                  </h3>
                </div>
              </div>
              <div class="grid grid-cols-[20%_80%] items-start p-4 gap-x-4">
                <img class="h-10 w-full object-cover rounded-md" src="https://news.muslimdm.com/uploads/article-photos/1739631376-2fgsL7Qd3V.jpg" alt="কেন গণঅভ্যুত্থানের ঘোষণাপত্র জরুরি">
                <div>
                  <h3 class="text-sm text-md text-lg text-gray-800">
                    <a href="https://news.muslimdm.com/news/117">
                      কেন গণঅভ্যুত্থানের ঘোষণাপত্র জরুরি
                    </a>
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- End Right Section -->
    </div>
    <NationalSection :national="homeStore"/>
    <CapitaPolitics :capitalPolitics="homeStore"/>
    <InternationalSection :international="homeStore"/>
  </div>
</template>