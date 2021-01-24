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

mix.js('pages/landing/src/main.js', 'public/js').vue()
    .postCss('pages/landing/css/main.css', 'public/css');

mix.js('pages/dashboard/src/dash.js', 'public/js').vue()
    .postCss('pages/dashboard/css/dash.css', 'public/css');

mix.js('pages/admin/src/admin.js', 'public/js').vue()
    .postCss('pages/admin/css/admin.css', 'public/css');