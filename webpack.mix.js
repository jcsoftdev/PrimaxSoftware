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


mix.styles([
   'resources/assets/css/bootstrap.min.css',
   'resources/assets/css/font-awesome.min.css',
   'resources/assets/css/ionicons.min.css',
   'resources/assets/css/AdminLTE.css',
   'resources/assets/css/_all-skins.min.css',
   'resources/assets/css/blue.css',
   'resources/assets/css/myStyle.css',
], 'public/css/plantilla.css')
   .scripts([  
      'resources/assets/js/jquery.min.js',
      'resources/assets/js/bootstrap.min.js',
      'resources/assets/js/jquery.slimscroll.min.js',
      'resources/assets/js/fastclick.js',
      'resources/assets/js/adminlte.min.js',
      'resources/assets/js/icheck.js',
   ], 'public/js/plantilla.js')
   .js(['resources/js/app.js'], 'public/js/app.js');