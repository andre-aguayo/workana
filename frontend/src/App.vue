<template>
  <topNavBar />
  <main role="main" class="container">
    <router-view />
  </main>
</template>
<script>
import topNavBar from "./components/navBar/topNavBar.vue";

export default {
  components: { topNavBar },
};
</script>
<style scoped>
main {
  margin-top: 90px;
}
</style>