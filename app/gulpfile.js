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
    mix.sass('app.scss');
    mix.browserSync({
        proxy: '192.168.99.100:32771'
    });
    mix.scripts([
    	'config.js',
    	'../bower/jquery-timeago/jquery.timeago.js',
    	'script.js',
    	'facebook-login.js',
    ]);
});
