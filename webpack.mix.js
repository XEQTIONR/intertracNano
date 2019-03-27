let  mix  = require('laravel-mix');

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

mix.less('public/less/app.less', 'public/css')

    .combine([
    'node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js',
    'node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/admin-lte/dist/js/adminlte.min.js'], 'public/js/app.js')

    .styles([
        'node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css',
        'node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css',
        'node_modules/admin-lte/dist/css/AdminLTE.min.css',
        'node_modules/admin-lte/dist/css/skins/skin-blue.min.css'], 'public/css/app2.css');
