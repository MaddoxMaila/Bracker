<template>
  <div class="navbar fixed-top bg-white">
  	
  	<div class="media">
	    <div class="media-left">

	    </div>

	    <slot />

	  </div>

  </div>
</template>

<script>
    export default {
        name: "Navigation"
    };
</script>

<style scoped>

	.media{
		width: 100%;
	}

</style>
