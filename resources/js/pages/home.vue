<template>

  <view-map></view-map>

</template>

<script>
import ViewMap from "../components/builders/views/ViewMap";
export default {
  components: {ViewMap},
  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
