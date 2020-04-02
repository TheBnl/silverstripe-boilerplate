const mix = require('laravel-mix');
require('laravel-mix-polyfill');

mix
  .setResourceRoot('/app/')
  .js('client/src/js/app.js', 'client/dist/js')
  .sass('client/src/styles/app.scss', 'client/dist/styles')
  .sass('client/src/styles/cms.scss', 'client/dist/styles')
  .sass('client/src/styles/editor.scss', 'client/dist/styles')
  // .sourceMaps()
  .polyfill({
    enabled: mix.inProduction(),
    useBuiltIns: "usage",
    targets: {"ie": 11}
  });