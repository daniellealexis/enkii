let mix = require('laravel-mix');

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


// Handlebars Templates
mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.hbs$/,
                loader: "handlebars-loader",
            },
        ],
    },
});

// JavaScript
mix.js('resources/assets/js/app-main.js', 'public/js');
    //.extract(['vendors'])
mix.react('resources/assets/js/react-entry.jsx', 'public/js');

// Stylus/CSS
mix.stylus('resources/assets/styles/app-main.styl', 'public/css');

mix.browserSync('enkii.app');
