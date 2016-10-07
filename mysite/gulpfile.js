const gulp = require('gulp');
const gutil = require('gulp-util');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const pump = require('pump');
const babel = require('gulp-babel');
const bundle = require('./javascript/bundle.js');

gulp.task('default', function(cb) {
    return doBuild(cb);
});

gulp.task('watch', function(cb) {
    gulp.watch('javascript/app.js', ['default']);
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