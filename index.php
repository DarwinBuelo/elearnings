<?php
include 'init.php';
$Outline->addCSS('styles/responsive.css');
$Outline->header('Home');
$Outline->navigationBar('Home');
// Only shows when you are login
if(isset($user) && !empty($user)){
    if($user->getRoleID() == 1){
        Util::redirect('admin.php');
    }
}
$courses = Course::LoadArray();
?>
    <div class="home">
        <div class="home_slider_container">

            <!-- Home Slider -->
            <div class="owl-carousel owl-theme home_slider">

                <?php
                    foreach ($courses as $Course) {
                ?>
                <!-- Home Slider Item -->
                <div class="owl-item">
                    <div class="home_slider_background" style="background-image:url(images/upload/<?= $Course->getFeatureImage(); ?>)"></div>
                    <div class="home_slider_content">
                        <div class="container">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="home_slider_form_container">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    }
                ?>
            </div>
        </div>
        <!-- Home Slider Nav -->

        <div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
        <div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
    </div>
<?php
$Outline->footer();
//EOF