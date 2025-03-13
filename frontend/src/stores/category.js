import { ref } from 'vue';
import { defineStore } from "pinia";
import axios from 'axios';

export const useCategoryStore = defineStore('categoryStore', () => {
    const categories = ref([]);
    const parentCategories = ref([]);
    const currentPage = ref(1);
    const perPage = ref(10);
    const totalItems = ref(0);
    const totalPages = ref(0);
    const loading = ref(false);
    const inputField = ref({ category_name: '', title: '', parent_category: '' });

    const fetchCategory = async (page = 1) => {
        loading.value = true;
        try {
            const { data } = await axios.get('/admin/category', {
                params: {
                    page,
                    per_page: perPage.value
                },
            });

            categories.value = data.lists.data;  // ✅ Corrected categories assignment
            parentCategories.value = data.categories;
            currentPage.value = page;
            totalItems.value = data.lists.total;
            totalPages.value = data.lists.last_page;
        } catch (error) {
            console.error('Error fetching categories:', error);
        } finally {
            loading.value = false;
        }
    };

    const changePage = (page) => {
        if (page > 0 && page <= totalPages.value) {
            fetchCategory(page);
        }
    };

    const addCategory = async () => {
        console.log(inputField.value)
        try {
            const { data } = await axios.post("/admin/create/category", inputField.value);
            console.log(data);

        } catch (error) {
            console.error("Error adding category:", error);
        } finally {
            loading.value = false;
        }
    };

    return {
        categories,
        parentCategories,
        totalItems,
        currentPage,
        perPage,
        totalPages,
        loading,
        changePage,
        fetchCategory,
        addCategory
    };
});
