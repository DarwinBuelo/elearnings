<?php
require 'init.php';
require 'segments/admin/adminSettings.php';
$adminOutline->addCSS('plugins/colorbox/colorbox.css');
$adminOutline->addCSS('styles/courses.css');
$adminOutline->addCSS('styles/courses_responsive.css');
require 'segments/student/sidebar.php';
require 'segments/student/rightPanel.php';
$adminOutline->header('Student Panel');

$page = Util::getParam('page');

if (isset($page)) {
    switch ($page) {
        case 'course':
            require 'segments/admin/student/studentCourse.php';
            break;
        default:
//            require 'segments/admin/dashboard/dashboard.php';
            break;
    }
}
print '</div></div>';
$adminOutline->loadJS();
//EOF