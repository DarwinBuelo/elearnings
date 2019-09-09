<?php
//require pages
require_once('init.php');
$Outline->addCSS('styles/contact.css');
$Outline->addCSS('styles/contact_responsive.css');
$Outline->header('Login');

$username = Util::getParam('uname');
$password = Util::getParam('pswd');

$error = Util::getParam('error');

if ($username !== false && $password !== false) {
    // authenticate
    $user     = new User();
    $isLogged = $user->login($username, $password);

    if ($isLogged) {
        $_SESSION['user'] = serialize($user);
    } else {
        //if  student login
        $studentLogIn = Student::login($username, $password);
        Util::debug($studentLogIn);
        if (!empty($studentLogIn)) {
            $_SESSION['user'] = serialize($studentLogIn);
            Util::redirect('student.php');
            die();
        } else {
            $message = "Username or Password was incorrrect";
        }
    }
}

// show error messages
if(isset($error) && !empty($error)){
    switch ($error){
        case '1':
            $message = "Please Login";
            break;
    }

}


// redirect to proper page
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    if ($user->getRoleID() == 1) {
        Dbcon::debug($user);
        Util::redirect('admin.php');
    } elseif ($user->getRoleID() == 2) {
        Util::redirect('teacher.php');
    } elseif ($user->getRoleID() == 3) {
        Util::redirect('student.php');
    } else {
        Util::redirect('index.php');
    }
}

$Outline->navigationBar('Login');
require 'segments/login.form.php';
$Outline->addJS('plugins/marker_with_label/marker_with_label.js');
$Outline->addJS('js/contact.js');
$Outline->footer();
//EOF