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
$datetime = new DateTime(date("Y-m-d h:i:s"));

$task = Util::getParam('task');
//switch between task
switch ($task) {
    case 'edit':
        if (!empty($cid)) {
            $html = '<script>';
            $html .= 'jQuery(window).on("load",function(){';
            $html .= hideContainer();
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
function hideContainer()
{
    $html = '
        jQuery("#answerContainerSelect").hide();
        jQuery("#answerContainerText").hide();
        jQuery("#examOptions0").hide();
        jQuery("#examOptions1").hide();
        jQuery("#examOptions2").hide();
        jQuery("#labelChoice").hide();
        jQuery("#choice0").hide()
        jQuery("#choice1").hide()
        jQuery("#choice2").hide()
        jQuery("#choice3").hide()
        jQuery("#labelEditChoice").hide();
    ';
    return $html;
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
require 'segments/teacher/addExam/examDetailsHtml.php';
//EOF