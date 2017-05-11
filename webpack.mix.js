const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application.
 |
 | https://laravel.com/docs/5.4/mix
 */

mix.js('resources/assets/js/app-main.js', 'public/js');
    //.extract(['vendors'])

mix.stylus('resources/assets/styles/app-main.styl', 'public/css');

mix.browserSync('enkii.app');
