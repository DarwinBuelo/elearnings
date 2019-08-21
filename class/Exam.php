<?php
//exam
class Exam
{
    public $examID;
    public $examQuestion;
    public $examType;
    public $examAnswer;

    const EXAM_TYPE_ESSAY = 1;
    const EXAM_TYPE_BOOLEAN = 2;
    const EXAM_TYPE_MULTIPLE_CHOICE = 3;

    public function getExamID(){
        return $this->examID;
    }

    public function setExamID($examID){
        $this->examID = $examID;
    }

    public function getExamQuestion(){
        return $this->examQuestion;
    }

    public function setExamQuestion($examQuestion){
       $this->examQuestion = $examQuestion;
    }

    public function getExamType(){
        return $this->examType;
    }

    public function setExamType($examType){
        $this->examType = $examType;
    }

}