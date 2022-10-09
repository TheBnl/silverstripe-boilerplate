const mix = require('laravel-mix');
require('laravel-mix-polyfill');
require('laravel-mix-critical');

mix.webpackConfig({
  stats: {
      children: true,
  },
});

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

  // .purgeCss({
  //   content: [
  //     "app/**/*.php",
  //     "**/*.vue",
  //     "**/*.ss",
  //   ],
  //   safelist: {
  //     standard: [/-is-stuck$/, /-is-active$/, /input$/, /--active$/, /--left$/, /--right$/],
  //     deep: [/textarea$/, /button$/, /type$/, /faq$/, /faq-category$/, /faq-question$/, /callout$/, /order-content$/, /swiper-pagination-bullet$/, /lead$/, /blockquote$/, /mgl-map-wrapper$/, /sidebar-panel$/, /slide/, /event-summary$/]
  //   },
  // });

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

