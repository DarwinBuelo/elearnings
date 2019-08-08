<?php
// just load the classes
// auto load all classes inside the class folder
spl_autoload_register(function ($class) {
    require_once "class/".$class.".php";
});

$companyname = '';
$companydesc = '';
$Outline = new Layout($companyname, $companydesc);

$css = [
    'assets/css/bootstrap.min.css', 
    'assets/css/plugins/slicknav.min.css',
    'assets/css/plugins/magnific-popup.css',
    'assets/css/plugins/owl.carousel.min.css',
    'assets/css/plugins/gijgo.css',
    'assets/css/font-awesome.css',
    'assets/css/reset.css',
    'style.css',
    'assets/css/responsive.css'
];
$js = [
    'assets/js/jquery-3.2.1.min.js',
    'assets/js/jquery-migrate.min.js',
    'assets/js/popper.min.js',
    'assets/js/bootstrap.min.js',
    'assets/js/plugins/gijgo.js',
    'assets/js/plugins/vegas.min.js',
    'assets/js/plugins/isotope.min.js',
    'assets/js/plugins/owl.carousel.min.js',
    'assets/js/plugins/waypoints.min.js',
    'assets/js/plugins/counterup.min.js',
    'assets/js/plugins/mb.YTPlayer.js',
    'assets/js/plugins/magnific-popup.min.js',
    'assets/js/plugins/slicknav.min.js',
    'assets/js/main.js'
];

$Outline->addCSS($css);
$Outline->addJS($js);
$Outline->navigationBar();
