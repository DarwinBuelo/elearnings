<?php
//exam
class Exam
{
    public $examID;
    public $teacherID; // id of the teacher who created the exam
    public $examQuestion;
    public $examOption; // will hold the exam option to be selected if multiple choice
    public $answer; // will hold correct answer of the exam
    public $createdDate; // date the exam was created
    public $duration; // exam duration
    public $examType;
    public $lessonID; // link to the lesson where exam is related too // will be use for the analysis of the exams

    const EXAM_TYPE_ESSAY = 1;
    const EXAM_TYPE_BOOLEAN = 2;
    const EXAM_TYPE_MULTIPLE_CHOICE = 3;

    public function getExamID(){
        return $this->examID;
    }

    public function setExamID($examID){
        $this->examID = examID;
    }

    public function getTeacherID(){
        return $this->teacherID;
    }

    public function setTeacherID($teacherID){
        $this->teacherID = $teacherID;
    }

    public function getExamQuestion(){
        return $this->examQuestion;
    }

    public function setExamQuestion($examQuestion){
       $this->examQuestion = $examQuestion;
    }

    public function getExamOption(){
        return $this->examOption;
    }

    public function setExamOption($examOption){
        $this->examOption = $examOption;
    }

    public function getAnswer(){
        return $this->answer;
    }

    public function setAnswer($answer){
        $this->answer = $answer;
    }


    public function getCreatedDate(){
        return $this->createdDate;
    }
    public function setCreatedDate($createdDate){
        $this->createdDate = $createdDate;
    }
    public function getDuration(){
        return $this->duration;
    }
    public function setDuration($duration){
        $this->duration = $duration;
    }

    public function getExamType(){
        return $this->examType;
    }

    public function setExamType($examType){
        $this->examType = $examType;
    }

    public function getLessonID(){
        $this->lessonID;
    }

    public function setLessonID($lessonID){
        $this->lessonID = $lessonID;
    }

}