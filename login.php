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
$Outline->addCSS('styles/contact.css');
$Outline->addCSS('styles/contact_responsive.css');
$Outline->header('Login');
?>
<div class="counter">
    <div class="counter_background" style="background-image:url(images/piagotsky2.jpg)"></div>
    <div style="padding-left: 28vw;" class="container">
        <div class="row">
            <div class="counter_content">
<!--                <h2 class="counter_title">Login Now</h2>-->
            </div>
        </div>
        <div class="counter_form">
            <div class="row fill_height">
                <div class="col fill_height">
                    <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" action="#">
                        <div class="counter_form_title">Login Now</div>
                        <input type="text" class="counter_input" placeholder="Email Address" required="required">
                        <input type="password" class="counter_input" placeholder="Password" required="required">
                        <button type="submit" class="counter_form_button">submit now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$Outline->addJS('plugins/marker_with_label/marker_with_label.js');
$Outline->addJS('js/contact.js');
$Outline->footer();
//EOF