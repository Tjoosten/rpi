var gulp   = require('gulp');
var apidoc = require('gulp-apidoc');
var elixer = require('laravel-elixer');

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
 
 // Copy files to a new directory.
 elixir(function(mix) {
    mix.copy('vendor/package/views', 'resources/views');
});
 
 // Running phpunit.
 elixir(function(mix) {
    mix.phpUnit();
});
 
 // Compile less to css.
 elixir(function(mix) {
    mix.less('bootstrap.less');
});
 
 // Generate API documentation.
 gulp.task('apidoc',function(){
	apidoc.exec({
	src: "App/Http/Controllers",
	dest: "Resources/API-documentation",
    debug: true,
});
