<?php
include 'init.php';
$Outline->addCSS('styles/responsive.css');
$Outline->header('Home');
// Only shows when you are login
if(isset($user) && !empty($user)){
    if($user->getRoleID() == 1){
        Util::redirect('admin.php');
    }
}
?>
    <div class="home">
        <div class="home_slider_container">

            <!-- Home Slider -->
            <div class="owl-carousel owl-theme home_slider">

                <!-- Home Slider Item -->
                <div class="owl-item">
                    <div class="home_slider_background" style="background-image:url(images/piagotsky.jpg)"></div>
                    <div class="home_slider_content">
                        <div class="container">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="home_slider_title">Welcome To PiaGotsky E-Learning</div>
                                    <div class="home_slider_subtitle">unleash every child's GENIUS</div>
                                    <div class="home_slider_form_container">
                                        <form action="#" id="home_search_form_1" class="home_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between">
                                            <div class="d-flex flex-row align-items-center justify-content-start">
                                                <input type="search" class="home_search_input" placeholder="Keyword Search" required="required">
                                                <select class="dropdown_item_select home_search_input">
                                                    <option>Category Courses</option>
                                                    <option>Category</option>
                                                    <option>Category</option>
                                                </select>
                                                <select class="dropdown_item_select home_search_input">
                                                    <option>Select Price Type</option>
                                                    <option>Price Type</option>
                                                    <option>Price Type</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="home_search_button">search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
$Outline->footer();
//EOF