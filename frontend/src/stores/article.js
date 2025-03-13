import {ref,computed} from 'vue'
import {defineStore} from "pinia";
import axios from "axios";
import {useRoute} from "vue-router";

export const useArticleStore = defineStore('articleStore',()=>{
    const leadArticle = ref([]);
    const leadArticleDesc = ref('');
    const topArticles = ref([]);
    const bottomArticles = ref([]);
    const otherArticles = ref([]);

    const maxLength = 100; // Set the max length here
    const limitedLeadArticleDesc = computed(() => {
        const body = leadArticleDesc.value || '';
        return body.length > maxLength ? body.substring(0, maxLength) + '...' : body;
    });
    const fetchArticles = async (path)=>{
        // const path = window.location.pathname;
        if(path == '/')
        {
            path = '/home';

        }
        console.log(path);
        const {data} = await axios.get(path);

        leadArticle.value = data.leadArticle;
        leadArticleDesc.value = data.leadArticle.details.body;
        topArticles.value = data.topArticles;
        bottomArticles.value = data.bottomArticles;
        otherArticles.value = data.otherArticles;
    };
    return { leadArticle,fetchArticles, topArticles,leadArticleDesc,bottomArticles,otherArticles };
});