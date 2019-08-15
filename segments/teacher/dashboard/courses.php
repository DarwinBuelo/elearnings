<?php
// will display user courses

$courses =  Course::LoadArray();
foreach ($courses as $course){
    echo $course->getCourseName();
}