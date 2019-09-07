<?php
include 'init.php';
$Outline->addCSS('plugins/colorbox/colorbox.css');
$Outline->addCSS('styles/courses.css');
$Outline->addCSS('styles/courses_responsive.css');
$Outline->header('Courses');
$Outline->navigationBar('Courses');

$courses =  Course::LoadArray();
$User = User::LoadArray();
?>
	<div class="courses">
		<div class="container">
			<div class="row">

				<!-- Courses Main Content -->
				<div class="col-lg-8">
<!--					<div class="courses_search_container">-->
                        <h2 class="section_title">Find Your Course Now</h2>
<!--						<form action="#" id="courses_search_form" class="courses_search_form d-flex flex-row align-items-center justify-content-start">-->
<!--							<input type="search" class="courses_search_input" placeholder="Search Courses" required="required">-->
<!--							<select id="courses_search_select" class="courses_search_select courses_search_input">-->
<!--								<option>All Course</option>-->
<!--                                --><?php //foreach ($courses as $Course) {?>
<!--                                    <option>--><?php //echo $Course->getCourseName(); ?><!--</option>-->
<!--                                --><?php //} ?>
<!--							</select>-->
<!--							<button action="submit" class="courses_search_button ml-auto">search now</button>-->
<!--						</form>-->
<!--					</div>-->
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
<!--											<div class="course_info">
												<i class="fa fa-star" aria-hidden="true"></i>
												<span>5 Ratings</span>
											</div>
											<div class="course_price ml-auto">P 5000</div>-->
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
<!--										<li><a href="#">2</a></li>-->
<!--										<li><a href="#">3</a></li>-->
										<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
									</ul>
<!--									<div class="courses_show_container ml-auto clearfix">-->
<!--										<div class="courses_show_text">Showing <span class="courses_showing">1-6</span> of <span class="courses_total">26</span> results:</div>-->
<!--										<div class="courses_show_content">-->
<!--											<span>Show: </span>-->
<!--											<select id="courses_show_select" class="courses_show_select">-->
<!--												<option>06</option>-->
<!--												<option>12</option>-->
<!--												<option>24</option>-->
<!--												<option>36</option>-->
<!--											</select>-->
<!--										</div>-->
<!--									</div>-->
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
$Outline->addJS('plugins/colorbox/jquery.colorbox-min.js');
$Outline->addJS('js/courses.js');
$Outline->footer();
//EOF