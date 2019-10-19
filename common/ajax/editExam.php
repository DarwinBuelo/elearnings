<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/init.php';
const TABLE_NAME = 'exams';
const TABLE_NAME_QUESTIONS = 'exams_questions';

$question = Util::getParam('editQuestion');
$examType = Util::getParam('examType');
$choices = Util::getParam('editChoices');
$choices = ($examType == 3 ? implode('//', $choices) : '');
$answer = Util::getParam('editAnswer');
$points = Util::getParam('editPoints');
$examQuestionID = Util::getParam('examQuestionID');

$data = [
    'question' => $question,
    'choices' => $choices,
    'answer' => $answer,
    'points' => $points
];
$where = [
    'exams_questions_id' => $examQuestionID
];
Dbcon::update(TABLE_NAME_QUESTIONS, $data, $where);

$examDetails = Exam::getExamDetails(Util::getParam('examID'), null, Util::getParam('examType'), Util::getParam('lessonID'));
$html = null;
$html .= '<option>Choose...</option>';
foreach ($examDetails as $ExamDetail) {
    $html .= "<option value='" . $ExamDetail['exams_questions_id'] . "'>" . $ExamDetail['question'] . "</option>";
}
echo $html;
//EOF