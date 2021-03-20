import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'

/*import VueGoogleMap from 'vuejs-google-maps'
import 'vuejs-google-maps/dist/vuejs-google-maps.css'

Vue.use(VueGoogleMap, {
    load: {
        apiKey: 'AIzaSyBDiwgyOB93hfiIKMUflHfYP3nBfuDirio',
        libraries: []
    }
})*/

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
