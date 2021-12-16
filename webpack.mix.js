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

// mix.js('resources/js/app.js', 'public/js')
//     .js('resources/js/sweetalert.js', 'public/js')
//     .css('resources/css/app.css', 'public/css');


mix.js('resources/js/admin.js', 'public/js/admin/admin.js')
     .css('resources/css/admin.css', 'public/css/admin/admin.css')
     .react();