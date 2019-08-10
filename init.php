<?php
// just load the classes
// auto load all classes inside the class folder
spl_autoload_register(function ($class) {
    require_once "class/".$class.".php";
});

session_start();

// Company information
define('COMPANY_NAME', 'ELearning System', true);
define('COMPANY_DESC', 'This is an E-Learning System', true);

//Database Configuration
define('DATABASE_NAME', 'elearning', true);
define('DATABASE_USERNAME', 'root', true);
define('DATABASE_PASSWORD', '', true);

//Build Mode
define('PRODUCTION_MODE', false);


//Database setup
Dbcon::$dbname = DATABASE_NAME;
Dbcon::$username = DATABASE_USERNAME;
Dbcon::$password = DATABASE_PASSWORD;

$companyname = '';
$companydesc = '';
$Outline = new Layout($companyname, $companydesc);

$css = [
    'styles/bootstrap4/bootstrap.min.css',
    'plugins/font-awesome-4.7.0/css/font-awesome.min.css',
    'plugins/OwlCarousel2-2.2.1/owl.carousel.css',
    'plugins/OwlCarousel2-2.2.1/owl.theme.default.css',
    'plugins/OwlCarousel2-2.2.1/animate.css',
    'styles/main_styles.css'
];
$js = [
    'js/jquery-3.2.1.min.js',
    'styles/bootstrap4/popper.js',
    'styles/bootstrap4/bootstrap.min.js',
    'plugins/greensock/TweenMax.min.js',
    'plugins/greensock/TimelineMax.min.js',
    'plugins/scrollmagic/ScrollMagic.min.js',
    'plugins/greensock/animation.gsap.min.js',
    'plugins/greensock/ScrollToPlugin.min.js',
    'plugins/OwlCarousel2-2.2.1/owl.carousel.js',
    'plugins/easing/easing.js',
    'plugins/parallax-js-master/parallax.min.js',
    'js/custom.js'
];
$Outline->addCSS($css);
$Outline->addJS($js);

// set the current user
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
} else {
    $user = false;
}
