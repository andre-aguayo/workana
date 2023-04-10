<template >
  <nav class="navbar navbar-expand-md navbar-dark fixed-bottom bg-dark" v-if="products.length > 0"
    :style="'bottom:' + distance + '%'">
    <button class=" btn-contracting" @click="show = !show; distance = 0">
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-arrow-down"
        viewBox="0 0 16 16">
        <path fill-rule="evenodd"
          d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
      </svg>
    </button>
    <transition name="btn-expanded">
      <button class="btn-expanding" @click="show = !show; distance = 50" v-if="show">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-arrow-up"
          viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
        </svg>
      </button>
    </transition>
    <div class="prev-informations">
      <div class="container-fluid">
        <span class="title">
          {{ $t('navBar.bottomNavBar.total') }} {{ $t('moneyUnity') }} {{ total }}
        </span>
        <span class="quantity">{{ quantity }} {{ $t('navBar.bottomNavBar.quantity') }}</span>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <button class="btn btn-success" @click="buy(this)">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4"
          viewBox="0 0 16 16">
          <path
            d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
        </svg></button>
    </div>
  </nav>
  <div class="expanded-informations" v-if="!show && products.length > 0">
    <expandedAccordion :cart="products" />
  </div>
</template>
<script>
import expandedAccordion from './Accordion/expandedAccordion.vue';
import VueCookies from 'vue-cookies';
import { buyProducts } from '@/consumers/api/buy';

export default {
  data() { return { products: [], total: 0, total_tax: 0, quantity: 0, show: true, distance: 0 } },
  props: ['cart'],
  components: { expandedAccordion },
  mounted() {
    this.products = VueCookies.get('cart');

    this.checkProductsChange(this);
  },
  watch: {
    cart: function () {
      this.products = this.cart;
      this.total = this.total_tax = this.quantity = 0;
      this.checkProductsChange(this);
    },
  },
  methods: {
    checkProductsChange: (vm) => {
      if (vm.products) {
        vm.products.forEach(async (product) => {
          vm.total = (parseFloat(vm.total) + (product.current_value / 100) * product.quantity * (product.current_tax / 100)).toFixed(2);
          vm.total_tax = parseInt(product.current_tax * product.quantity) + parseInt(vm.total_tax);
          vm.quantity += product.quantity;
          console.log(product.current_tax, vm.total_tax);
        });
      }
    },
    buy: async (vm) => {
      let sale = {};
      sale.total_value = (vm.total * 100).toFixed(0);
      sale.total_tax = vm.total_tax;
      sale.product_sales = vm.products;

      let response = await buyProducts(sale, async (data) => {
        return await data;
      });

      if (response.success) {
        alert('Compra realizada com sucesso.');
        vm.cart = vm.products = [];
        VueCookies.set('cart', null, "1h");
      }
    }
  }
}
</script>
<style scoped>
nav {
  color: white;
  box-shadow: 0px 5px 10px 0px rgba(0, 57, 92, 0.841);
  padding-left: 15px;
  padding-right: 25px;
}

.prev-informations {
  display: contents;
}

.expanded-informations {
  position: fixed;
  bottom: 0;
  height: 50%;
  width: 100%;
  background-color: #2f2e3e;
  color: #cbd8d9;
}

.title {
  font-size: 1.2rem;
}

.quantity {
  position: absolute;
  font-size: 1rem;
  right: 8rem;
}

.btn-expanded-enter-active,
.btn-expanded-leave-active {
  transition: all 0.8s ease;
}

.btn-expanded-leave-to {
  transform: translateX(-15px);
  transform: translateY(-150px);
  opacity: 0;
}

.btn-expanded-enter-from {
  transform: translateX(-15px);
  transform: translateY(150px);
  opacity: 0;
}

.btn-expanding {
  position: absolute;
  top: -44px;
  left: 15px;
  border: 8px solid rgba(var(--bs-dark-rgb), var(--bs-bg-opacity));
  background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;
  border-radius: 12px 12px 0 0;
}

.btn-expanding:hover {
  border-radius: 12px;
  animation-name: expanding;
  animation-duration: 6s;
}

.btn-contracting {
  position: absolute;
  top: -44px;
  left: 15px;
  border: 8px solid rgba(var(--bs-dark-rgb), var(--bs-bg-opacity));
  background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;
  border-radius: 12px 12px 0 0;
}

.btn-contracting:hover {
  border-radius: 12px;
  animation-name: contracting;
  animation-duration: 6s;
}

@keyframes top-animate {
  0% {
    transform: scaleY(50%);
  }

  100% {
    transform: scaleY(0);
  }
}

@keyframes bottom-animate {
  0% {
    transform: scaleY(50%);
  }

  100% {
    transform: scaleY(0);
  }
}

@keyframes expanding {
  0% {
    top: -44px;
  }

  25% {
    top: -55px;
  }

  50% {
    top: -44px;
  }

  75% {
    top: -55px;
  }

  100% {
    top: -44px;
  }
}

@keyframes contracting {
  0% {
    top: -44px;
  }

  25% {
    top: -33px;
  }

  50% {
    top: -44px;
  }

  75% {
    top: -33px;
  }

  100% {
    top: -44px;
  }
}
</style>
