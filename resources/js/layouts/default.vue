<template>
  <div class="main-layout">
    <Navigation>
      <div class="media-body align-self-center">

        <span class="app-max-text">Bracker</span>

      </div>
      <div class="media-right align-self-center pr-3">
        
       <router-link :to="{ name : 'notification' }">
          <Icon :icon="'notification'" :height="24" :width="24"></Icon>
       </router-link>

      </div>
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
import Navigation from "../components/Navigation";

export default {
  name: 'MainLayout',

  components: {
    Navigation
  }
};
</script>

<style type="text/css" scoped>
  
  .navbar{
    height: 50px;
    box-shadow: .5px .5px .5px rgba(211, 211, 211, .125);
  }

  .main-layout{
    background-color: #fff;
  }

</style>
