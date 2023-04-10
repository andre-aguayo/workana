<template >
  <div class="card flip-card mr-3 mt-3 mb-5 ">
    <div class="flip-card-inner">
      <div class="card-body flip-card-front">
        <img :src="randomImage()" class="card-img-top">
      </div>
      <div class="card-body flip-card-back">
        <h5 class="card-title">{{ name }}</h5>
        <span class="card-text value">R$ {{ (value / 100).toFixed(2) }}</span>
        <span class="card-text"><span>{{ $t('product.label.tax') }}: </span>{{ tax }}%</span>
        <span class="card-text"><span>{{ $t('product.label.product_category') }}: </span>{{ category_name }}</span>
        <button class="btn btn-success" @click="addToCart(id, value, tax, name)">{{ $t('product.addToCart') }}</button>
      </div>
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
    addToCart(productId, value, tax, name) {
      let cart = VueCookies.get('cart');

      if (cart == null) {
        cart = [{ id: productId, quantity: 1, current_value: value, current_tax: tax, name: name }];
      } else {
        const index = cart.findIndex((product) => product.id == productId);
        if (index >= 0) {
          const quantity = cart[index].quantity + 1;
          cart[index] = { ...cart[index], quantity };
        } else {
          let newCart = { id: productId, quantity: 1, current_value: value, current_tax: tax, name: name };
          cart.push(newCart);
        }
      }

      this.$parent.$parent.$parent.cart = cart;
      VueCookies.set('cart', cart, "1h");
    }
  },
}
</script>
<style scoped>
img {
  height: 100%;
  width: 100%;
}

.card {
  border: none;
}

.card-body {
  padding: 0;
}

.card-footer {
  display: flex;
  justify-content: center;
}

.value {
  color: rgb(0, 0, 0)
}

.flip-card {
  background-color: transparent;
  width: 18rem;
  height: 10rem;
  perspective: 1000px;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front,
.flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;

  backface-visibility: hidden;
}

.flip-card-front {

  color: black;
}

.flip-card-back {
  background-color: dodgerblue;
  color: white;
  transform: rotateY(180deg);
}

.mr-3 {
  margin-right: 1rem;
}
</style>