<?php
require 'init.php';
$Outline->loadJS();

$Lessons = Lesson::LoadArray([23,26,27]);

foreach($Lessons as $lesson){
    $exams = $lesson->getExams();
    Util::debug($exams);
}