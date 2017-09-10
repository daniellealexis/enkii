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

// JavaScript
mix.js('resources/assets/js/app-main.js', 'public/js');
    //.extract(['vendors'])

// Stylus/CSS
mix.stylus('resources/assets/styles/app-main.styl', 'public/css');

mix.browserSync('enkii.app');

mix.webpackConfig({
    module: {
        rules: [
            {
                // Handlebars Templates
                test: /\.hbs$/,
                loader: 'handlebars-loader',
            },
        ],
        loaders: [
            {
                // Linting
                test: /\.js$/,
                include: /resources\/assets\/js/,
                // exclude: /node_modules/,
                loader: 'eslint-loader',
                //enforce: 'post',
            },
        ]
    },
});
