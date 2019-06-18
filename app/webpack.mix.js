const mix = require('laravel-mix');

mix.js('client/src/js/app.js', 'client/dist/js')
  .sass('client/src/styles/app.scss', 'client/dist/styles')
  .sass('client/src/styles/cms.scss', 'client/dist/styles')
  .sass('client/src/styles/editor.scss', 'client/dist/styles');