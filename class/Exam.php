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
    protected $points;

    const EXAM_TYPE_ESSAY = 1;
    const EXAM_TYPE_BOOLEAN = 2;
    const EXAM_TYPE_MULTIPLE_CHOICE = 3;
    const EXAM_TYPE_FILL_IN_THE_BLANK = 4;

    const TABLE_NAME = 'exams';

    public static function loadArray(array $eids = null, $archived = false)
    {
        if (empty($eids)) {
            $query = "SELECT 
                        exam_id
                     FROM
                        exams
                     WHERE
                        true";
            if (!$archived) {
                $query .= " AND remove = 0";
            }
            $result = DBcon::execute($query);
            $eids = DBcon::fetch_array($result);
        }

        //get the data
        $exams = [];
        if (!empty($eids)) {
            foreach ($eids as $id) {
                $exams[$id] = self::load($id);
            }
            return $exams;
        } else {
            return false;
        }

    }

    public static function load($eid)
    {
        $query = "SELECT 
                        e.exam_id,
                        e.teacher_id,
                        e.exam_question,
                        e.exam_option,
                        e.answer,
                        e.date_created,
                        e.duration,
                        e.exam_type,
                        e.lesson_id,
                        e.points
                   FROM
                        exams as e
                   WHERE
                        e.exam_id = {$eid}";
        $result = DBcon::execute($query);
        $data = Dbcon::fetch_assoc($result);
        $exam = new self();
        $exam->setExamID($data['exam_id']);
        $exam->setTeacherID($data['teacher_id']);
        $exam->setExamQuestion($data['exam_question']);
        $exam->setExamOption($data['exam_option']);
        $exam->setAnswer($data['answer']);
        $exam->setCreatedDate($data['date_created']);
        $exam->setDuration($data['duration']);
        $exam->setExamType($data['exam_type']);
        $exam->setLessonID($data['lesson_id']);
        $exam->setPoints($data['points']);
        return $exam;
    }

    public static function getExamTypes($examType = null)
    {
        $data = null;
        if (!empty($examType)) {
            switch ($examType) {
                case self::EXAM_TYPE_ESSAY:
                    $data[self::EXAM_TYPE_ESSAY] = "Essay";
                    break;
                case self::EXAM_TYPE_BOOLEAN:
                    $data[self::EXAM_TYPE_BOOLEAN] = "Boolean";
                    break;
                case self::EXAM_TYPE_FILL_IN_THE_BLANK:
                    $data[self::EXAM_TYPE_FILL_IN_THE_BLANK] = "Fill in the blank";
                    break;
                case self::EXAM_TYPE_MULTIPLE_CHOICE:
                    $data[self::EXAM_TYPE_MULTIPLE_CHOICE] = "Multiple Choice";
                    break;
            }
        } else {
            $data = [
                self::EXAM_TYPE_ESSAY => "Essay",
                self::EXAM_TYPE_BOOLEAN => "Boolean",
                self::EXAM_TYPE_FILL_IN_THE_BLANK => "Fill in the blank",
                self::EXAM_TYPE_MULTIPLE_CHOICE => "Multiple Choice"
            ];
        }
        return $data;
    }

    public static function addExam(array $data)
    {
        if (is_array($data) && count($data) > 0) {
            DBcon::insert(self::TABLE_NAME, $data);
            return true;
        }
    }

    /**
     * Submit the object for updating
     * @return bool|mysqli_result
     */
    public function submit()
    {
        //will submit the exam
        $data = [
            'teacher_id' => $this->getTeacherID(),
            'exam_question' => $this->getExamQuestion(),
            'exam_option' => $this->getExamOption(),
            'answer' => $this->getAnswer(),
            'duration' => $this->getDuration(),
            'exam_type' => $this->getExamType(),
            'lesson_id' => $this->getLessonID(),
            'points' => $this->getPoints(),
        ];

        $where = ['exam_id' => $this->getExamID()];
        $result = DBcon::update(self::TABLE_NAME, $data, $where);
        return $result;
    }

    public static function archive(int $eid)
    {
        $data = ['remove' => 1];
        $where = ['exam_id' => $eid];
        Dbcon::update(self::TABLE_NAME, $data, $where);
    }

    public function getExamID()
    {
        return $this->examID;
    }

    public function setExamID($examID)
    {
        $this->examID = $examID;
    }

    public function getTeacherID()
    {
        return $this->teacherID;
    }

    public function setTeacherID($teacherID)
    {
        $this->teacherID = $teacherID;
    }

    public function getExamQuestion()
    {
        return $this->examQuestion;
    }

    public function setExamQuestion($examQuestion)
    {
        $this->examQuestion = $examQuestion;
    }

    public function getExamOption()
    {
        return $this->examOption;
    }

    public function setExamOption($examOption)
    {
        $this->examOption = $examOption;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getExamType()
    {
        return $this->examType;
    }

    public function setExamType($examType)
    {
        $this->examType = $examType;
    }

    public function getLessonID()
    {
        return $this->lessonID;
    }

    public function setLessonID($lessonID)
    {
        $this->lessonID = $lessonID;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }
}