const { copyDirectory } = require('laravel-mix');
const mix = require('laravel-mix');

mix.js('resources/limitless/js/app.js', 'public/js')
   .sass('resources/limitless/scss/layouts/layout_2/default/compile/all.scss', 'public/css/default', {
      implementation: require('node-sass')
   })
   .sass('resources/limitless/scss/layouts/layout_2/material/compile/all.scss', 'public/css/material', {
      implementation: require('node-sass')
   })
   .sass('resources/limitless/scss/layouts/layout_2/dark/compile/all.scss', 'public/css/dark', {
      implementation: require('node-sass')
   })
   copyDirectory('resources/limitless/images', 'public/images')
   copyDirectory('resources/limitless/css/icons', 'public/icons')
   .options({
      processCssUrls: false,
   })
   .autoload({
      jquery: [
          '$', 'window.jQuery', 'jQuery', 'jquery', 'bootstrap'
      ],
    })
   .extract()
   .sourceMaps();
