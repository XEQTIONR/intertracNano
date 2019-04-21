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

mix.less('resources/assets/less/main.less', '../resources/assets/css')

    .scripts([
    'node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js',

        'resources/assets/js/jquery.inputmask.bundle.js',

        'node_modules/admin-lte/bower_components/datatables.net/js/jquery.dataTables.js',


        // 'node_modules/inputmask/dependencyLibs/inputmask.dependencyLib.jquery.js',

    // 'node_modules/inputmask/dist/inputmask/inputmask.js',
    //     'node_modules/inputmask/dist/inputmask/jquery.inputmask.js',
    // 'node_modules/inputmask/dist/inputmask/inputmask.extensions.js',
    // 'node_modules/inputmask/dist/inputmask/inputmask.numeric.extensions.js',
    // 'node_modules/inputmask/dist/inputmask/inputmask.date.extensions.js',

    //'node_modules/inputmask/dist/inputmask/bindings/inputmask.binding.js',

      // 'node_modules/inputmask/dist/jquery.inputmask.bundle.js',
      // 'node_modules/inputmask/dist/inputmask/bindings/inputmask.binding.js',

    'node_modules/admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.js',
        'resources/assets/js/currencies.js',
    'node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/admin-lte/dist/js/adminlte.min.js',
    'node_modules/vue-select/dist/vue-select.js',



        // 'node_modules/select2/dist/js/select2.js',
    //"https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js",
        //'node_modules/currency-symbol-map/map.js',
        //'node_modules/currency-symbol-map/currency-symbol-map.js'
    ], 'public/js/app.js')

    .styles([
        'node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css',

        'resources/assets/css/dataTables.bootstrap.css',
        //'node_modules/admin-lte/bower_components/datatables.net-bs/dataTables.bootstrap.css',
        //'http://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css',
        'node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css',
        'node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css',
        'node_modules/admin-lte/dist/css/AdminLTE.min.css',
        'node_modules/admin-lte/dist/css/skins/skin-black.min.css',
        'node_modules/animate.css/animate.css',
        'node_modules/vue-select/dist/vue-select.css',
        // 'node_modules/select2/dist/css/select2.css',
        // 'node_modules/inputmask/css/inputmask.css',
        'resources/assets/css/main.css'], 'public/css/app2.css');
