const gulp = require('gulp');
const gutil = require('gulp-util');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const pump = require('pump');
const babel = require('gulp-babel');
const bundle = require('./javascript/bundle.js');
var sass = require('gulp-sass');

gulp.task('default', function(cb) {
    return doBuild(cb);
});

gulp.task('quickBuild', function (cb) {
    return doWatch(cb);
});

gulp.task('sass', function (cb) {
    return doSass(cb);
});

gulp.task('watch', ['quickBuild','sass'], function(cb) {
    gulp.watch('javascript/*.js', ['quickBuild']);
    gulp.watch('scss/**/*.scss', ['sass']);
});

function doBuild(cb) {
    gutil.log('compiling scripts');
    pump([
        gulp.src(bundle.BUNDLE),
        babel({
            presets: ['es2015']
        }),
        concat('bundle.js'),
        uglify(),
        gulp.dest('javascript/dist')
    ], cb);
}

function doWatch(cb) {
    gutil.log('update scripts');
    pump([
        gulp.src(bundle.BUNDLE),
        babel({
            presets: ['es2015']
        }),
        concat('bundle.js'),
        gulp.dest('javascript/dist')
    ], cb);
}

function doSass(cb) {
    gutil.log('update scss');
    return gulp.src('./scss/**/*.scss')
            .pipe(sass().on('error', sass.logError))
            .pipe(gulp.dest('./css'));
}
