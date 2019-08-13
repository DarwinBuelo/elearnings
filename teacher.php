<?php
require 'init.php';
require 'segments/teacher/adminSettings.php';
$adminOutline->header();

$page = Util::getParam('page');

if ($user) {
    if ($user->getRoleID() == 2) {
        //include all admin pages needed
        require 'segments/teacher/sidebar.php';
        print '<div id="right-panel" class="right-panel">';
        require 'segments/teacher/rightPanel.php';
        print '<div class="content mt-3">';
        if (isset($page)) {
            switch ($page) {
                case 'addCourse':
                    require 'segments/teacher/addCourse/addCourse.php';
                    break;
                case 'addLesson':
                    require 'segments/teacher/addLesson/addLesson.php';
                    break;
                default:
                    require 'segments/teacher/dashboard/dashboard.php';
                    break;
            }
        }
        print '</div></div>';
    }
} else {
    Util::redirect('index.php');
}
