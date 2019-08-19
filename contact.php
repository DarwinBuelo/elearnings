<?php
include 'init.php';
$Outline->addCSS('plugins/video-js/video-js.css');
$Outline->addCSS('styles/contact.css');
$Outline->addCSS('styles/contact_responsive.css');
$Outline->header('Contact');
$Outline->navigationBar('Contact');
?>
<!-- Contact -->

<div class="contact">
    <!-- Contact Info -->

    <div class="contact_info_container">
        <div class="container">
            <div class="row">

                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="contact_form">
                        <div class="contact_info_title">Contact Form</div>
                        <form action="#" class="comment_form">
                            <div>
                                <div class="form_title">Name</div>
                                <input type="text" class="comment_input" required="required">
                            </div>
                            <div>
                                <div class="form_title">Email</div>
                                <input type="text" class="comment_input" required="required">
                            </div>
                            <div>
                                <div class="form_title">Message</div>
                                <textarea class="comment_input comment_textarea" required="required"></textarea>
                            </div>
                            <div>
                                <button type="submit" class="comment_button trans_200">submit now</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-6">
                    <div class="contact_info">
                        <div class="contact_info_title">Contact Info</div>
                        <div class="contact_info_text">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a distribution of letters.</p>
                        </div>
                        <div class="contact_info_location">
                            <div class="contact_info_location_title">Legazpi City</div>
                            <ul class="location_list">
                                <li>Casa Erin bldg 2, Rizal St. Cabangan, Legazpi City</li>
                                <li>742-6741</li>
                                <li>piagotsky2017@gmail.com</li>
                            </ul>
                        </div>
                    </div>
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