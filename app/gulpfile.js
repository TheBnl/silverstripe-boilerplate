const gulp = require('gulp');
const pump = require('pump');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');

gulp.task('default', ['build']);

gulp.task('watch', ['sass:watch'], cb => {
    gulp.watch('scss/**/*.scss', ['sass:watch']);
});

gulp.task('build', cb => {
  return doSass(cb, true);
});

gulp.task('sass:watch', cb => {
    return doSass(cb, false);
});

const doSass = (cb, build) => {
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
};