const gulp = require('gulp');
const gulpUtil = require('gulp-util');
const webpack = require('webpack');
const pump = require('pump');
const sass = require('gulp-sass');
const webpackConfig = require('./javascript/config/webpack.config');
const autoprefixer = require('gulp-autoprefixer');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

gulp.task('default', ['webpack']);

gulp.task('watch', ['webpack:watch', 'sass:watch'], cb => {
    gulp.watch('javascript/app/*.js', ['webpack:watch']);
gulp.watch('scss/**/*.scss', ['sass:watch']);
});

gulp.task('build', ['webpack:build', 'sass:build']);

gulp.task('sass:watch', cb => {
    return doSass(cb, false);
});

gulp.task('sass:build', cb => {
    return doSass(cb, true);
});

gulp.task('webpack:watch', cb => {
    return doPack(cb, false);
});

gulp.task('webpack:build', cb => {
    return doPack(cb, true);
});

/**
 * Combine the JS
 * If build mode is on, uglify the JS
 *
 * @param cb
 * @param build
 */
const doPack = (cb, build) => {
    gulpUtil.log((build ? 'build' : 'pack'), 'js');
    const config = Object.create(webpackConfig);
    if (build) {
        config.plugins = [
            new UglifyJSPlugin()
        ];
    }

    webpack(config, function (err, stats) {
        if (err) throw new gulpUtil.PluginError('webpack', err);
        gulpUtil.log('[webpack]', stats.toString({
            colors: true,
            progress: true
        }));
        cb();
    });
}

/**
 * Compile the sass
 * If build mode is on, minify the output
 *
 * @param cb
 */
const doSass = (cb, build) => {
    gulpUtil.log((build ? 'build' : 'update'), 'scss');
    const config = {};
    if (build) {
        config.outputStyle = 'compressed';
    }

    pump([
        gulp.src('scss/**/*.scss'),
        sass(config).on('error', sass.logError),
        autoprefixer({browsers: ['last 2 versions']}),
        gulp.dest('css'),
    ], cb);
}