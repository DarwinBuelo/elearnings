<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path.'init.php');
$Outline->addCSS($path.'styles/contact.css');
$Outline->addCSS($path.'styles/contact_responsive.css');
require('examHtml.php');
$Outline->addJS($path.'plugins/marker_with_label/marker_with_label.js');
$Outline->addJS($path.'js/contact.js');
//EOF