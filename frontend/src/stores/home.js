import {defineStore} from "pinia";
import {useRoute} from "vue-router";
import {ref} from "vue";
import axios from "axios";
export const useHomeStore = defineStore('homeStore',()=>{
    const homeLead = ref([]);
    const leadRight = ref([]);
    const leadBottom = ref([]);
    const nationalLead = ref([]);
    const nationalSide = ref([]);
    const specialArticles = ref([]);
    const politicsLead = ref([]);
    const politicsSide = ref([]);
    const capitalLead = ref([]);
    const capitalSide = ref([]);
    const internationalLead = ref([]);
    const internationalSide = ref([]);
    const fetchHome = async ()=>{
        const {data} = await axios.get('/home');
        homeLead.value = data.homeLead;
        leadRight.value = data.leadRight;
        leadBottom.value = data.leadBottom;
        nationalLead.value = data.nationalLead;
        nationalSide.value = data.nationalSide;
        politicsLead.value = data.politicsLead;
        politicsSide.value = data.politicsSide;
        capitalLead.value = data.capitalLead;
        capitalSide.value = data.capitalSide;
        specialArticles.value = data.specialArticles;
        internationalLead.value = data.internationalLead;
        internationalSide.value = data.internationalSide;
    }
    return {homeLead,leadRight,leadBottom,nationalLead,nationalSide,specialArticles,capitalSide,internationalLead,capitalLead,internationalSide,politicsSide,politicsLead,fetchHome};
})