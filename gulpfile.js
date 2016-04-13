var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass(['app.scss', 'partials/form.scss'])

    mix.scripts([
        'libs/sweetalert-dev.js',
        'libs/jquery.min.js'
        //'libs/dropzone.js',
    ], './public/js/libs.js');

    mix.styles([

        'libs/sweetalert.css',
        'libs/font-awesome.min.css'
        //'libs/dropzone.css'
    ], './public/css/libs.css');

});