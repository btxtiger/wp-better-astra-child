const gulp = require('gulp');
const concat = require('gulp-concat');
const cssnano = require('gulp-cssnano');
const uglify = require('gulp-uglify');

gulp.task('bundle-css', () => {
   return gulp.src('dist/astra-child-jonas/styles/*.css')
      .pipe(concat('bundle.css'))
      .pipe(cssnano())
      .pipe(gulp.dest('dist/astra-child-jonas/styles'));
});

gulp.task('default', gulp.parallel('bundle-css'));
