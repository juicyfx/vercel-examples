import Vue from 'vue'

// Vue Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Phase Routes
import PhaseRoutes from '@phased/phase/routes'

// Export our configured router
export const router = new VueRouter({
    mode: 'history',
    routes: PhaseRoutes,
    scrollBehavior(to, from, savedPosition) {
        return savedPosition ?? { x: 0, y: 0 }
    }
});
