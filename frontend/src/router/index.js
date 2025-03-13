import { createRouter, createWebHistory } from 'vue-router'

// Import Layouts
import UserLayout from '@/layouts/UserLayout.vue'
import AdminLayout from '@/layouts/AdminLayout.vue'

// Import Views
import HomeView from '@/views/HomeView.vue'
import LatestView from '@/views/LatestView.vue'
import NationalView from '@/views/NationalView.vue'
import SingleNewsView from '@/views/SingleNewsView.vue'
import AdminDashboardView from '@/views/Admin/AdminDashboardView.vue'
import LoginView from "@/views/Admin/Auth/LoginView.vue";
import ArticleView from "@/views/Admin/ArticleView.vue";
import CategoryView from "@/views/Admin/CategoryView.vue";
import AddCategoryView from "@/views/Admin/AddCategoryView.vue";

// Define Routes
const routes = [
  {
    path: '/',
    component: UserLayout,
    children: [
      { path: '', name: 'home', component: HomeView },
      { path: 'latest', name: 'latest', component: LatestView },
      { path: 'national', name: 'national', component: NationalView },
      { path: 'news/:id', name: 'news', component: SingleNewsView },

      // Use Dynamic Route for Multiple Categories
      { path: ':category', name: 'category', component: NationalView },
    ],
  },
  {
    path: '/admin',
    component: AdminLayout,
    children: [
      { path: '', name: 'admin', component: LoginView },
      { path: '/dashboard', name: 'adminDashboard', component: AdminDashboardView },
      { path: '/article-list', name: 'articleList', component: ArticleView },
      { path: '/categories', name: 'categoryList', component: CategoryView },
      { path: '/create/categories', name: 'createCategory', component: AddCategoryView },
    ],
  },
]

// Create Router
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

export default router
