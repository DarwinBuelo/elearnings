<?php
include 'init.php';
$Outline->header('Login');
?>
<div class="counter">
    <div class="counter_background" style="background-image:url(images/counter_background.jpg)"></div>
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
                        <div class="counter_form_title">Login Form</div>
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
$Outline->footer();
//EOF