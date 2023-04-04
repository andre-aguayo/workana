<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <div class="card">
    <div class="card-header">
      <h3>{{ $t('home.title') }}</h3>
    </div>
    <div class="row" v-if="this.productCategories.length > 0">
      <div class="col-md-3" v-for="productCategory in this.productCategories" :key="productCategory">
        <div v-for="product in productCategory.products" :key="product">
          <productsCard :name="product.name" :value="product.value" :tax="productCategory.tax" :id="product.id"
            :category_name="productCategory.name" />
        </div>
      </div>
    </div>  
  </div>
</template>
<script>
import { productCategoriesWithProducts } from '@/consumers/api/homePage';
import productsCard from '@/components/ProductsCard/productsCard.vue';

export default {
  data() {
    return {
      productCategories: [],
    };
  },
  methods: {
    async build() {
      this.productCategories = await productCategoriesWithProducts(async (data) => {
        return await data.data;
      });
      return;
    },
  },
  async mounted() {
    return await this.build();
  },
  components: { productsCard },
}
</script>