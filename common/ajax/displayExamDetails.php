<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/init.php';
$examQuestionID = $_POST['examQuestionID'];
$examID = $_POST['examID'];
$examDetails = Exam::getExamDetails($examID, $examQuestionID);
echo json_encode($examDetails);
//EOF