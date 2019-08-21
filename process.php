<?php
/**
 *  Will handle all the process on the system
 */

require 'init.php';

$task = Util::getParam('task');
$user = unserialize($_SESSION['user']);
if(isset($user)&& !empty($user)){
    switch ($task) {
        case 'logout':
            session_destroy();
            header('location:index.php');
            break;

        case 'delCourse':
            if($user->getRoleID() == Role::ROLE_TEACHER ){
                $cid = Util::getParam('cid');
                $backLink = Util::getParam('backLink');
                $where =['course_id '=>$cid];
                Dbcon::delete('courses',$where);
                Util::redirect($backLink);
            }
            break;
        case 'delLesson':
            if($user->getRoleID() == Role::ROLE_TEACHER ){
                $lid = Util::getParam('lid');
                $backLink = Util::getParam('backLink');
                $where =['lesson_id '=>$lid];
                Dbcon::delete('lessons',$where);
                Util::redirect($backLink);
            }
            break;
    }
}
