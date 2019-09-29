<?php
require 'init.php';
$Outline->loadJS();

$courses = Exam::getStudentAnalysis('20190917150904');
Util::debug($courses);