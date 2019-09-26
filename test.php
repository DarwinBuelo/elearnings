<?php
require 'init.php';
$Outline->loadJS();

$courses = Exam::isExamDate(8);

Util::debug($courses);