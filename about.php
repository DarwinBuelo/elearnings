<?php
include 'init.php';
$Outline->addCSS('plugins/colorbox/colorbox.css');
$Outline->addCSS('styles/about.css');
$Outline->addCSS('styles/about_responsive.css');
$Outline->header('About');
$Outline->navigationBar('About');
?>
	<!-- About -->

	<div class="about">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<h2 class="section_title">Welcome To PiaGotsky E-Learning</h2>
						<div class="section_subtitle"><p>unleash every child's GENIUS</p></div>
					</div>
				</div>
			</div>
			<div class="row about_row">
				
				<!-- About Item -->
				<div class="col-lg-4 about_col about_col_left">
					<div class="about_item">
						<div class="about_item_image"><img src="images/piagotsky.jpg" alt=""></div>
						<div class="about_item_title"><a href="#">Our Stories</a></div>
						<div class="about_item_text">
							<p>Temporary Stories.</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php
$Outline->addJS('plugins/colorbox/jquery.colorbox-min.js');
$Outline->addJS('js/about.js');
$Outline->footer();
//EOF