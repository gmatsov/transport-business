const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/add_truck.js', 'public/js')
    .js('resources/js/edit_truck.js', 'public/js')
    .js('resources/js/remove_truck.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/styles.scss', 'public/css')
    .sass('resources/sass/sidebar.scss', 'public/css')
    .sass('resources/sass/home-page-styles.scss', 'public/css')
    .sass('resources/sass/show-truck.scss', 'public/css')
    .sass('resources/sass/create-refuel.scss', 'public/css');
