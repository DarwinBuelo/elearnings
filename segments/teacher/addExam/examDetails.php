<?php
$cid = Util::getParam('cid');
$course = Course::load($cid);
//let us now load the form to handle the exam

require 'segments/teacher/addExam/examList.php';
$submit = Util::getParam('submit');


if (isset($submit) && !empty($submit)) {
    $lid = Util::getParam('lid');
    $lessonTitle = Util::getParam('lessonTittle');
    $lessonOverview = Util::getParam('lessonOverview');
    $content = Util::getParam('content');
    $courseID = Util::getParam('courseID');
    $createdDate = date('Y-m-d');

    if (!empty($lid)) {
        $lesson = Lesson::load($lid);
        $lesson->setTitle($lessonTitle);
        $lesson->setOverView($lessonOverview);
        $lesson->setContent($content);
        $lesson->setCourseID($courseID);
        $result = $lesson->submit();
        if ($result) {
            $lid = null;
            $lessonTitle = null;
            $lessonOverview = null;
            $content = null;
            $courseID = null;
            $message = ['result' => 'success', 'message' => 'Successfuly saved the lesson "' . $lessonTitle . '"'];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed save the Lesson'];
        }
    } else {
        $data = [
            'title' => $lessonTitle,
            'overview' => $lessonOverview,
            'content' => $content,
            'course_id' => $courseID,
            'date_created' => $createdDate
        ];
        $result = Lesson::addLesson($data);
        if ($result) {
            $lid = null;
            $lessonTitle = null;
            $lessonOverview = null;
            $content = null;
            $courseID = null;
            $message = [
                'result' => 'success',
                'message' => 'Successfully added a Lesson with a title "' . $lessonTitle . '"'
            ];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed added a Lesson'];
        }
    }


}


if (!empty($lid)) {
    $lesson = Lesson::load($lid);
    $lessonTitle = $lesson->getTitle();
    $lessonOverview = $lesson->getOverView();
    $content = $lesson->getContent();
    $courseID = $lesson->getCourseID();
}
?>


<!-- Add exam Modal-->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (!empty($message) && $message['result'] == 'failed'): ?>
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
                <form action="teacher.php?page=addExam" method="post">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="hidden" name="examID" value="<?= isset($eid) ? $eid : null ?>">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="lessonID">Lesson </label>
                            </div>
                            <select class="custom-select" id="lessonID" name="lessonID">
                                <option>Choose...</option>
                                <?php
                                $lessons = $course->getLessons();
                                $html = null;
                                foreach ($lessons as $lesson) {
                                    $html .= "<option value='" . $lesson->getLessonID() . "'>" . $lesson->getTitle() . "</option>";
                                }
                                print $html;
                                ?>

                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="hidden" name="lid" value="<?= isset($lid) ? $lid : null ?>">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="lessonID">Exam Type</label>
                            </div>
                            <select name="examType" class="custom-select">
                                <option>Choose...</option>
                                <?php
                                    $types= Exam::getExamTypes();
                                    $html = null;
                                    foreach ($types as $key => $value){
                                        $html .= "<option value='" . $key . "'>" . $value. "</option>";
                                    }
                                    print $html;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="question">Question:</label>
                            <input type="text" class="form-control" id="question" name="question"
                                   value="<?= isset($lessonTitle) ? $lessonTitle : null ?>">
                        </div>
                        <div class="form-group">
                            <label for="lessonOverview">Put the choices seperated by two forward slash's (//)</label>
                            <input type="text" class="form-control" id="lessonOverview" name="lessonOverview"
                                   value="<?= isset($lessonOverview) ? $lessonOverview : null ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right" name="submit" value="save">
                        Save
                    </button>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End off Modal -->