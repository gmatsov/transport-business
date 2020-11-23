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
    .js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/report.js', 'public/js')
    .js('resources/js/truck/show.js', 'public/js/truck')
    .js('resources/js/truck/create.js', 'public/js/truck')
    .js('resources/js/truck/edit.js', 'public/js/truck')
    .js('resources/js/truck/remove.js', 'public/js/truck')
    .js('resources/js/add_reminder.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .less('resources/less/guest.less', 'public/css')
    .sass('resources/sass/reminder/show.scss', 'public/css/reminder')
    .sass('resources/sass/styles.scss', 'public/css')
    .sass('resources/sass/sidebar.scss', 'public/css')
    .sass('resources/sass/home-page-styles.scss', 'public/css')
    .sass('resources/sass/truck/show.scss', 'public/css/truck')
    .sass('resources/sass/create-refuel.scss', 'public/css');
