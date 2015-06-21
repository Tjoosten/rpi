var gulp   =    require('gulp');
var apidoc =    require('gulp-apidoc');
var elixir =    require('laravel-elixir');
                require('laravel-elixir-apidoc');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 | Commands:
 | =================
 | Apidoc       = Generate API documentation
 | Gulp         = Run all the tasks.
 | Gulp styles  = Compile all the styling. 
 | Gulp scripts = Compile all the scripts
 | Gulp tdd     = Watch Tests And PHP Classes for Changes
 */

elixir(function(mix) {
    mix.apidoc();
    mix.less('bootstrap/bootstrap.less');
    mix.less('bootstrap/costum.less');
    mix.copy('resources/assets/fonts/bootstrap', 'public/fonts');
    mix.scripts(
        [
            'affix.js',
            'alert.js',
            'button.js',
            'carousel.js',
            'collapse.js',
            'dropdown.js',
            'modal.js',
            'tooltip.js',
            'popover.js',
            'scrollspy.js',
            'tab.js',
            'transition.js'
        ],
        'public/js/bootstrap.js'
    );
});