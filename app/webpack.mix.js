const mix = require('laravel-mix');
require('laravel-mix-polyfill');
require('laravel-mix-critical');

mix
  // .webpackConfig({
  //   resolve: {
  //     modules: [
  //       path.resolve(__dirname, 'node_modules')
  //     ]
  //   }
  // })
  .setResourceRoot('/app/')
  .js('client/src/js/app.js', 'client/dist/js')
    .postCss("client/src/styles/app.css", "client/dist/styles", [
        require("tailwindcss"),
    ])
  // .sass('client/src/styles/app.scss', 'client/dist/styles')
  // .sass('client/src/styles/cms.scss', 'client/dist/styles')
  // .sass('client/src/styles/editor.scss', 'client/dist/styles')
  // .sourceMaps()
  .polyfill({
    enabled: mix.inProduction(),
    useBuiltIns: "usage",
    targets: {"ie": 11}
  });
  // .critical({
  //   enabled: mix.inProduction(),
  //   urls: [
  //     {
  //       src: 'http://mysite.test/',
  //       dest: 'client/dist/styles/app_critical.css'
  //     }
  //   ],
  //   options: {
  //     minify: true,
  //   },
  // });

