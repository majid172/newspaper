<template>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <Aside />

      <div class="layout-page">
        <Navbar />

        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
              <div class="row card-header">
                <div class="col-8"><h5>Category List</h5></div>
              </div>

              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead class="table-dark">
                  <tr>
                    <th>SL.</th>
                    <th>Category Name</th>
                    <th>Title</th>
                    <th>Parent</th>
                    <th>Header Display</th>
                    <th>Menu Bar Display</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  <tr v-for="(item, index) in categoryStore.categories.data" :key="item.id">
                    <td>{{ (categoryStore.currentPage - 1) * categoryStore.perPage + index + 1 }}</td>
                    <td>{{ item.category_name }}</td>
                    <td>{{ item.title }}</td>
                    <td>
                        <span v-if="item.parent_category" class="badge bg-label-primary me-1">
                          {{ item.parent_category.category_name }}
                        </span>
                      <span v-else class="badge bg-label-warning me-1">--</span>
                    </td>
                    <td>
                      <span v-if="item.header_display" class="badge bg-label-primary me-1">Yes</span>
                      <span v-else class="badge bg-label-warning me-1">No</span>
                    </td>
                    <td>
                      <span v-if="item.menubar_display" class="badge bg-label-primary me-1">Yes</span>
                      <span v-else class="badge bg-label-warning me-1">No</span>
                    </td>
                    <td>
                      <span v-if="item.status" class="badge bg-label-success me-1">Active</span>
                      <span v-else class="badge bg-label-warning me-1">Inactive</span>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                          </a>
                          <a class="dropdown-item" href="javascript:void(0);">
                            <i class="bx bx-trash me-1"></i> Delete
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>

              <div v-if="categoryStore.totalPages && categoryStore.totalPages > 1" class="d-flex justify-content-between align-items-center p-3">
                <button class="btn btn-secondary" :disabled="categoryStore.currentPage === 1" @click="categoryStore.changePage(categoryStore.currentPage - 1)">
                  Prev
                </button>
                <span>Page {{ categoryStore.currentPage }} of {{ categoryStore.totalPages }}</span>
                <button class="btn btn-secondary" :disabled="categoryStore.currentPage === categoryStore.totalPages" @click="categoryStore.changePage(categoryStore.currentPage + 1)">
                  Next
                </button>
              </div>
            </div>
          </div>
        </div>
        <Footer />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Aside from "@/components/layouts/Admin/Aside.vue";
import Navbar from "@/components/layouts/Admin/Navbar.vue";
import Footer from "@/components/layouts/Admin/Footer.vue";
import { useCategoryStore } from "@/stores/category.js";

const categoryStore = useCategoryStore();
const modalCenter = ref(null);

onMounted(() => {
  categoryStore.fetchCategory();
});
</script>
