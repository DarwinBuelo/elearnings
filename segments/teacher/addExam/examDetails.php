<?php

const TABLE_NAME = 'exams';
const TABLE_NAME_QUESTIONS = 'exams_questions';

$cid = Util::getParam('cid');
$course = Course::load($cid);
//let us now load the form to handle the exam
$submit = Util::getParam('submit');
$eid = Util::getParam('eid');
$lessonID = Util::getParam('lessonID');
$examType = Util::getParam('examType');
$question = Util::getParam('question');
$points = Util::getParam('points');
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
        $answer = $exam->getAnswer();
        $examOptions = $exam->getExamOption();
        break;
    case 'trash':
        if(!empty($eid)){
            $result = Exam::archive($eid);
            if ($result) {
                $message = ['result' => 'success', 'message' => 'Successfuly Deleted'];
            } else {
                $message = ['result' => 'error', 'message' => 'Failed to Delete'];
            }
        }
}

if (isset($submit) && !empty($submit)) {
    if (!empty($eid)) {
        //edit exam
        $exam = Exam::load($eid);
        $exam->setLessonID($lessonID);
        $exam->setExamType($examType);
        $exam->setExamQuestion($question);
        $exam->setPoints($points);
        $exam->setAnswer($answer);
        $exam->setExamOption($examOptions);
        $result = $exam->submit();
        if ($result) {
            //to be change
            $eid = null;
            $lessonID = null;
            $examType = null;
            $question = null;
            $points = null;
            $answer = null;
            $examOptions = null;
            $message = ['result' => 'success', 'message' => 'Successfully saved the exam'];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed save the Exam'];
        }
    } else {
        if (!empty($examID)) {
            $eid = null;
            $lessonID = null;
            $examType = null;
            $question = null;
            $points = null;
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
<script>
* {
    box-sizing: border-box;
}
/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</script>
<div class="modal fade" id="ExamForm" tabindex="-1" role="dialog" aria-labelledby="ExamForm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" style="width: 65vw">
            <div class="modal-header">
                <h5 class="modal-title" id="ExamForm">Exam Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="width: 65vw">

                <form action="teacher.php?page=examDetails&cid=<?= $cid ?>" method="post">
                    <div class="form-group" style="margin-left: 20px">
                        <div class="row">
                            <div class="column" style="width: 50%">
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
                                    <select name="examType" class="custom-select" onchange="exampTypeFunction()">
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
                                    <label for="question">Question</label>
                                    <textarea type="text" class="form-control" id="question" name="question"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="points">Points</label>
                                    <input type="text" class="form-control" id="points" name="points">
                                </div>
                                <div class="form-group">
                                    <label for="answer">Correct Answer</label>
                                    <input type="text" class="form-control" id="answer" name="answer">
                                </div>
                                <div class="form-group">
                                    <label for="examOptions">Choices</label>
                                    <input type="text" class="form-control" id="examOptions0" name="examOptions0">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="examOptions1" name="examOptions1">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="examOptions2" name=examOptions2">
                                </div>
                            </div>
                            <div class="column" style="margin-left: 20px">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="chooseQuestion">Questions</label>
                                    </div>
                                    <select class="custom-select" onchange="myFunction()" id="chooseQuestion" name="chooseQuestion">
                                        <option>Choose...</option>
                                        <?php
                                        $lessons = $course->getLessons();
                                        $examDetails = Exam::getExamDetails($eid);
                                        $html = null;
                                        foreach ($examDetails as $ExamDetail) {
                                            $html .= "<option value='" . $ExamDetail['exams_questions_id'] . "'>" . $ExamDetail['question'] . "</option>";
                                        }
                                        print $html;
                                        ?>

                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="lessonID">Answer</label>
                                    </div>
                                    <input type="text" class="form-control" id="editAnswer" name="editAnswer" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="answer">Choices</label>
                                    <input type="text" class="form-control" id="choice0" name="choice0" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="choice1" name="choice1" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="choice2" name="choice2" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="choice3" name="choice3" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="answer">Points</label>
                                    <input type="text" class="form-control" id="editPoints" name="editPoints" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" onclick="editFunction()" name="btnEdit">Edit</button>
                            <button type="submit" onclick="saveFunction()" class="btn btn-success" name="submit" value="save">Save</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
function myFunction()
{
    jQuery.ajax({
       cache: false,
       type:"post",
       url:"common/ajax/displayExamDetails.php",
       data:{
           examID : <?= $eid; ?>,
           examQuestionID : jQuery("#chooseQuestion").val()
       },
        dataType:'json',
       success: function (data) {
           var emailDetails = data[0];
           var choices = emailDetails.choices.split(", ");
           jQuery.each(choices, function(key, value){
               jQuery("#choice"+key).val(value);
           });
           jQuery("#editAnswer").val(emailDetails.answer);
           jQuery("#editPoints").val(emailDetails.points);
       },
       error: function(data) {
       }
    });
}
function editFunction()
{
    jQuery("form").on("submit", function (event) {
        event.preventDefault();
        if (jQuery("#editAnswer").prop("disabled") == true) {
            jQuery("#editAnswer").prop("disabled", false);
            jQuery("#editPoints").prop("disabled", false);
            for (var x=0; x<=3; x++) {
                jQuery("#choice"+x).prop("disabled", false);
            }
        } else {
            jQuery("#editAnswer").prop("disabled", true);
            jQuery("#editPoints").prop("disabled", true);
            for (var x=0; x<=3; x++) {
                jQuery("#choice"+x).prop("disabled", true);
            }
        }
    });
}
function saveFunction()
{
    jQuery("form").on("submit", function (event) {
        event.preventDefault();
        var choices = [];
        var answer = jQuery("#answer").val();
        for (var x=0; x<=2; x++) {
            choices.push(jQuery("#examOptions"+x).val());
        }
        choices.push(answer);
        jQuery.ajax({
            cache: false,
            type:"post",
            url:"common/ajax/saveExamDetails.php",
            data:{
                examID : <?= $eid; ?>,
                examType : jQuery("#examType").val(),
                points : jQuery("#points").val(),
                lessonID : jQuery("#lessonID").val(),
                question : jQuery("#question").val(),
                answer : answer,
                choices : choices,
                courseID : <?= $cid; ?>
            },
            dataType: "json",
            success: function (questionDetails) {
                jQuery("#chooseQuestion").append("<option value='"+questionDetails.examQuestionID+"'>"+questionDetails.question+"</option>");
                clearText();
            },
            error: function (data) {
            }
         });
     });
}
function clearText()
{
    jQuery("#examType").val("");
    jQuery("#points").val("");
    jQuery("#question").val("");
    jQuery("#answer").val("");
    for (var x=0; x<=2; x++) {
        jQuery("#examOptions"+x).val("");
    }
}
</script>