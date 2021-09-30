import Vue from 'vue';
import NiftyLayouts, { layoutRequire } from '@j0nz/nifty-layouts'
Vue.use(NiftyLayouts)

export const layout = new NiftyLayouts({
    currentLayout() {
        return {
            "BlogController@HomePage": "MainLayout",
            "BlogController@SingleArticle": "ArticleLayout"
        }[this.$route.name] ?? 'MainLayout' // optional fallback for unspecified routes
    },

    layouts: layoutRequire(require.context('./', true, /\.vue$/)),
})
