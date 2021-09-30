import Vue from 'vue';
import Vuex, { Store } from 'vuex'
import { hydrate } from '@phased/state'
Vue.use(Vuex)

import articles from './modules/articles';

/**
 * Here we will 'hydrate' the vuex store. This does a few things
 * to help everything get ready. First it loads all data provided
 * by the controller on page load. Second, it registers the vuex
 * plugins that will handle retrieving the data from the controller
 * and updating the vuex state on page changes.
 */
export const store = new Store(hydrate({
    state: {
        bio: null,
        contact: null,
        author: 'John Doe'
    },
    modules: {
        articles
    }
}))
