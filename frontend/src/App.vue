<template>
  <section>
    <topNavBar />
    <router-view />
  </section>
</template>
<script>
import topNavBar from "./components/navBar/topNavBar.vue";
export default {
  components: { topNavBar },
};
</script>