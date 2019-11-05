<?php
require 'init.php';
require 'segments/admin/adminSettings.php';
$adminOutline->header('Admin Panel');

$page = Util::getParam('page');

if ($user) {
    if ($user->getRoleID() == 1) {
        //include all admin pages needed
        $adminOutline->loadJS();
        require 'segments/admin/sidebar.php';
        print '<div id="right-panel" class="right-panel">';
        require 'segments/admin/rightPanel.php';
        print '<div class="content mt-3">';
        if (isset($page)) {
            switch ($page) {
                case 'addUser':
                    require 'segments/admin/addUser/addUser.php';
                    break;
                case 'student':
                    require 'segments/admin/student/student.php';
                    break;
                case 'course':
                    require 'segments/admin/course/course.php';
                    break;
                case 'addCourse':
                    require 'segments/admin/course/addCourse.php';
                    break;
                case 'courseDetails':
                    require 'segments/admin/course/courseDetails.php';
                    break;

                case 'examDetails':
                    require 'segments/admin/course/examDetails.php';
                    break;
                case 'addLesson':
                    require 'segments/admin/course/addLesson.php';
                    break;

                case 'addExam':
                    require 'segments/admin/course/course.php';
                    break;
                case 'uploadGallery':
                    require 'segments/admin/gallery/gallery.php';
                    break;
                default:
                    require 'segments/admin/dashboard/dashboard.php';
                    break;
            }
        }
        print '</div></div>';
        //will load the js since we can't use the current header to this Layout
    }
} else {
    Util::redirect('index.php');
}
