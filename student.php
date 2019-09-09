<?php
require 'init.php';
require 'segments/student/adminSettings.php';

$sceditorJS = [
    'lib/minified/sceditor.min.js',
    'lib/minified/icons/monocons.js',
    'lib/minified/formats/bbcode.js',
];
$adminOutline->addCSS('lib/minified/themes/default.min.css');
$adminOutline->addJS($sceditorJS);
$adminOutline->header('Student Panel');

$page = Util::getParam('page');
$sessionUser = $_SESSION['user'];

if(isset($sessionUser)){
 $User = unserialize($sessionUser);
}else{
    Util::redirect('login.php?error=1');
}

if (isset($page)) {
    $adminOutline->loadJS();
    require 'segments/student/sidebar.php';
    print '<div id="right-panel" class="right-panel">';
    require 'segments/student/rightPanel.php';

    switch ($page) {
        case 'course':
            require 'segments/student/student/studentCourse.php';
            break;
        default:
            require 'segments/student/dashboard/dashboard.php';
            break;
    }
    echo '</div></div>';
}

//EOF