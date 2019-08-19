<?php
require 'init.php';
require 'segments/admin/adminSettings.php';
$adminOutline->header('Admin Panel');

$page = Util::getParam('page');

if ($user) {
    if ($user->getRoleID() == 1) {
        //include all admin pages needed
        require 'segments/admin/sidebar.php';
        print '<div id="right-panel" class="right-panel">';
        require 'segments/admin/rightPanel.php';
        print '<div class="content mt-3">';
        if (isset($page)) {
            switch ($page) {
                case 'addUser':
                    require 'segments/admin/addUser/addUser.php';
                    break;
                default:
                    require 'segments/admin/dashboard/dashboard.php';
                    break;
            }
        }
        print '</div></div>';
        $adminOutline->loadJS(); //will load the js since we can't use the current header to this Layout
    }
} else {
    Util::redirect('index.php');
}
