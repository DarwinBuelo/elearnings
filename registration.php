<?php
require_once('init.php');
$Outline->addCSS('styles/contact.css');
$Outline->addCSS('styles/contact_responsive.css');
$Outline->addCSS('https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css');
$Outline->header('Registration');
$Outline->navigationBar('Registration');
require 'segments/registrationForm.php';

const REGISTERED_USER_TABLE = 'registered_user';

$date = Util::getParam('date');
$name = Util::getParam('name');
$school = Util::getParam('school');
$address = Util::getParam('address');
$contact = Util::getParam('contact');
$gradeLevel = Util::getParam('gradeLevel');
$birthday = Util::getParam('birthday');
$age = Util::getParam('age');
$emailAddress = Util::getParam('emailAddress');
$allergies = Util::getParam('allergies');
$program = Util::getParam('program');
$mothersName = Util::getParam('mothersName');
$motherOccupation = Util::getParam('motherOccupation');
$motherOfficeAddress = Util::getParam('motherOfficeAddress');
$motherTelNo = Util::getParam('motherTelNo');
$fathersName = Util::getParam('fathersName');
$fatherOccupation = Util::getParam('fatherOccupation');
$fatherOfficeAddress = Util::getParam('fatherOfficeAddress');
$fatherTelNo = Util::getParam('fatherTelNo');
$noOfSiblings = Util::getParam('noOfSiblings');
$otherProgram = Util::getParam('otherProgram');
$suggestions = Util::getParam('suggestions');
$others = Util::getParam('others');

if (isset($_POST['register'])) {
    $studentID = date('YmdHms');
    $password = rand(1000, 9999);
    $data = [
        'date'  =>  date('Y-m-d H:m:s'),
        'student_id'  =>  $studentID,
        'password'  =>  $password,
        'student_name'  =>  $name,
        'school'  =>  $school,
        'address'  =>  $address,
        'contact_no'  =>  $contact,
        'grade_level'  =>  $gradeLevel,
        'birthday'  =>  $birthday,
        'age'  =>  $age,
        'email_address'  =>  $emailAddress,
        'allergies'  =>  $allergies,
        'program'  =>  implode(', ', $program),
        'mothers_name'  =>  $mothersName,
        'mother_occupation'  =>  $motherOccupation,
        'mother_office_address'  =>  $motherOfficeAddress,
        'mother_tel_no'  =>  $motherTelNo,
        'fathers_name'  =>  $fathersName,
        'father_occupation'  =>  $fatherOccupation,
        'father_office_address'  =>  $fatherOfficeAddress,
        'father_tel_no'  =>  $fatherTelNo,
        'no_of_siblings'  =>  $noOfSiblings,
        'other_programs_attended'  =>  $otherProgram,
        'suggestions'  =>  $suggestions,
        'others'  =>  $others
    ];
    Dbcon::insert(REGISTERED_USER_TABLE, $data);
}

$Outline->addJS('plugins/marker_with_label/marker_with_label.js');
$Outline->addJS('js/contact.js');
$Outline->addJS('https://code.jquery.com/jquery-3.3.1.slim.min.js');
$Outline->addJS('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
$Outline->addJS('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
$Outline->addJS('plugins/MultiSelect/dist/js/BsMultiSelect.js');
$Outline->footer();
//EOF