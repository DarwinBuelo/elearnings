<?php
require 'init.php';
$Outline->loadJS();

$courses = Exam::isExamDate();

Util::debug($courses);