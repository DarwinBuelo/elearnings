<?php
//set the layout of the admin panel

$adminOutline = new Layout();
// suffee admin default
$css =[
    'lib/sufee-admin-dashboard-master/vendors/bootstrap/dist/css/bootstrap.min.css',
    'lib/sufee-admin-dashboard-master/vendors/font-awesome/css/font-awesome.min.css',
    'lib/sufee-admin-dashboard-master/vendors/themify-icons/css/themify-icons.css',
    'lib/sufee-admin-dashboard-master/vendors/flag-icon-css/css/flag-icon.min.css',
    'lib/sufee-admin-dashboard-master/vendors/selectFX/css/cs-skin-elastic.css',
    'lib/sufee-admin-dashboard-master/vendors/jqvmap/dist/jqvmap.min.css',
    'lib/sufee-admin-dashboard-master/assets/css/style.css',
];
// sufee admin default
$js = [
    'lib/sufee-admin-dashboard-master/vendors/jquery/dist/jquery.min.js',
    'lib/sufee-admin-dashboard-master/vendors/popper.js/dist/umd/popper.min.js',
    'lib/sufee-admin-dashboard-master/vendors/bootstrap/dist/js/bootstrap.min.js',
    'lib/sufee-admin-dashboard-master/assets/js/main.js',
    'lib/sufee-admin-dashboard-master/vendors/chart.js/dist/Chart.bundle.min.js',
    'lib/sufee-admin-dashboard-master/vendors/jqvmap/dist/jqvmap.min.css',
    'lib/sufee-admin-dashboard-master/assets/js/dashboard.js',
    'js/uploadPreview.js',
];

$adminOutline->addCss($css);
$adminOutline->addJS($js);