<?php
require 'init.php';
$Outline->loadJS();

$course = Course::load(5);

//foreach($exam as $exams){
    Util::debug($course->getLessons());
//}