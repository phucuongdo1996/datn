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

mix.sass('resources/sass/custom/custom.scss', 'public/css/app.min.css')
    .sass('resources/sass/dota/common.scss', 'public/css/dota/common.min.css')
    .sass('resources/sass/dota/list_item.scss', 'public/css/dota/list_item.min.css');
