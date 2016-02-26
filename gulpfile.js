var elixir = require('laravel-elixir');

elixir(function(mix) {
 mix
     .phpUnit()

    /**
     * Copy needed files from /node directories
     * to /public directory.
     */
     .copy(
        'node_modules/font-awesome/fonts',
        'public/build/fonts/font-awesome'
     )
     .copy(
        'node_modules/bootstrap-sass/assets/fonts/bootstrap',
        'public/build/fonts/bootstrap'
     )
     .copy(
         'node_modules/webuploader',
         'public/plugins/webuploader'
     )
     .copy(
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        'public/js/vendor/bootstrap'
     )
     .copy(
        'resources/assets/js/backend/plugin/jvectormap/jquery-jvectormap-1.2.2.css',
        'resources/assets/css/plugin'
     )
     .copy(
        'resources/assets/js/backend/plugin/pace/pace.min.css',
        'resources/assets/css/plugin'
     )

     /**
      * Process frontend SCSS stylesheets
      */
     .sass([
        'backend/app.scss',
        'plugin/sweetalert/sweetalert.scss'
     ], 'resources/assets/css/frontend/app.css')

     /**
      * Combine pre-processed frontend CSS files
      */
     .styles([
        'frontend/app.css'
     ], 'public/css/frontend.css')

     /**
      * Combine frontend scripts
      */
     .scripts([
        'plugin/sweetalert/sweetalert.min.js',
        'plugins.js',
        'backend/app.js'
     ], 'public/js/frontend.js')

     /**
      * Process backend SCSS stylesheets
      */
     .sass([
         'backend/app.scss',
         'backend/plugin/toastr/toastr.scss',
         'plugin/sweetalert/sweetalert.scss'
     ], 'resources/assets/css/backend/plugin.css')

     /**
      * Process backend LESS stylesheets
      */
     .less([
         'backend/AdminLTE.less'
     ],'resources/assets/css/backend/app.css')

     /**
      * Combine pre-processed backend CSS files
      */
     .styles([
         'backend/app.css',
         'backend/plugin.css',
         'plugin/pace.min.css'
     ], 'public/css/backend.css')

     /**
      * Combine backend scripts
      */
     .scripts([
         'plugin/sweetalert/sweetalert.min.js',
         'plugin/validate/jquery.validate.min.js',
         'plugins.js',
         'backend/app.js',
         'backend/plugin/pace/pace.min.js',
         'backend/plugin/toastr/toastr.min.js',
         'backend/plugin/slimScroll/jquery.slimscroll.min.js',
         'backend/custom.js',
         'backend/my.js'
     ], 'public/js/backend.js')

     /**
      * Cobine backend-index script
      */
     .scripts([
         'backend/plugin/sparkline/jquery.sparkline.min.js',
         'backend/plugin/jvectormap/jquery-jvectormap-1.2.2.min.js',
         'backend/plugin/jvectormap/jquery-jvectormap-world-mill-en.js',
         'backend/my-index.js'
     ], 'public/js/backend-index.js')

     /**
      * Combine pre-processed backend-index CSS files
      */
     .styles([
         'plugin/jquery-jvectormap-1.2.2.css'
     ], 'public/css/backend-index.css')

     /**
      * Apply version control
      */
     .version([
         "public/css/frontend.css",
         "public/js/frontend.js",
         "public/css/backend.css",
         "public/js/backend.js",
         "public/css/backend-index.css",
         "public/js/backend-index.js"
     ]);
});