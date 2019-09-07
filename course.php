<?php
include 'init.php';
$Outline->addCSS('plugins/colorbox/colorbox.css');
$Outline->addCSS('styles/course.css');
$Outline->addCSS('styles/course_responsive.css');
$Outline->header('Courses');
$Outline->navigationBar('Courses');

$courseID = Util::getParam('courseID');
$Course =  Course::load($courseID);
$User = User::LoadArray();
$lessons = $Course->getLessons();
?>
<!-- Course -->

	<div class="course">
		<div class="container">
			<div class="row">

				<!-- Course -->
				<div class="col-lg-8">
					
					<div class="course_container">
						<div class="course_title"><?= $Course->getCourseName(); ?></div>
						<div class="course_info d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">

							<!-- Course Info Item -->
							<div class="course_info_item">
								<div class="course_info_title">Teacher: </div>
								<div class="course_info_text"><a href="#"><?= $User[$Course->getCreatorID()]->getName().' '.$User[$Course->getCreatorID()]->getSurname();?></a></div>
							</div>

							<!-- Course Info Item -->
							<div class="course_info_item">
								<div class="course_info_title">Course Code:</div>
								<div class="course_info_text"><?= $Course->getCourseCode(); ?></div>
							</div>

							<!-- Course Info Item -->
							<div class="course_info_item">
								<div class="course_info_title">Units:</div>
								<div class="course_info_text"><a href="#"><?= $Course->getUnits(); ?></a></div>
							</div>

						</div>

						<!-- Course Image -->
						<div class="course_image"><img src="images/piagotsky.jpg" alt=""></div>

						<!-- Course Tabs -->
						<div class="course_tabs_container">
							<div class="tabs d-flex flex-row align-items-center justify-content-start">
								<div class="tab active">description</div>
								<div class="tab">curriculum</div>
							</div>
							<div class="tab_panels">

								<!-- Description -->
								<div class="tab_panel active">
									<div class="tab_panel_title"><?= $Course->getCourseName(); ?></div>
									<div class="tab_panel_content">
										<div class="tab_panel_text">
											<p><?= $Course->getDesc(); ?></p>
										</div>
										<div class="tab_panel_section">
											<div class="tab_panel_subtitle">Requirements</div>
											<ul class="tab_panel_bullets">
												<li>-------..</li>
												<li>-------..</li>
												<li>-------..</li>
												<li>-------.</li>
											</ul>
										</div>
									</div>
								</div>

								<!-- Curriculum -->
								<div class="tab_panel tab_panel_2">
									<div class="tab_panel_content">
										<div class="tab_panel_title"><?= $Course->getCourseName(); ?></div>
										<div class="tab_panel_content">
											<div class="tab_panel_text">
												<p><?= $Course->getDesc(); ?></p>
											</div>

											<!-- Dropdowns -->
                                            <?php $x=1; foreach ($lessons as $Lesson) { ?>
											<ul class="dropdowns">
												<li class="has_children">
													<div class="dropdown_item">
														<div class="dropdown_item_title"><span>Lecture <?= $x?>:</span> <?= $Lesson->getTitle(); ?></div>
														<div class="dropdown_item_text">
<!--															<p>-------.</p>-->
														</div>
													</div>
													<ul>
														<li>
															<div class="dropdown_item">
																<div class="dropdown_item_title"><span></span> Overview</div>
																<div class="dropdown_item_text">
																	<p><?= $Lesson->getOverView(); ?></p>
																</div>
															</div>
														</li>
<!--														<li>-->
<!--															<div class="dropdown_item">-->
<!--																<div class="dropdown_item_title"><span>Lecture 1.2:</span> Java Programming</div>-->
<!--																<div class="dropdown_item_text">-->
<!--																	<p>-------.</p>-->
<!--																</div>-->
<!--															</div>-->
<!--														</li>-->
													</ul>
												</li>
											</ul>
                                        <?php $x++; } ?>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<!-- Course Sidebar -->
				<div class="col-lg-4">
					<div class="sidebar">

						<!-- Feature -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Course Feature</div>
							<div class="sidebar_feature">
<!--								<div class="course_price">P 5000</div>-->

								<!-- Features -->
								<div class="feature_list">

									<!-- Feature -->
									<div class="feature d-flex flex-row align-items-center justify-content-start">
										<div class="feature_title"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Duration:</span></div>
										<div class="feature_text ml-auto"><?= $Course->getUnits(); ?> weeks</div>
									</div>

									<!-- Feature -->
									<div class="feature d-flex flex-row align-items-center justify-content-start">
										<div class="feature_title"><i class="fa fa-file-text-o" aria-hidden="true"></i><span>Lectures:</span></div>
										<div class="feature_text ml-auto"><?= Lesson::getLessonCount($Course->getCourseID()); ?></div>
									</div>

									<!-- Feature -->
<!--									<div class="feature d-flex flex-row align-items-center justify-content-start">-->
<!--										<div class="feature_title"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span>Lectures:</span></div>-->
<!--										<div class="feature_text ml-auto">6</div>-->
<!--									</div>-->

									<!-- Quizzes -->
									<div class="feature d-flex flex-row align-items-center justify-content-start">
										<div class="feature_title"><i class="fa fa-list-alt" aria-hidden="true"></i><span>Quizzes:</span></div>
										<div class="feature_text ml-auto"><?= Course::getExamsCount($Course->getCourseID()); ?></div>
									</div>

									<!-- Feature -->
									<div class="feature d-flex flex-row align-items-center justify-content-start">
										<div class="feature_title"><i class="fa fa-users" aria-hidden="true"></i><span>Students:</span></div>
										<div class="feature_text ml-auto"><?= (!empty(Student::getEnrolledStudentCount($Course->getCourseID())) ? Student::getEnrolledStudentCount($Course->getCourseID()) : 0); ?></div>
									</div>

								</div>
							</div>
						</div>

						<!-- Feature -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Teacher</div>
							<div class="sidebar_teacher">
								<div class="teacher_title_container d-flex flex-row align-items-center justify-content-start">
									<div class="teacher_image"><img src="images/tempPic.png" alt=""></div>
									<div class="teacher_title">
										<div class="teacher_name"><a href="#"><?= $User[$Course->getCreatorID()]->getName().' '.$User[$Course->getCreatorID()]->getSurname();?></a></div>
										<div class="teacher_position">Professor</div>
									</div>
								</div>
								<div class="teacher_meta_container">
									<!-- Teacher Rating -->
									<div class="teacher_meta d-flex flex-row align-items-center justify-content-start">
										<div class="teacher_meta_title">Average Rating:</div>
										<div class="teacher_meta_text ml-auto"><span>4.7</span><i class="fa fa-star" aria-hidden="true"></i></div>
									</div>
									<!-- Teacher Review -->
									<div class="teacher_meta d-flex flex-row align-items-center justify-content-start">
										<div class="teacher_meta_title">Review:</div>
										<div class="teacher_meta_text ml-auto"><span>12k</span><i class="fa fa-comment" aria-hidden="true"></i></div>
									</div>
									<!-- Teacher Quizzes -->
									<div class="teacher_meta d-flex flex-row align-items-center justify-content-start">
										<div class="teacher_meta_title">Quizzes:</div>
										<div class="teacher_meta_text ml-auto"><span><?= Course::getExamsCount($Course->getCourseID()); ?></span><i class="fa fa-user" aria-hidden="true"></i></div>
									</div>
								</div>
								<div class="teacher_info">
									<p>Email: <?= $User[$Course->getCreatorID()]->getEmail();?></p>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$Outline->addJS('plugins/colorbox/jquery.colorbox-min.js');
$Outline->addJS('js/course.js');
$Outline->footer();
//EOF