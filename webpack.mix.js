const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'public/admin/asset/bootstrap/dist/css/bootstrap.min.css',
    'public/admin/asset/nprogress/nprogress.css',
    'public/admin/asset/iCheck/skins/flat/green.css',
    'public/admin/asset/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
    'public/admin/css/custom.min.css',
    'public/admin/css/mycss.css'], 'public/admin/css/all-css.css');

mix.styles([
    'public/news/css/bootstrap-4.1.2/bootstrap.min.css',
    'public/news/js/OwlCarousel2-2.2.1/owl.carousel.css',
    'public/news/js/OwlCarousel2-2.2.1/owl.theme.default.css',
    'public/news/js/OwlCarousel2-2.2.1/animate.css',
    'public/news/css/main_styles.css',
    'public/news/css/responsive.css',
    'public/news/css/my-style.css',
    'public/news/css/custom-style.css'], 'public/news/css/all-css.css');

mix.scripts([
    'public/admin/js/jquery/dist/jquery.min.js',
    'public/admin/asset/bootstrap/dist/js/bootstrap.min.js',
    'public/admin/js/fastclick/lib/fastclick.js',
    'public/admin/asset/nprogress/nprogress.js',
    'public/admin/asset/bootstrap-progressbar/bootstrap-progressbar.min.js',
    'public/admin/asset/iCheck/icheck.min.js',
    'public/admin/js/notify.min.js',
    'public/admin/js/custom.min.js',
    'public/admin/js/my-js.js'], 'public/admin/js/all-js.js');

mix.scripts([
    'public/news/js/jquery-3.2.1.min.js',
    'public/news/css/bootstrap-4.1.2/popper.js',
    'public/news/css/bootstrap-4.1.2/bootstrap.min.js',
    'public/news/js/greensock/TweenMax.min.js',
    'public/news/js/greensock/TimelineMax.min.js',
    'public/news/js/scrollmagic/ScrollMagic.min.js',
    'public/news/js/greensock/animation.gsap.min.js',
    'public/news/js/greensock/ScrollToPlugin.min.js',
    'public/news/js/OwlCarousel2-2.2.1/owl.carousel.js',
    'public/news/js/easing/easing.js',
    'public/news/js/parallax-js-master/parallax.min.js',
    'public/admin/js/notify.min.js',
    'public/news/js/custom.js',
    'public/news/js/my-js.js',
    'public/news/js/modules/contact.js'], 'public/news/js/all-js.js');


mix.minify('public/admin/css/all-css.css');
mix.minify('public/news/css/all-css.css');
mix.minify('public/admin/js/all-js.js');
mix.minify('public/news/js/all-js.js');
