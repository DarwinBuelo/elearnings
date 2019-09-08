<?php
$cid = Util::getParam('cid');
$course = Course::load($cid);
//let us now load the form to handle the exam
$submit = Util::getParam('submit');
$eid = Util::getParam('eid');
$lessonID = Util::getParam('lessonID');
$examType = Util::getParam('examType');
$question = Util::getParam('question');
$points = Util::getParam('points');
$duration = Util::getParam('duration');
$answer = Util::getParam('answer');
$examOptions = Util::getParam('examOptions');
$teacherID = $user->getID();
$dateCreated = date('Y-m-d');

$task = Util::getParam('task');
//switch between task
switch ($task) {
    case 'edit':
        if (!empty($cid)) {
            $html = '<script>';
            $html .= 'jQuery(window).on("load",function(){';
            $html .= 'jQuery("#ExamForm").modal("show")';
            $html .= '});';
            $html .= '</script>';
            echo $html;
        }
        //change this to exam details
        $exam = Exam::load($eid);
        $lessonID = $exam->getLessonID();
        $examType = $exam->getExamType();
        $question = $exam->getExamQuestion();
        $points = $exam->getPoints();
        $duration = $exam->getDuration();
        $answer = $exam->getAnswer();
        $examOptions = $exam->getExamOption();
        break;
}

if (isset($submit) && !empty($submit)) {
    if (!empty($eid)) {
        $exam = Exam::load($eid);
        $exam->setLessonID($lessonID);
        $exam->setExamType($examType);
        $exam->setExamQuestion($question);
        $exam->setPoints($points);
        $exam->setDuration($duration);
        $exam->setAnswer($answer);
        $exam->setExamOption($answer);
        $result = $exam->submit();
        if ($result) {
            //to be change
            $eid = null;
            $lessonID = null;
            $examType = null;
            $question = null;
            $points = null;
            $duration = null;
            $answer = null;
            $examOptions = null;
            $message = ['result' => 'success', 'message' => 'Successfully saved the exam'];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed save the Exam'];
        }
    } else {
        $data = [
            'lesson_id' => $lessonID,
            'exam_type' => $examType,
            'exam_question' => $question,
            'points' => $points,
            'duration' => $duration,
            'answer' => $answer,
            'exam_option' => $examOptions,
            'teacher_id' => $teacherID,
            'date_created' => $dateCreated

        ];
        $result = Exam::addExam($data);
        if ($result) {
            $eid = null;
            $lessonID = null;
            $examType = null;
            $question = null;
            $points = null;
            $duration = null;
            $answer = null;
            $examOptions = null;
            $message = [
                'result' => 'success',
                'message' => 'Successfully added Exam'
            ];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed added an Exam'];
        }
    }

}
// include the list of exam on the course
require 'segments/teacher/addExam/examList.php';

?>


<!-- Add exam Modal-->

<!-- Modal -->
<div class="modal fade" id="ExamForm" tabindex="-1" role="dialog" aria-labelledby="ExamForm"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ExamForm">Exam Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="teacher.php?page=examDetails&cid=<?= $cid ?>" method="post">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="hidden" name="eid" value="<?= isset($eid) ? $eid : null ?>">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="lessonID">Lesson </label>
                            </div>
                            <select class="custom-select" id="lessonID" name="lessonID">
                                <option>Choose...</option>
                                <?php
                                $lessons = $course->getLessons();
                                $html = null;
                                foreach ($lessons as $lesson) {
                                    if (isset($lessonID) && $lessonID == $lesson->getLessonID()) {
                                        $html .= "<option value='" . $lesson->getLessonID() . "' selected>" . $lesson->getTitle() . "</option>";
                                    } else {
                                        $html .= "<option value='" . $lesson->getLessonID() . "'>" . $lesson->getTitle() . "</option>";
                                    }
                                }
                                print $html;
                                ?>

                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="examType">Exam Type</label>
                            </div>
                            <select name="examType" class="custom-select">
                                <option>Choose...</option>
                                <?php
                                $types = Exam::getExamTypes();
                                $html = null;
                                foreach ($types as $key => $value) {
                                    if (isset($examType) && $examType == $key) {
                                        $html .= "<option value='" . $key . "' selected>" . $value . "</option>";
                                    } else {
                                        $html .= "<option value='" . $key . "'>" . $value . "</option>";
                                    }

                                }
                                print $html;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="question">Question:</label>
                            <input type="text" class="form-control" id="question" name="question"
                                   value="<?= isset($question) ? $question : null ?>">
                        </div>
                        <div class="form-group">
                            <label for="points">Points:</label>
                            <input type="text" class="form-control" id="points" name="points"
                                   value="<?= isset($points) ? $points : null ?>">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration: (Minutes)</label>
                            <input type="text" class="form-control" id="duration" name="duration"
                                   value="<?= isset($duration) ? $duration : null ?>">
                        </div>
                        <div class="form-group">
                            <label for="answer">Correct Answer:</label>
                            <input type="text" class="form-control" id="answer" name="answer"
                                   value="<?= isset($answer) ? $answer : null ?>">
                        </div>
                        <div class="form-group">
                            <label for="examOption">Put the choices seperated by two forward slash's (//)</label>
                            <input type="text" class="form-control" id="examOption" name="examOption"
                                   value="<?= isset($examOption) ? $examOption : null ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit" value="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End off Modal -->