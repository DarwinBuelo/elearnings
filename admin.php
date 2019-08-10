<?php
require 'init.php';
require 'segments/admin/adminSettings.php';
$adminOutline->header();

$page = Util::getParam('page');

if(isset($user) && $user->getRoleID() == 1){
    //include all admin pages needed
    require 'segments/admin/sidebar.php';
    print '<div id="right-panel" class="right-panel">';
    require 'segments/admin/rightPanel.php';
    print '<div class="content mt-3">';
    if(isset($page)){
        switch ($page){

            case 'addUser':
                echo 'test';
                require 'segments/admin/addUser/addUser.php';
                break;
            default:
                require 'segments/admin/dashboard/dashboard.php';
                break;
        }
    }
    print '</div></div>';

}

