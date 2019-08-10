<?php
//require pages
require_once('init.php');
$Outline->header('Login');

$username = Util::getParam('uname');
$password = Util::getParam('pswd');

if ($username && $password) {
    // authenticate
    $user = new  User();
    $isLogged = $user->login($username, $password);
    if ($isLogged) {
        $_SESSION['user'] = serialize($user);
    } else {
        $error = "Username or Password was incorrrect";
    }
}

if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    if($user->getRoleID() == 1){
      Util::redirect('admin.php');
    }else{
      Util::redirect('index.php');
    }
    
}

require 'segments/login.form.php';
require 'segments/footer.php';
$Outline->footer();

