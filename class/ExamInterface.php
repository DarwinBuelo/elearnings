<?php

class ExamInterface
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

    const TABLE_NAME = 'exams';
    const TABLE_NAME_QUESTIONS = 'exams_questions';
    const TABLE_LESSON = 'lessons';
    const TABLE_STUDENT_EXAM = 'student_exam';
    const TABLE_STUDENT_EXAM_ANSWER = 'student_exam_answer';
    const TABLE_REGISTERED_USER = 'registered_user';
    
    public static function getExamPassFail($eid){
        $sql = '
            SELECT
                e.exam_id,
                e.score,
                e.remarks,
                ru.student_name
            FROM
                student_exam as e
            LEFT JOIN
                registered_user as ru
            USING
                (student_id)
            WHERE
                e.exam_id = '.$eid;
        
        $obj = DBcon::execute($sql);
        
        return DBcon::fetch_all_assoc($obj);
    }

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

     public static function getRemarksCount($eid,$remarks)
    {
        $sql = "
            SELECT
                count(*)
            FROM
                ".self::TABLE_STUDENT_EXAM." se
            INNER JOIN
                ".self::TABLE_NAME." e
            ON
                se.exam_id = e.exam_id
            WHERE
               e.exam_id= {$eid}
            AND
                se.remarks = {$remarks}
        ";
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_array($result);
        return (int) $data[0];
    }

    public static function load($eid)
    {
        $query = "SELECT
                        e.exam_id,
                        e.teacher_id,
                        e.date_created,
                        e.duration,
                        e.lesson_id,
                        e.items
                   FROM
                        exams as e
                   WHERE
                        e.exam_id = {$eid}";
        $result = Dbcon::execute($query);
        $data = Dbcon::fetch_assoc($result);
        $exam = new static();
        $exam->setExamID($data['exam_id']);
        $exam->setTeacherID($data['teacher_id']);
        $exam->setCreatedDate($data['date_created']);
        $exam->setDuration($data['duration']);
        $exam->setLessonID($data['lesson_id']);
        $exam->setPoints($data['items']);
        return $exam;
    }

    public static function getTotalPoints($examID)
    {
        $sql = "
            SELECT
                sum(eq.points) as totalPoints
            FROM
                ".self::TABLE_NAME_QUESTIONS." eq
            WHERE
                eq.exam_id = {$examID}
        ";
        $result = Dbcon::execute($sql);
        return Dbcon::fetch_assoc($result)['totalPoints'];
    }

    public static function getExams($courseID)
    {
        $sql = "
            SELECT
                e.exam_id,
                e.items,
                e.duration,
                e.title as examTitle,
                l.title
            FROM
                ".static::TABLE_NAME." e
            INNER JOIN
                ".static::TABLE_LESSON." l
            ON
                e.lesson_id = l.lesson_id
            LEFT JOIN
                ".static::TABLE_NAME_QUESTIONS." eq
            ON
                eq.exam_id = e.exam_id
            WHERE
                e.remove = 0
        ";
        if (!empty($courseID)) {
            $sql .= "
                AND
                    e.course_id = {$courseID}
            ";
        }
        $sql .= "
            GROUP BY
                e.exam_id
        ";
        $result = Dbcon::execute($sql);
        return Dbcon::fetch_all_assoc($result);
    }

    public static function isExamDate($lessonID = null)
    {
        $sql = "
            SELECT
                e.exam_id
            FROM
                ".static::TABLE_NAME." e
            INNER JOIN
                ".static::TABLE_LESSON." l
            ON
               e.lesson_id = l.lesson_id
            INNER JOIN
                ".static::TABLE_NAME_QUESTIONS." eq
            ON
                e.exam_id = eq.exam_id
            WHERE
                e.exam_date
            BETWEEN
                e.exam_date AND now()
            AND
                now() < e.exam_due
        ";
        if (!empty($lessonID)) {
            $sql .= "
                AND
                    e.lesson_id = {$lessonID}
            ";
        }
        $sql .= "
            GROUP BY
                e.exam_id
        ";
        $result = Dbcon::execute($sql);
        $return = Dbcon::fetch_assoc($result)['exam_id'];
        return (!empty($return) ? $return : false);
    }

    public static function getExamDetails($examID = null, $examQuestionID = null, $examType = null, $lessonID = null)
    {
        $sql = "
            SELECT
                eq.exams_questions_id,
                eq.exam_id,
                eq.question,
                eq.choices,
                eq.answer,
                eq.points,
                eq.exam_type
            FROM
                ".static::TABLE_NAME_QUESTIONS." eq
            INNER JOIN
                ".static::TABLE_NAME." e
            ON
                e.exam_id = eq.exam_id
            WHERE
                TRUE
        ";
        if (!empty($examID)) {
            $sql .= "
                AND
                    e.exam_id = {$examID}
            ";
        }
        if (!empty($examQuestionID)) {
            $sql .= "
                AND
                    eq.exams_questions_id = {$examQuestionID}
            ";
        }
        if (!empty($examType)) {
            $sql .= "
                AND
                    eq.exam_type = {$examType}
            ";
        }
        if (!empty($lessonID)) {
            $sql .= "
                AND
                    e.lesson_id = {$lessonID}
            ";
        }
        $sql .= "
            ORDER BY
                RAND()
        ";
        $result = Dbcon::execute($sql);
        return Dbcon::fetch_all_assoc($result);
    }

    public static function getScore($studentID = null, $examID)
    {
        $sql = "
            SELECT
                sum(eq.points) as score
            FROM
                ".self::TABLE_NAME_QUESTIONS." eq
            INNER JOIN
                ".self::TABLE_STUDENT_EXAM_ANSWER." ea
            ON
                ea.exams_questions_id = eq.exams_questions_id
            INNER JOIN
                ".self::TABLE_STUDENT_EXAM." se
            ON
                se.student_exam_id = ea.student_exam_id
            WHERE
                ea.status = 1
            AND
                se.exam_id = {$examID}
         ";
        if (!empty($studentID)) {
            $sql .= "
                AND
                    se.student_id = {$studentID}
            ";
        }
        $result = Dbcon::execute($sql);
        $return = Dbcon::fetch_assoc($result)['score'];
        return $return;
    }

    public static function getAttempts($studentID, $examID)
    {
        if (self::studentExist($studentID, $examID) == false) {
            return true;
        } else {
            $sql = "
                SELECT
                    e.attempts
                FROM
                    ".self::TABLE_NAME." e
                INNER JOIN
                    ".self::TABLE_STUDENT_EXAM." se
                ON
                    e.exam_id = se.exam_id
                WHERE
                    se.student_id = {$studentID}
                AND
                    e.exam_id = {$examID}
                AND
                    e.attempts > se.attempts
            ";
            $result = Dbcon::execute($sql);
            $return = Dbcon::fetch_assoc($result)['attempts'];
            return (!empty($return) ? true : false);
        }
    }

    public static function getStudentAttempts($studentExamID)
    {
        $sql = "
            SELECT
                attempts
            FROM
                ".self::TABLE_STUDENT_EXAM."
            WHERE
                student_exam_id = {$studentExamID}
        ";
        $result = Dbcon::execute($sql);
        return Dbcon::fetch_assoc($result)['attempts'];
    }

    public static function getPassingScore($examID)
    {
        $sql = "
            SELECT
                e.passing_score
            FROM
                ".self::TABLE_NAME." e
            WHERE
                exam_id = {$examID}
        ";
        $result = Dbcon::execute($sql);
        return Dbcon::fetch_assoc($result)['passing_score'];
    }

    public static function resetExam($studentExamID)
    {
        Dbcon::delete(self::TABLE_STUDENT_EXAM_ANSWER, $studentExamID);
    }

    public static function studentExist($studentID, $examID)
    {
        $sql = "
            SELECT
                student_exam_id
            FROM
                ".self::TABLE_STUDENT_EXAM."
            WHERE
                student_id = {$studentID}
            AND
                exam_id = {$examID}
        ";
        $result = Dbcon::execute($sql);
        $return = Dbcon::fetch_assoc($result)['student_exam_id'];
        return (!empty($return) ? $return : false);
    }

    public static function incrementAttempts($studentExamID)
    {
        $sql = "
            UPDATE
                ".self::TABLE_STUDENT_EXAM."
            SET
                attempts = attempts + 1
            WHERE
                student_exam_id = {$studentExamID}
        ";
        Dbcon::execute($sql);
    }

    public static function getStudentAnalysis($studentID)
    {
        $sql = "
            SELECT
                se.student_exam_id,
                se.student_id,
                se.exam_id,
                se.start_time,
                se.end_time,
                se.score,
                se.attempts,
                se.remarks,
                l.title as lessonTitle,
                e.title as examTitle,
                e.items,
                ru.contact_no
            FROM
                ".self::TABLE_STUDENT_EXAM." se
            INNER JOIN
                ".self::TABLE_NAME." e
            ON
                e.exam_id = se.exam_id
            INNER JOIN
                ".self::TABLE_LESSON." l
            ON
                l.lesson_id = e.lesson_id
            INNER JOIN
                ".self::TABLE_REGISTERED_USER." ru
            ON
                ru.student_id = se.student_id
            WHERE
                se.student_id = {$studentID}
        ";
        $result = Dbcon::execute($sql);
        return Dbcon::fetch_all_assoc($result);
    }

    public static function getStudentGraph($examID, $studentID)
    {
        $sql = "
            SELECT
                se.exam_id,
                sc.attempt,
                sc.score
            FROM
                student_score sc
            INNER JOIN
                student_exam se
            ON
                se.student_exam_id = sc.student_exam_id
            WHERE
                se.exam_id = {$examID}
            AND
                student_id = {$studentID}
        ";
        $result = Dbcon::execute($sql);
        return Dbcon::fetch_all_assoc($result);
    }

    public static function updateStudentExam($data, $where = [], $examID)
    {
        $sql = "
            UPDATE
                ".self::TABLE_STUDENT_EXAM."
            SET
                end_time = now(),
        ";
        $x = 1;
        foreach ($data as $key => $value) {
            if ($x === count($data)) {
                $sql .= " {$key} = '{$value}' ";
            } else {
                $sql .= " {$key} = '{$value}', ";
            }
            $x++;
        }
        $sql .= "
            WHERE
                exam_id = {$examID}
        ";
        foreach ($where as $key => $value) {
            $sql .= " 
                AND 
                    {$key} = '{$value}'
            ";
        }
        Dbcon::execute($sql);
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
                case self::EXAM_TYPE_MULTIPLE_CHOICE:
                    $data[self::EXAM_TYPE_MULTIPLE_CHOICE] = "Multiple Choice";
                    break;
            }
        } else {
            $data = [
//                self::EXAM_TYPE_ESSAY => "Essay",
                self::EXAM_TYPE_BOOLEAN => "Boolean",
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