const gulp = require('gulp');
const concat = require('gulp-concat');
const cssnano = require('gulp-cssnano');
const uglify = require('gulp-uglify');

gulp.task('bundle-css', () => {
   return gulp.src('dist/wp-better-astra-child/styles/**/*.css')
      .pipe(concat('bundle.css'))
      .pipe(cssnano())
      .pipe(gulp.dest('dist/wp-better-astra-child/styles'));
});

gulp.task('default', gulp.parallel('bundle-css'));
