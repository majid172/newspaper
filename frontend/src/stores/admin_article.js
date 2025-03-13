import { defineStore } from 'pinia';
import { ref } from 'vue';
import axios from 'axios';

export const useAdminArticleStore = defineStore('adminArticleStore', () => {
    const articles = ref([]);
    const currentPage = ref(1);
    const perPage = ref(10);
    const totalItems = ref(0);
    const totalPages = ref(0);
    const loading = ref(false);

    // Fetch articles with pagination
    const fetchArticles = async (page = 1) => {
        loading.value = true;
        try {
            const { data } = await axios.get('admin/articles', {
                params: {
                    page,
                    per_page: perPage.value,
                },
            });

            articles.value = data.articles;
            totalItems.value = data.articles.total;
            totalPages.value = Math.ceil(totalItems.value / perPage.value);
            currentPage.value = page;
        } catch (error) {
            console.error('Error fetching articles:', error);
        } finally {
            loading.value = false;
        }
    };

    // Set the current page and fetch data
    const changePage = (page) => {
        if (page > 0 && page <= totalPages.value) {
            fetchArticles(page);
        }
    };

    return {
        articles,
        currentPage,
        perPage,
        totalItems,
        totalPages,
        loading,
        fetchArticles,
        changePage,
    };
});
