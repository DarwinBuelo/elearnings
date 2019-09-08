<?php
$Courses = Course::LoadArray();

$html = '';
$html .= "<div class='row'>";
$html .= "<div class='col-md-12 text-center'><h3>Courses Offered</h3></div></div>";
$html .= "<div class='row'><div class='col-md-12 text-center'></div></div><div class='row'><div class='col-md-12'>";
echo $html;
foreach ($Courses as $course) {
    $fImg = !empty($course->getFeatureImage()) ? $course->getFeatureImage() : 'logo.png';
    ?>
    <div class="col-lg-4 col-md-6">
        <section class="card">
                <img class="wtt-mark bg-flat-color-2" src="images/upload/<?= $fImg ?>">
                <div class="col-md-12 bg-flat-color-1">
                    <div class="media-body">
                        <h3 class="text-white"><?= $course->getCourseName()?></h3>
                        <p class="text-light"><?= $course->getDesc()?></p>
                    </div>
                </div>

            <div class="weather-category twt-category">
                <ul class="text-dark">
                    <li>
                        <h5><?= $course->getStudents() ? count($course->getStudents()): 0; ?></h5>
                        Students
                    </li>
                    <li>
                        <h5><?= count($course->getLessons()); ?></h5>
                        Lessons
                    </li>
                    <li>
                        <button class="btn-sm btn-success">Enroll Now</button>
                    </li>
                </ul>
            </div>

        </section>
    </div>

    <?php
}

$html .= "</div></div>";
echo $html;
?>
