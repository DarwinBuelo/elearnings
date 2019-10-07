<?php

const TABLE_NAME = 'student_exam';

$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/init.php';
$examID = Util::getParam('examID');
$_SESSION['hash'] = $examID;
$user = unserialize($_SESSION['user']);
$userID = $user->getStudentID();
$attempts = Exam::getAttempts($userID, $examID);
$studentExamID = Exam::studentExist($userID, $examID);
if ($attempts == false) {
    $return = false;
} else {
    if ($studentExamID != false) {
        $where = [
            'student_exam_id' => $studentExamID
        ];
        Exam::resetExam($where);
        Exam::incrementAttempts($studentExamID);
        $_SESSION['studentExamID'] = $studentExamID;
    } else {
        $data = [
            'student_id' => $userID,
            'exam_id' => $examID,
            'attempts' => 1
        ];
        $_SESSION['studentExamID'] = Dbcon::insert(TABLE_NAME, $data);
    }
    $return = $examID;
}
echo json_encode($return);
//EOF