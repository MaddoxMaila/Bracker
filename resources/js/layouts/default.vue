<template>
  <div class="main-layout">
    <Navigation>
      <div class="media-body">

      </div>
      <div class="media-right"></div>
    </Navigation>

    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <child />
      </div>
      <div class="col-lg-2"></div>
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import Navigation from "../components/Navigation";

export default {
  name: 'MainLayout',

  components: {
    Navigation,
    Navbar
  }
}
</script>
