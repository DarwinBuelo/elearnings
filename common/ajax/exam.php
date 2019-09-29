<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/init.php';
$hash = $_SESSION['hash'];
$examDetails = Exam::getExamDetails($hash);
echo json_encode($examDetails);
//EOF