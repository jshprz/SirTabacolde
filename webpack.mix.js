let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/landingpage.js', 'public/js')
mix.js('resources/assets/js/registration.js', 'public/js')
mix.js('resources/assets/js/login.js', 'public/js')
mix.js('resources/assets/js/profile.js', 'public/js')
   .sass('resources/assets/sass/landingpage.scss', 'public/css')
   .sass('resources/assets/sass/registration.scss', 'public/css')
   .sass('resources/assets/sass/login.scss', 'public/css')
   .sass('resources/assets/sass/profile.scss', 'public/css');
