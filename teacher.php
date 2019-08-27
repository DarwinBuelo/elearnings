<?php
require 'init.php';
require 'segments/teacher/adminSettings.php';


$sceditorJS = [
    'lib/minified/sceditor.min.js',
    'lib/minified/icons/monocons.js',
    'lib/minified/formats/bbcode.js',
   ];
$adminOutline->addCSS('lib/minified/themes/default.min.css');
$adminOutline->addJS($sceditorJS);
$adminOutline->header('Teacher Panel');

$page = Util::getParam('page');

if ($user) {
    if ($user->getRoleID() == 2) {
        $adminOutline->loadJS(); //will load the js since we can't use the current header to this Layout

        //include all admin pages needed
        require 'segments/teacher/sidebar.php';
        print '<div id="right-panel" class="right-panel">';
        require 'segments/teacher/rightPanel.php';
        print '<div class="content mt-3">';
        if (isset($page)) {
            switch ($page) {
                case 'courses':
                    require 'segments/teacher/courseDetails/courses.php';
                    break;
                case 'courseDetails':
                    require 'segments/teacher/courseDetails/courseDetails.php';
                    break;
                case 'addCourse':
                    require 'segments/teacher/addCourse/addCourse.php';
                    break;
                case 'addLesson':
                    require 'segments/teacher/addLesson/addLesson.php';
                    break;
                case 'addExam':
                    require 'segments/teacher/addExam/addExam.php';
                    break;
                case 'examDetails':
                    require 'segments/teacher/addExam/examDetails.php';
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
