<?php


class Student extends User
{
    public $enrolledCourse;
    public $exams;

    public function getEnrolledCourse()
    {
        // will return the courses the the student enrolled
    }

    public function enrollIntoCourse($courseID)
    {
        // will enroll the student to a course
    }

    public function getExams($examID = null)
    {
        // will return all exams  or will return specific exam based on the ID
    }

    public function submitExamAnswer(array $answers)
    {
        // will do submit exam

    }

    public function checkExam($examID)
    {
        // will compare the exam with the correct answer from the database
    }


}