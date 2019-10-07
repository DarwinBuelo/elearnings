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
                    $html = [];
                    $x=0;
                    foreach ($lessons as $lesson) {
                        $html[] = "<a class='list-group-item list-group-item-action' href='student.php?page=lessonDetails&lid={$lesson->getLessonID()}'>{$lesson->getTitle()}";
                        $html[] = "<h6 class='text-black-50'><i>{$lesson->getOverView()}</i></h6></a>";
                        $examID = Exam::isExamDate($lesson->getLessonID());
                        if (!empty($examID)) {
                            $html[] = "<button class='btn btn-success btnSubmit' style='float: right;' value='".$examID."' id='submit".$x."'>Take Exam</button>";
                        } else {
                            $html[] = "<button class='btn btn-dark' style='float: right;' id='submit' disabled>Take Exam</button>";
                        }
                    }
                    echo implode('', $html);
                    ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.btnSubmit').on('click', function(){
            jQuery.ajax({
                cache: false,
                type: "post",
                url: "common/ajax/examSession.php",
                data: {
                    examID: jQuery(".btnSubmit").val()
                },
                dataType: "json",
                success: function (data) {
                    if (data == false) {
                        alert('Already reached maximum attempts');
                    } else {
                        location.href = "student.php?page=exam";
                    }
                },
                error: function (data) {
                }
            });
        });
    });
</script>
