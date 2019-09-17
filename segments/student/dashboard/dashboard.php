<?php
$Courses = Course::LoadArray();

$User = unserialize($_SESSION['user']);
$coursesEnrolled = $user->getCoursesEnrolled();
foreach($coursesEnrolled as $key => $value ){
    unset($Courses[$key]);
}

$html = '';
$html .= "<div class='row'>";
$html .= "<div class='col-md-12 text-center'><h3>Courses Offered</h3></div></div>";
$html .= "<div class='row'><div class='col-md-12 text-center'></div></div><div class='row'><div class='col-md-12'>";
echo $html;
$html ='';
$openHash = Util::getParam('message');
$message = isset($_SESSION['message'][$openHash])?$_SESSION['message'][$openHash]:null;
?>
<?php
 if (!empty($message) && $message['result'] == 'failed'): ?>
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Failed</span>
        <?= $message['message'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php elseif (!empty($message) && $message['result'] == 'success'): ?>
    <div class="sufee-alert alert with-close alert-success  alert-dismissible fade show">
        <span class="badge badge-pill badge-success ">Success</span>
        <?= $message['message'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>

<?php
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
                        <a href ="process.php?task=enrollToCourse&cid=<?= $course->getCourseID()?>" class="btn-sm btn-success">Enroll Now</a>
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
