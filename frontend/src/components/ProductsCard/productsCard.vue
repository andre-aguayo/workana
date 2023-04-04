<template >
  <div class="card" style="width: 18rem;">
    <img :src="randomImage()" class="card-img-top">
    <div class="card-body">
      <h5 class="card-title">{{ name }}</h5>
      <p class="card-text value">R$ {{ (value / 100).toFixed(2) }}</p>
      <p class="card-text"><span>{{ $t('product.label.tax') }}: </span>{{ tax }}%</p>
      <p class="card-text"><span>{{ $t('product.label.product_category') }}: </span>{{ category_name }}</p>
    </div>
    <div class="card-footer">
      <button class="btn btn-success" @click="addToCart(id, value, tax)">{{ $t('product.addToCart') }}</button>
    </div>
  </div>
</template>
<script>
import VueCookies from 'vue-cookies'

export default {
  data() {
    return {
      imageUrl: [
        "https://media.istockphoto.com/id/1316134499/photo/a-concept-image-of-a-magnifying-glass-on-blue-background-with-a-word-example-zoom-inside-the.jpg?b=1&s=170667a&w=0&k=20&c=e-i4hdu7dT3PIuf4xQMglnnORiwBAC_ZUgXw6aorB1M=",
        "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrXoCdQBsKpWG_I0LQ_FBbc7k6jbMfmnkRWkp0Lmu3pbUVB0bvHo3j-5iu4d2lm4rXhEI&usqp=CAU",
        "https://en.pimg.jp/047/508/933/1/47508933.jpg",
        "https://www.shutterstock.com/image-photo/example-word-made-building-blocks-260nw-541261735.jpg"
      ]
    };
  },
  props: ["name", "id", "category_name", "value", "tax"],
  methods: {
    randomImage() {
      let randindex = Math.floor(0 + Math.random() * (this.imageUrl.length - 1));
      return this.imageUrl[randindex];
    },
    addToCart(productId, value, tax) {
      let cart = VueCookies.get('cart');

      if (cart == null) {
        cart = [{ id: productId, quantity: 1, current_value: value, current_tax: tax }];
      } else {
        const index = cart.findIndex((product) => product.id == productId);
        if (index >= 0) {
          const quantity = cart[index].quantity + 1;
          cart[index] = { ...cart[index], quantity };
        } else {
          let newCart = { id: productId, quantity: 1, current_value: value, current_tax: tax };
          cart.push(newCart);
        }
      }
      VueCookies.set('cart', cart, "1h");
    }
  },
}
</script>
<style scoped>
img {
  height: 12rem;
  width: 18rem;
}

.card-footer {
  display: flex;
  justify-content: center;
}

.value {
  color: rgb(0, 0, 0)
}
</style>