<?php

$lessons = $course->getLessons();
$allExam = [];
foreach ($lessons as $lesson) {
    $allExam = $lesson->getExams();

}

var_dump($allExam);