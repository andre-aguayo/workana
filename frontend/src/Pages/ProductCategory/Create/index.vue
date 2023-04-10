<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <h3>{{ $route.name }}</h3>
  <div class="form-group">
    <label for="name">{{ $t('productCategory.label.name') }}</label>
    <input type="text" class="form-control" id="name" v-model="name">
  </div>
  <div class="form-group">
    <label for="tax">{{ $t('productCategory.label.tax') }}</label>
    <input type="number" step="0.01" class="form-control" id="tax" v-model="tax">
  </div>
  <div class="form-group">
    <button class="btn btn-success" @click="create()">{{ $t('save') }}</button>
  </div>
</template>
<script>
import { createProductCategory } from '@/consumers/api/productCategory';

export default {
  data() {
    return {
      name: '',
      tax: 0,
    }
  },
  methods: {
    async create() {
      if (this.name === '') {
        return alert(this.$i18n.t('productCategory.create.errors.name'));
      }
      if (this.tax <= 0) {
        return alert(this.$i18n.t('productCategory.create.errors.tax'));
      }

      const product = {
        name: this.name,
        tax: parseInt((this.tax * 10)),
      }

      const response = await createProductCategory(product, async (data) => {
        return await data.data;
      });
      console.log(response);
      if (response.success) {
        return alert(this.$i18n.t('productCategory.create.success'));
      } else {
        return alert(this.$i18n.t('productCategory.create.errors.success'));
      }
    }
  },
}
</script>