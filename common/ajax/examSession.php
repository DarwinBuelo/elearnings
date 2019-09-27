<?php

const TABLE_NAME = 'student_exam';

$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/init.php';
$examID = Util::getParam('examID');
$_SESSION['hash'] = $examID;
$user = unserialize($_SESSION['user']);
$userID = $user->getStudentID();
$data = [
    'student_id' => $userID,
    'exam_id' => $examID
];
Dbcon::insert(TABLE_NAME, $data);
echo json_encode($examID);
//EOF