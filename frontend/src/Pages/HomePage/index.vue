<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <div class="hello">
    <h1>{{ $t('home.title') }}</h1>
    <router-link to="/noo">noooo</router-link>
  </div>
</template>
<script>
import { productCategoriesWithProducts } from '@/consumers/api/homePage';

export default {
  data() {
    return {
      productCategories: [],
      products: [],
      product: {},
    };
  },
  methods: {
    async build() {
      console.log(await productCategoriesWithProducts((data) => {
        return data;
      }));
    },
  },
  async mounted() {
    return await this.build();
  },
  components: {},
}
</script>