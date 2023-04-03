<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">{{ $route.name }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item" v-if="$route.name != $t('home.title')">
            <router-link to="/">{{ $t('navBar.home') }}</router-link>
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
