<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/init.php';
$examDetails = Exam::getExamDetails(Util::getParam('examID'), null, Util::getParam('examType'), Util::getParam('lessonID'));
$html = null;
$html .= '<option>Choose...</option>';
foreach ($examDetails as $ExamDetail) {
    $html .= "<option value='" . $ExamDetail['exams_questions_id'] . "'>" . $ExamDetail['question'] . "</option>";
}
echo $html;
//EOF