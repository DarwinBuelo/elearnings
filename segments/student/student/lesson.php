<?php
$cid = Util::getParam('cid');
$course = Course::Load($cid);
$lessons = $course->getLessons();
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="row mt-3">
            <div class="col-md-6">
                <h3 class="text-center">List of Lessons for <?= $course->getCourseName() ?></h3>

                <div class="list-group list-group-flush mt-4">

                    <?php
                    $html = null;
                    foreach ($lessons as $lesson) {
                        $html .= "<a class='list-group-item list-group-item-action' href='student.php?page=lessonDetails&lid={$lesson->getLessonID()}'>{$lesson->getTitle()}";
                        $html .= "<h6 class='text-black-50'><i>{$lesson->getOverView()}</i></h6></a>";
                        $html .= "<button class='btn btn-success' style='float: right;' id='submit'>Take Exam</button>";
                    }
                    echo $html;
                    ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById("submit").onclick = function () {
        location.href = "segments/student/exam/examHtml.php";
    };
</script>
