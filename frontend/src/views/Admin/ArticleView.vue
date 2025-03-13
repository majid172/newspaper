<template>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <Aside />

      <!-- Layout container -->
      <div class="layout-page">
        <Navbar />

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
              <h5 class="card-header">Article List</h5>

              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead class="table-dark">
                  <tr>
                    <th>SL.</th>
                    <th>Headline</th>
                    <th>Placement</th>
                    <th>Thumbnail</th>
                    <th>Category</th>
                    <th>Hit</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                  </thead>

                  <tbody class="table-border-bottom-0">
                  <tr v-for="(article, index) in adminArticleStore.articles.data" :key="article.id">
                    <td>{{ (adminArticleStore.currentPage - 1) * adminArticleStore.perPage + index + 1 }}</td>
                    <td>{{ article.headline }}</td>
                    <td>{{ article.placement ? article.placement.name : 'N/A' }}</td>
                    <td>
                      <img
                          v-if="article.thumbnail"
                          :src="article.thumbnail"
                          alt="Thumbnail"
                          class="rounded"
                          width="50"
                      />
                      <span v-else>No Image</span>
                    </td>
                    <td>
                        <span v-if="article.categories.length">
                          {{ article.categories.map(category => category.category_name).join(', ') }}
                        </span>
                      <span v-else>N/A</span>
                    </td>
                    <td>{{ article.total_hit }}</td>
                    <td>
                        <span :class="{
                          'badge bg-success': article.status === 'published',
                          'badge bg-danger': article.status === 'inactive'
                        }">
                          {{ article.status.toUpperCase() }}
                        </span>
                    </td>
                    <td>{{ article.created_at }}</td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->

              <div v-if="adminArticleStore.totalPages > 1" class="d-flex justify-content-between align-items-center p-3">
                <button
                    class="btn btn-secondary"
                    :disabled="adminArticleStore.currentPage === 1"
                    @click="adminArticleStore.changePage(adminArticleStore.currentPage - 1)">
                  Prev
                </button>

                <span>Page {{ adminArticleStore.currentPage }} of {{ adminArticleStore.totalPages }}</span>

                <button
                    class="btn btn-secondary"
                    :disabled="adminArticleStore.currentPage === adminArticleStore.totalPages"
                    @click="adminArticleStore.changePage(adminArticleStore.currentPage + 1)">
                  Next
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Aside from "@/components/layouts/Admin/Aside.vue";
import Navbar from "@/components/layouts/Admin/Navbar.vue";
import Footer from "@/components/layouts/Admin/Footer.vue";
import { useAdminArticleStore } from '@/stores/admin_article';
import { onMounted } from "vue";

const adminArticleStore = useAdminArticleStore();

onMounted(() => {
  adminArticleStore.fetchArticles(); // Fetch the first page by default
});
</script>
