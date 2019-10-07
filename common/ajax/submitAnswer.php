<?php

const TABLE_EXAM_ANSWER = 'student_exam_answer';
const TABLE_STUDENT_EXAM = 'student_exam';

$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/init.php';
$answer = Util::getParam('answer');
$user = unserialize($_SESSION['user']);
$userID = $user->getStudentID();
$examID = $_SESSION['hash'];
foreach ($answer as $value) {
    $status = ($value[2] == $value[3] ? 1 : 0);
    $data = [
        'student_exam_id' => $_SESSION['studentExamID'],
        'exams_questions_id' => $value[0],
        'item_number' => $value[1],
        'answer' => $value[2],
        'status' => $status
    ];
    Dbcon::insert(TABLE_EXAM_ANSWER, $data);
}
$score = Exam::getScore($userID, $examID);
$passingSore = Exam::getPassingScore($_SESSION['hash']);
$remarks = ($score >= $passingSore ? 1 : 0);
$updateData = [
    'score' => $score,
    'remarks' => $remarks
];
$where = [
    'student_id' => $userID
];
$remarks = ($remarks == 1 ? 'Pass' : 'Failed');
$result = [
    'score' => $score,
    'remarks' => $remarks
];
Exam::updateStudentExam($updateData, $where, $examID);
echo json_encode($result);
//EOF