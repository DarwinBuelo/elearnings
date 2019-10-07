<?php
require 'init.php';
$Outline->loadJS();
$examID = Exam::studentExist(20190917150904, 14);
Util::debug($examID);