<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/init.php';
$examID = Util::getParam('examID');
$_SESSION['hash'] = $examID;
echo json_encode($examID);
//EOF