<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'init.php';
const TABLE_NAME = 'exams';
const TABLE_NAME_QUESTIONS = 'exams_questions';
$examID = Util::getParam('examID');
$question = Util::getParam('question');
$choices = (Util::getParam('examType') == 3 ? implode(', ', Util::getParam('choices')) : '');
$answer = (!empty(Util::getParam('answer')) ? Util::getParam('answer') : Util::getParam('booleanAnswer'));
$data = [
    'lesson_id' => Util::getParam('lessonID'),
    'exam_type' => Util::getParam('examType'),
    'teacher_id' => $user->getID(),
    'date_created' => date('Y-m-d'),
    'course_id' => Util::getParam('courseID')

];
if (empty($examID)) {
    $examID = Dbcon::insert(TABLE_NAME, $data);
}
$dataQuestions = [
    'exam_id' => $examID,
    'question' => $question,
    'choices' => $choices,
    'answer' => $answer,
    'points' => Util::getParam('points')
];
$examQuestionID = Dbcon::insert(TABLE_NAME_QUESTIONS, $dataQuestions);
$push = [
    'examQuestionID' => $examQuestionID,
    'question' => $question
];
echo json_encode($push);
//EOF