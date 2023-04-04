<template>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/">{{ $t('navBar.home') }}</router-link>
      <router-link class="nav-link" :to="$t('navBar.product.path')">{{ $t('navBar.product.name') }}</router-link>
      <router-link class="nav-link" :to="$t('navBar.productCategory.path')">{{ $t('navBar.productCategory.name')
      }}</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item" v-if="$route.name != $t('home.title')">

          </li>
        </ul>
        <form class="d-flex">

        </form>
      </div>
    </div>
  </nav>
</template>
<style scoped>
.nav-link {
  color: white;
  margin-left: 1rem;
}
</style>