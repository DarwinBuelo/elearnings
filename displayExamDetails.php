<?php
require 'init.php';
$examQuestionID = $_POST['examQuestionID'];
$examID = $_POST['examID'];
$examDetails = Exam::getExamDetails($examID, $examQuestionID);
$test = [];
//foreach ($examDetails as $ExamDetail) {
//    $test[] = $ExamDetail['question'];
//}
echo json_encode($examDetails);
//EOF