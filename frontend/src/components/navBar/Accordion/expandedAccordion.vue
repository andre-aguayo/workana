<template >
  <div class="container">
    <ul>
      <li class="mb-4 ">
        <div>
          <span class="text-left name-title">{{ $t('cart.title.name') }}</span>
          <span class="ml-3 text-right money-title">{{ $t('cart.title.value') }}</span>
        </div>
      </li>
      <li v-for="product in products" :key="product">
        <div>
          <span class="text-left name">{{ product.name }}</span>
          <span class="ml-3 text-right money">
            {{ $t('moneyUnity') }}{{ (product.current_value / 100).toFixed(2) }}</span>
        </div>
        <div class="row justify-content-end">
          <button class="w-2 btn btn-danger" @click="remove(product.id)"> - </button>
          <span class="w-2 col-sm-2 text-center align-self-center quantity">{{ product.quantity }}</span>
          <button class="w-2 btn btn-success" @click="add(product.id)"> + </button>
        </div>
      </li>
    </ul>
  </div>
</template>
<script>
import VueCookies from 'vue-cookies'

export default {
  data() { return { products: this.cart } },
  props: ['cart'],
  methods: {
    remove(productId) {
      const index = this.cart.findIndex((product) => product.id == productId);

      let products = VueCookies.get('cart');
      if ((products[index].quantity) == 1) {
        products.splice(index, 1);
        this.products = products;
      }
      else if (products[index].quantity > 1) {
        this.products[index] = {
          ...products[index], quantity: (products[index].quantity - 1)
        };
      }
      else
        return false;

      this.$parent.$parent.cart = this.products;
      VueCookies.set('cart', this.products, "1h");
    },
    add(productId) {
      let products = VueCookies.get('cart');
      const index = products.findIndex((product) => product.id == productId);

      products[index] = {
        ...products[index], quantity: (products[index].quantity + 1)
      };

      this.products = this.$parent.$parent.cart = products;
      VueCookies.set('cart', products, "1h");
    }
  },
  watch: {
    cart: function () {
      this.products = this.cart;
    },
  },
}
</script>
<style scoped>
.container {
  margin-top: 45px;
}

ul {
  list-style-type: none;
}

.name {
  font-size: 18px;
  margin-right: 3.2rem;
}

.name-title {
  font-size: 20px;
  font-weight: bold;
}

.money-title {
  font-size: 20px;
  font-weight: bold;
}

.w-2 {
  width: 2rem;
}

.ml-3 {
  margin-left: 3rem;
}
</style>
  