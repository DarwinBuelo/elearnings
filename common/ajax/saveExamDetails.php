<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/init.php';
const TABLE_NAME = 'exams';
const TABLE_NAME_QUESTIONS = 'exams_questions';

if (Util::getParam('save')) {
    $examData = [
        'course_id' => Util::getParam('courseID'),
        'lesson_id' => Util::getParam('lessonID'),
        'teacher_id' => Util::getParam('teacherID'),
        'title' => Util::getParam('title'),
        'duration' => Util::getParam('duration'),
        'items' => Util::getParam('items'),
        'attempts' => Util::getParam('attempts'),
        'passing_score' => Util::getParam('passingScore'),
        'exam_date' => Util::getParam('examDate'),
        'exam_due' => Util::getParam('examDue')
    ];
    Dbcon::insert(TABLE_NAME, $examData);
    unset($examData);
} else {
    $examID = Util::getParam('examID');
    $question = Util::getParam('question');
    $examType = Util::getParam('examType');
    $points = Util::getParam('points');
    $examDetails = Exam::load($examID);
    $currentPoints = (int) Exam::getTotalPoints($examID) + (int) $points;
    if ((int) $currentPoints > (int) $examDetails->getPoints()) {
        $push = [
            'items' => $examDetails->getPoints(),
            'status' => false
        ];
        echo json_encode($push);
    } else {
        $answer = (!empty(Util::getParam('answer')) ? Util::getParam('answer') : Util::getParam('booleanAnswer'));
        if (!empty($answer)) {
            if ($examType != 1) {
                $answer = (!empty(Util::getParam('answer')) ? $answer : Util::getParam('booleanAnswer'));
            }
            $choices = ($examType == 3 ? implode('//', Util::getParam('choices')) : '');
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
                'exam_type' => $examType,
                'points' => $points
            ];
            $examQuestionID = Dbcon::insert(TABLE_NAME_QUESTIONS, $dataQuestions);
            $push = [
                'examQuestionID' => $examQuestionID,
                'question' => $question
            ];
            unset($dataQuestions);
            unset($examQuestionID);
            echo json_encode($push);
        } else {
            echo json_encode(false);
        }
    }
}
//EOF