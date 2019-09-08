<?php
require 'init.php';
require 'segments/admin/adminSettings.php';
$adminOutline->addCSS('plugins/colorbox/colorbox.css');
$adminOutline->addCSS('styles/courses.css');
$adminOutline->addCSS('styles/courses_responsive.css');
require 'segments/student/sidebar.php';
require 'segments/student/rightPanel.php';
$adminOutline->header('Student Panel');
$courses =  Course::LoadArray();
$User = User::LoadArray();
?>
    <div class="courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="section_title">Courses Enrolled</h2>
                    <div class="courses_container">
                        <div class="row courses_row">

                            <?php foreach ($courses as $Course) { ?>
                                <!-- Course -->
                                <div class="col-lg-6 course_col">
                                    <div class="course">
                                        <div class="course_image"><img src="images/upload/<?= $Course->getFeatureImage();?>" alt=""></div>
                                        <div class="course_body">
                                            <h3 class="course_title"><a href="course.php?courseID=<?= $Course->getCourseID(); ?>"><?= $Course->getCourseName(); ?></a></h3>
                                            <div class="course_teacher"><?= $User[$Course->getCreatorID()]->getName().' '.$User[$Course->getCreatorID()]->getSurname(); ?></div>
                                            <div class="course_text">
                                                <p><?= $Course->getDesc(); ?></p>
                                            </div>
                                        </div>
                                        <div class="course_footer">
                                            <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
                                                <div class="course_info">
                                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                                    <span><?= (!empty(Student::getEnrolledStudentCount($Course->getCourseID())) ? Student::getEnrolledStudentCount($Course->getCourseID()) : 0); ?> Student</span>
                                                </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="row pagination_row">
                            <div class="col">
                                <div class="pagination_container d-flex flex-row align-items-center justify-content-start">
                                    <ul class="pagination_list">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                    </ul>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses Sidebar -->
                <div style="position: -webkit-sticky;" class="col-lg-4">
                    <div class="sidebar">

                        <!-- Categories -->
                        <div class="sidebar_section">
                            <div class="sidebar_section_title">Courses</div>
                            <div class="sidebar_categories">
                                <ul>
                                    <?php foreach ($courses as $Course) { ?>
                                        <li><a href="course.php?courseID=<?= $Course->getCourseID(); ?>"><?php echo $Course->getCourseName();?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$adminOutline->addJS('plugins/colorbox/jquery.colorbox-min.js');
$adminOutline->addJS('js/courses.js');
//EOF