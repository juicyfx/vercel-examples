const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const Mix = require("laravel-mix/src/Mix");
require("@phased/phase");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .options({
    processCssUrls: false,
    postCss: [tailwindcss("./tailwind.config.js")],
  })
  .webpackConfig(() => ({
    resolve: {
      alias: { "@": path.resolve(__dirname, "resources", "js") },
    },
  }))
  .phase();

if (!mix.inProduction()) {
  mix.sourceMaps();
}
