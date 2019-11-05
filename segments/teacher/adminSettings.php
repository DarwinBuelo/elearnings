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
    'lib/sufee-admin-dashboard-master/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
    'lib/sufee-admin-dashboard-master/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css',
    'styles/modal.css'
];
// sufee admin default
$js = [
    'lib/sufee-admin-dashboard-master/vendors/jquery/dist/jquery.min.js',
    'lib/sufee-admin-dashboard-master/vendors/popper.js/dist/umd/popper.min.js',
    'lib/sufee-admin-dashboard-master/vendors/bootstrap/dist/js/bootstrap.min.js',
];

$dataTables = [
    'lib/sufee-admin-dashboard-master/vendors/datatables.net/js/jquery.dataTables.min.js',
    'lib/sufee-admin-dashboard-master/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
    'lib/sufee-admin-dashboard-master/vendors/datatables.net-buttons/js/dataTables.buttons.min.js',
    'lib/sufee-admin-dashboard-master/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js',
    'lib/sufee-admin-dashboard-master/vendors/jszip/dist/jszip.min.js',
    'lib/sufee-admin-dashboard-master/vendors/pdfmake/build/pdfmake.min.js',
    'lib/sufee-admin-dashboard-master/vendors/pdfmake/build/vfs_fonts.js',
    'lib/sufee-admin-dashboard-master/vendors/datatables.net-buttons/js/buttons.html5.min.js',
    'lib/sufee-admin-dashboard-master/vendors/datatables.net-buttons/js/buttons.print.min.js',
    'lib/sufee-admin-dashboard-master/vendors/datatables.net-buttons/js/buttons.colVis.min.js',
    'lib/sufee-admin-dashboard-master/assets/js/init-scripts/data-table/datatables-init.js',
    'js/validator.js',
    'js/uploadPreview.js',
    'lib/sufee-admin-dashboard-master/vendors/chart.js/dist/Chart.js',
];

$js = array_merge($js,$dataTables);
$adminOutline->addCss($css);
$adminOutline->addJS($js);