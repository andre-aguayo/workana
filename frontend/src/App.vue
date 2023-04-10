<template>
  <topNavBar />
  <main role="main" class="container">
    <router-view />
  </main>
  <bottomNavBar :cart="cart" />
</template>
<script>
import topNavBar from "./components/navBar/topNavBar.vue";
import bottomNavBar from "./components/navBar/bottomNavBar.vue";

export default {
  name: 'App',
  data() { return { cart: [] } },
  components: { topNavBar, bottomNavBar },
};
</script>
<style scoped>
main {
  margin-top: 90px;
}
</style>