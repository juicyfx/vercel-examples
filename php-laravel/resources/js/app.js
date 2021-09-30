/**
 * Here we will load any bootstrapping code
 * required by the rest of the app
 */
import './bootstrap'

/**
 * Here we will import the base parts of the app
 * required for everything to operate properly
 */
import Vue from "vue";

/**
 * This is our phase-enhanced vuex store.
 */
import { store } from "./store";

/**
 * Here is our Vue Router. This is a standard vue router,
 * with a phase provided 'routes' configuration
 */
import { router } from "./router";

/**
 * Here is our NiftyLayouts config.
 */
import { layout } from './layouts'

/**
 * Instead of mounting the app directly, we will export it now.
 * This allows phase to control enabling/disabling server side
 * rendering
 */
export default new Vue({
  store,
  router,
  layout,
  functional: true,
  render: h => h('NiftyLayout', {
    attrs: {
      id: 'app',
      layoutTransitionName: "layout-transition",
      layoutTransitionMode:"out-in",
      routeTransitionName:"route-transition",
      routeTransitionMode:"out-in"
    }
  }),
});
