<?php
require 'init.php';
$Outline->loadJS();

$courses = Course::LoadArray();
Util::debug($courses);