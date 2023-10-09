let fs = require('fs');
const mix = require('laravel-mix');
require('laravel-mix-polyfill');
require('laravel-mix-critical');

mix
  .setResourceRoot('/app/')
  .polyfill({
    enabled: mix.inProduction(),
    useBuiltIns: "usage",
    targets: {"ie": 11}
  });

let getFiles = function (dir) {
  let files = [];
  fs.readdirSync(dir).forEach(file => {
    let filePath = `${dir}/${file}`;
    let fileInfo = fs.statSync(filePath);
    
    if (fileInfo.isDirectory()) {
      files = files.concat(getFiles(filePath));
    }

    if (fileInfo.isFile() && file[0] !== '_') {
      files.push({
        src: filePath,
        dist: dir.replace('src', 'dist')
      });
    }
  });

  return files;
};

getFiles('client/src/js').forEach(function (entry) {
  const {src, dist} = entry;
  mix.js(src, dist);
});

getFiles('client/src/styles').forEach(function (entry) {
  const {src, dist} = entry;
  mix.sass(src, dist);
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

