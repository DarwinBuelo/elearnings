<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path.'/init.php');
//$css = [
//    $path.'styles/contact_responsive.css',
//    $path.'styles/contact.css',
//    $path.'styles/examForm.css'
//];
//$Outline->addCSS($css);
//$Outline->header();
$hash = $_SESSION['hash'];
$examDetails = Exam::getExamDetails($hash);
var_dump($examDetails);
require('examHtml.php');
//EOF