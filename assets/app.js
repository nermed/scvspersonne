/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// loads the jquery package from node_modules
// import $ from 'jquery';
// require('overlayscrollbars');
var Turbolinks = require("turbolinks")
Turbolinks.start()

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
// require('bootstrap');
import 'bootstrap';
// create global $ and jQuery variables
global.$ = global.jQuery = $;

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/userscss.css';
import './plugins/bootstrap/js/bootstrap.js';
import './plugins/fontawesome-free/css/all.min.css';
import './plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css';
import './plugins/icheck-bootstrap/icheck-bootstrap.min.css';
import './plugins/jqvmap/jqvmap.min.css';
import './dist/css/adminlte.css';
import './plugins/select2/css/select2.css';
import './plugins/select2-bootstrap4-theme/select2-bootstrap4.css'
import './plugins/overlayScrollbars/css/OverlayScrollbars.min.css';
import './plugins/overlayScrollbars/css/OverlayScrollbars.min.css';
import './plugins/daterangepicker/daterangepicker.css';
import './plugins/summernote/summernote-bs4.css';

// start the Stimulus application
import './dist/js/adminlte.js';
import './dist/js/demo.js';
import './plugins/select2/js/select2.js'
import './plugins/bootstrap/js/bootstrap.js';
import './plugins/bootstrap/js/popper.js';
import './plugins/bootstrap/js/bootstrap.bundle.min.js';
import './plugins/chart.js/Chart.min.js';
import './plugins/sparklines/sparkline.js';
import './plugins/jquery/jquery.min.js';
import './plugins/jquery-ui/jquery-ui.min.js';
import './plugins/jqvmap/jquery.vmap.min.js';
import './plugins/jqvmap/maps/jquery.vmap.usa.js';
import './plugins/jquery-knob/jquery.knob.min.js';
import './plugins/moment/moment.js';
import './plugins/moment/locale/fr.js';
import './plugins/daterangepicker/daterangepicker.js';
import './plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js';
import './plugins/summernote/summernote-bs4.min.js';
import './plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js';
