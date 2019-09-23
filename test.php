<?php
require 'init.php';
$Outline->loadJS();

$exam = Exam::getExams(1);

//foreach($exam as $exams){
    Util::debug($exam);
//}