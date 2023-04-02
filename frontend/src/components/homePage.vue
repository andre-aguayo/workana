<template>
    <navBar />
    <div class="hello">
        <h1>{{ $t('home.title') }}</h1>
        <router-link to="/noo">noooo</router-link>
    </div>
</template>
<script>
import navBar from './navBar.vue';
export default {
    components: { navBar }
}
</script>