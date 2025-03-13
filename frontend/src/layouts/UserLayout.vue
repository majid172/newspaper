<script setup>
import Navbar from "@/components/layouts/Navbar.vue";
import Brand from "@/components/layouts/Brand.vue";
import TopBar from "@/components/layouts/TopBar.vue";
import Footer from "@/components/layouts/Footer.vue";
</script>
<template>
  <TopBar />
  <Brand />
  <Navbar />
  <RouterView />
  <Footer/>
</template>