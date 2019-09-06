<?php
//require pages
require_once('init.php');
$Outline->addCSS('styles/contact.css');
$Outline->addCSS('styles/contact_responsive.css');
$Outline->header('Registration');
$Outline->navigationBar('Registration');
require 'segments/registrationForm.php';
$Outline->addJS('plugins/marker_with_label/marker_with_label.js');
$Outline->addJS('js/contact.js');
$Outline->footer();
//EOF