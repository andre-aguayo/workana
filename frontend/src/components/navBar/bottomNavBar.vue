<template >
  <nav class="navbar navbar-expand-md navbar-dark fixed-bottom bg-dark" v-if="cart != null">
    <div class="container-fluid">
      <h3 style="color:white">
        Valor Total do carrinh: {{ total }} R$
      </h3>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">

          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" :placeholder="$t('navBar.search')"
            :aria-label="$t('navBar.search')">
          <button class="btn btn-outline-success" type="submit">{{ $t('navBar.search') }}</button>
        </form>
      </div>
    </div>
  </nav>
</template>
<script>
import VueCookies from 'vue-cookies'

export default {
  data() { return { cart: null, total: 0, quantity: 0 } },
  mounted() {
    this.cart = VueCookies.get('cart');
    if (this.cart) {
      console.log(VueCookies.get('cart'));
      this.cart.forEach((value) => {
        this.total += parseInt(value.value) * parseInt(value.quantity) * parseFloat(parseInt(value.tax) / 100);
        this.quantity += value.quantity;
      })
    }
  }
}
</script>
