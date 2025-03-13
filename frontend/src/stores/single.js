import {defineStore} from "pinia";
import {ref} from 'vue';
import axios from "axios";
export const useSingleNewsStore = defineStore('singleNewsStore',()=>{
   const article = ref([]);
   const category = ref('');
    const fetchNews = async (path)=>{
       // const newsId = path.split("/").pop();
       const {data} = await axios.get(path)
        article.value = data.article;
        category.value = data.article.categories;
   };
   return {fetchNews,article,category};
});