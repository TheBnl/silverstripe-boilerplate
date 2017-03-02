const gulp = require('gulp');
const gutil = require('gulp-util');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const pump = require('pump');
const babel = require('gulp-babel');
const bundle = require('./javascript/bundle.js');
const sass = require('gulp-sass');
const browserSync = require('browser-sync').create();
const es2015 = require('babel-preset-es2015');

const config = {
    browserSyncProxy: 'kobus.local',
    jsDistFolder: 'javascript/dist',
    jsDistFile: 'bundle.js'
};

const paths = {
    js: 'javascript/**/*.js',
    jsDist: 'javascript/dist',
    sass: 'scss/**/*.scss',
    css: 'css',
    ss: 'templates/**/*.ss',
};

// default task falls back to watch
gulp.task('default', ['watch']);

// set up browser sync and watch for changes
gulp.task('serve', ['setupSync', 'watch']);

// compile and minify a distribution
gulp.task('build', ['scripts', 'sass']);

// watch fot changes and if browser sync is enabled reload/stream
gulp.task('watch', ['scripts:quick', 'sass'], cb => {
    gulp.watch(paths.js, ['scripts:quick']);
    gulp.watch(paths.sass, ['sass']);
    gulp.watch(paths.ss).on('change', browserSync.reload);
});


gulp.task('scripts:quick', cb => {
    return doScripts(cb, true);
});


gulp.task('scripts', cb => {
    return doScripts(cb, false);
});


gulp.task('sass', cb => {
    return doSass(cb);
});


gulp.task('setupSync', cb => {
    browserSync.init({
        proxy: config.browserSyncProxy
    });
});


function doScripts(cb, quick) {
    gutil.log('update js', quick ? 'fast' : '');
    var buildPipes = [];
    buildPipes.push(gulp.src(bundle.BUNDLE));
    buildPipes.push(babel({
        presets: [es2015]
    }));
    buildPipes.push(concat(config.jsDistFile));

    // if were doing a quick build skip uglify
    if (!quick) buildPipes.push(uglify());

    buildPipes.push(gulp.dest(config.jsDistFolder));
    buildPipes.push(browserSync.stream());
    pump(buildPipes, cb);
}


function doSass(cb) {
    gutil.log('update scss');
    pump([
        gulp.src(paths.sass),
        sass().on('error', sass.logError),
        gulp.dest(paths.css),
        browserSync.stream()
    ], cb);
}
