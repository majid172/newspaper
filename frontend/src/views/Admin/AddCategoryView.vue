<script setup>
import Navbar from "@/components/layouts/Admin/Navbar.vue";
import Aside from "@/components/layouts/Admin/Aside.vue";
import Footer from "@/components/layouts/Admin/Footer.vue";
import Input from "@/components/layouts/Input.vue";
import Select from "@/components/layouts/Select.vue";
import { useCategoryStore } from "@/stores/category.js";
import { onMounted } from "vue";

const categoryStore = useCategoryStore();

// Handle form submission
const formHandle = () => {
  categoryStore.addCategory();
};

onMounted(() => {
  categoryStore.fetchCategory();
});
</script>

<template>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <Aside/>
      <div class="layout-page">
        <Navbar/>

        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-6">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Category</h5>
              </div>

              <div class="card-body">
                <form @submit.prevent="formHandle">
                  <div class="row">
                    <div class="col-lg-6">
                      <Input
                          type="text"
                          id="category_name"
                          icon="bx bx-category"
                          label="Category Name"
                          placeholder="Enter Category Name"
                      />
                    </div>
                    <div class="col-lg-6">
                      <Input
                          type="text"
                          id="title"
                          label="Category Title"
                          icon="bx bx-category-alt"
                          placeholder="Enter Category Title"
                      />
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <Select
                          label="Parent Category"
                          id="parent_category"
                          :options="categoryStore.parentCategories"
                          optionLabelKey="category_name"
                          optionValueKey="id"
                      />
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary mt-3" :disabled="categoryStore.loading">
                    <span v-if="categoryStore.loading">Saving...</span>
                    <span v-else>Submit</span>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <Footer/>
      </div>
    </div>
  </div>
</template>
