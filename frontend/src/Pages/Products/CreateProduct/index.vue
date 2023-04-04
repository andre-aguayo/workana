<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <h3>{{ $route.name }}</h3>
  <div class="form-group">
    <label for="exampleFormControlInput1">{{ $t('product.label.name') }}</label>
    <input type="text" class="form-control" id="name" v-model="name">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">{{ $t('product.label.value') }}</label>
    <input type="number" step="0.01" class="form-control" id="value" v-model="value">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">{{ $t('product.label.stock') }}</label>
    <input type="number" class="form-control" id="stock" v-model="stock">
  </div>
  <div class="form-group" v-if="this.productCategories.length > 0">
    <label for="category">{{ $t('product.label.product_category') }}</label>
    <select class="form-control" id="product_category" v-model="category_id">
      <option v-for="productCategory in this.productCategories" :key="productCategory" :value="productCategory.id">{{
        productCategory.name }}</option>
    </select>
  </div>
  <div class="form-group">
    <button class="btn btn-success" @click="create()">{{ $t('save') }}</button>
  </div>
</template>
<script>
import { listProductCategory } from '@/consumers/api/productCategory';
import { createProduct } from '@/consumers/api/product';

export default {
  data() {
    return {
      productCategories: [],
      name: '',
      value: 0,
      stock: 0,
      category_id: 0,
    }
  },
  methods: {
    async build() {
      this.productCategories = await listProductCategory(async (data) => {
        return await data.data;
      });
      return;
    },
    async create() {
      if (this.name === '') {
        return alert(this.$i18n.t('product.create.errors.name'));
      }
      if (this.product_category_id <= 0) {
        return alert(this.$i18n.t('product.create.errors.product_category_id'));
      }
      if (this.value <= 0) {
        return alert(this.$i18n.t('product.create.errors.value'));
      }
      if (this.stock <= 0) {
        return alert(this.$i18n.t('product.create.errors.quantity'));
      }

      const product = {
        name: this.name,
        value: parseInt((this.value * 10)),
        stock: this.stock,
        category_id: this.category_id
      }

      const response = await createProduct(product, async (data) => {
        console.log(data);
        return await data.data;
      });
      if (response.success) {
        return alert(this.$i18n.t('product.create.success'));
      } else {
        return alert(this.$i18n.t('product.create.errors.success'));
      }
    }
  },
  async mounted() {
    return await this.build();
  },
}
</script>