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
            if($user->getRoleID() == Role::ROLE_TEACHER || $user->getRoleID() == Role::ROLE_ADMIN){
                $lid = Util::getParam('lid');
                $backLink = Util::getParam('backLink');
                $where =['lesson_id '=>$lid];
                Dbcon::delete('lessons',$where);
                Util::redirect($backLink);
            }
            break;
        case 'enrollToCourse':

            $cid = Util::getParam('cid');
            $uid = $user->getStudentID();
            $openHash = hash('ripemd160', Util::dateNow());
            if(Course::EnrollTo($cid,$uid)){
                $_SESSION['message'][$openHash] = ['result'=>'success','message'=>'Successfully Enrolled to a course'];
                Util::redirect('student.php?message='.$openHash);
            }else{
                $_SESSION['message'][$openHash] = ['result'=>'failed','message'=>'Error in Enrolling to a course'];
            }
        case 'exportData':
            $sid = Util::getParam('sid');
            $data = unserialize($_SESSION['ExportData'][$sid]);
            unset($_SESSION['ExportData'][$sid] );
            $filename = date('YmdHis');
            $file = fopen("public/{$filename}.csv", 'w');
            foreach ($data as $row){
                fputcsv($file,$row);
            }
            fclose($file);
            echo "public/{$filename}.csv";
            break;
    }
}
