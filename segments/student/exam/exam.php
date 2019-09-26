<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path.'/init.php');
$css = [
    '/styles/contact_responsive.css',
    '/styles/contact.css',
    '/styles/examForm.css'
];
$Outline->addCSS($css);
$Outline->header();
require('examHtml.php');
//EOF