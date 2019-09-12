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
    }
}



/**
 *
 *
 *
 * $videoUp = new Upload($_FILES['file-0']);
$videoUp->file_new_name_body = "dclcwqVid";
$title = $_POST['title'];
$linkToContent = $_POST['linkto'];

//get the id of the word link to the video
$linkList = $c->select('content','title',$linkToContent);

$linkContentId =$linkList[0]['id'];

$thumb = new Upload($_POST['thumb']);
$thumb->file_new_name_body = 'thumb';

if($videoUp->uploaded){
if($thumb->uploaded){
$videoUp->Process('media/video');
$thumb->Process('media/video/thumbnail');
if($videoUp->processed){
if($thumb->processed){
$date = date("Y/m/d");
$sql="INSERT INTO videocontent
(linkToContent,title,file,thumb,created_date) VALUES
('".$linkContentId."','".$title."','".$videoUp->file_dst_name."','".$thumb->file_dst_name."','".$date."')";

return $c->execute($sql);

}else{
echo 'error: '.$thumb->log;
}

}else{
echo 'error : '. $videoUp->log;
}
}
}
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 */