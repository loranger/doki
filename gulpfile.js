var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var uglifyjs = require('gulp-uglify');
var concat = require('gulp-concat');
var order = require('gulp-order');
var autoprefixer = require('gulp-autoprefixer');
var imagemin = require('gulp-imagemin');
var pngcrush = require('imagemin-pngcrush');
var rimraf = require('gulp-rimraf');

var config = {
    env: 'prod',
    imagemin: {
        options: {
            optimizationLevel: 7,
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngcrush()]
        }
    }
}

gulp.task('css', function () {
    if (config.env == 'dev') {
        return gulp.src('app/assets/css/*.css')
            .pipe(autoprefixer('last 15 version', 'ie 8'))
            .pipe(gulp.dest('public/css/'));
    } else {
        return gulp.src('app/assets/css/*.css')
            .pipe(autoprefixer('last 15 version', 'ie 8'))
            .pipe(minifycss())
            .pipe(gulp.dest('public/css/'));
    }
});

gulp.task('scripts', function () {
    if (config.env == 'dev') {
        return gulp.src('app/assets/js/**/*.js')
            .pipe(gulp.dest('public/js/'));
    } else {
        return gulp.src('app/assets/js/**/*.js')
            .pipe(uglifyjs())
            .pipe(gulp.dest('public/js/'));
    }
});

//CSS Compilation
gulp.task('plugins_css', function () {

    return gulp.src(['app/assets/plugins/**/*.css'])
        .pipe(minifycss())
        .pipe(concat('plugins.css'))
        .pipe(gulp.dest('public/css'));
});

//JS Compilation
gulp.task('plugins_scripts', function () {
    return gulp.src(['app/assets/plugins/**/*.js'])
        .pipe(uglifyjs())
        .pipe(concat('plugins.js'))
        .pipe(gulp.dest('public/js'));
});

gulp.task('fonts', function(){
    return gulp.src(['app/assets/fonts/**/*'])
        .pipe(gulp.dest('public/fonts/'))
});

gulp.task('images', function(){
    return gulp.src('app/assets/images/**/*.{png,jpg,jpeg,gif}')
        .pipe(imagemin(config.imagemin.options))
        .pipe(gulp.dest('public/img/'))
});

gulp.task('clean', function(){
    return gulp.src(['public/css/*', 'public/fonts/*', 'public/img/*', 'public/js/*'], {read: false})
        .pipe(rimraf());
});

gulp.task('dev', function () {
    config.env = 'dev';
    gulp.watch(['app/assets/js/**/*.js'], ['plugins_scripts','scripts']);
    gulp.watch(['app/assets/css/**/*.css'], ['plugins_css','css']);
    gulp.watch(['app/assets/fonts/**/*'], ['fonts']);
    gulp.watch(['app/assets/images/**/*'], ['images']);
});

gulp.task('prod', ['clean', 'plugins_css', 'plugins_scripts', 'css', 'scripts', 'fonts', 'images']);

gulp.task('default', ['prod']);