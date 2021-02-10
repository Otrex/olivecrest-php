const mix = require('laravel-mix');
const path = require('path');

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
    .webpackConfig({
         module: {
             rules: [
                 {
                     test: /\.jsx?$/,
                     exclude: /node_modules(?!\/foundation-sites)|bower_components/,
                     use: [
                         {
                             loader: 'babel-loader',
                             options: Config.babel()
                         }
                     ]
                 }
             ]
         },
         resolve: {
            alias: {
              '@': path.resolve('pages/landing/scss/')
            }
          }
     })
    .sass('pages/landing/scss/main.scss', 'public/css');

mix.js('pages/dashboard/src/dash.js', 'public/js').vue()
	.webpackConfig({
         module: {
             rules: [
                 {
                     test: /\.jsx?$/,
                     exclude: /node_modules(?!\/foundation-sites)|bower_components/,
                     use: [
                         {
                             loader: 'babel-loader',
                             options: Config.babel()
                         }
                     ]
                 }
             ]
         },
         resolve: {
            alias: {
              '@': path.resolve('pages/dashboard/scss/')
            }
          }
     })
	.sass('pages/dashboard/scss/dash.scss', 'public/css');
    // .postCss('pages/dashboard/css/dash.css', 'public/css');

mix.js('pages/admin/src/admin.js', 'public/js').vue()
    .postCss('pages/admin/css/admin.css', 'public/css');

