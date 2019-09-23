<?php


class LessonInterface
{
    const LESSONS_TABLE = 'lessons';

    protected $lessonID;
    protected $title;
    protected $overView;
    protected $content;
    protected $courseID;
    protected $dateCreated;

    public static function LoadArray(array $ids = null, $teacherID = null)
    {
        if (isset($ids)) {
            $return = [];
            foreach ($ids as $id) {
                $return[$id] = self::load($id);
            }
            return $return;
        } else {
            $sql = "SELECT
                        lesson_id as id
                     FROM "
                        .self::LESSONS_TABLE.
                     " WHERE
                        TRUE";
            if (!empty($teacherID)) {
                $sql .= " AND ";
            }

            $result = Dbcon::execute($sql);
            $data = Dbcon::fetch_all_assoc($result);
            $return = [];

            foreach ($data as $key => $value) {
                $return[$value['id']] = self::load($value['id']);
            }
            return $return;

        }
    }

    public static function load($id)
    {
        $sql = "SELECT
                        *
                 FROM
                    ".self::LESSONS_TABLE."
                 WHERE
                    lesson_id = {$id}";
        $result = Dbcon::execute($sql);
        $data = Dbcon::fetch_assoc($result);
        $new = new static();
        $new->setLessonID($data['lesson_id']);
        $new->setTitle($data['title']);
        $new->setOverView($data['overview']);
        $new->setContent($data['content']);
        $new->setCourseID($data['course_id']);
        $new->setDateCreated($data['date_created']);
        return $new;
    }

    public static function getLessonCount($courseID = null)
    {
        if (!empty($courseID)) {
            $sql = "SELECT 
                        COUNT(*)
                    FROM
                        " . static::LESSONS_TABLE . "
                    WHERE
                        course_id = {$courseID} ";
        } else {
            $sql = "SELECT 
                        COUNT(*)
                    FROM
                        " . static::LESSONS_TABLE;
        }
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_array($result);
        return $data[0];
    }

    public function addLesson(array $data)
    {
        if (is_array($data) && count($data) > 0) {
            DBcon::insert('lessons', $data);
            return true;
        }
    }

    public function submit()
    {
        $data = [
            'title' => $this->getTitle(),
            'overview' => $this->getOverView(),
            'content' => $this->getContent(),
            'course_id' => $this->getCourseID()
        ];

        $where = ['lesson_id' => $this->getLessonID()];
        $result = DBcon::update('lessons', $data, $where);
        return $result;
    }

    public function getExams($archived = false)
    {
        $query = "SELECT 
                    exam_id
                FROM
                    exams
                WHERE
                    lesson_id = {$this->getCourseID()}";
        if (!$archived) {
            $query .= " AND remove = 0";
        }

        $result = Dbcon::execute($query);
        $data = DBcon::fetch_all_assoc($result);
        $ids = [];

        foreach ($data as $value) {
            $ids[] = $value['exam_id'];
        }
        if (count($ids) > 0) {
            $exams = Exam::LoadArray($ids);
            if ($exams != false) {
                return $exams;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getLessonID()
    {
        return $this->lessonID;
    }

    public function setLessonID($id)
    {
        $this->lessonID = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getOverView()
    {
        return $this->overView;
    }

    public function setOverView($overview)
    {
        $this->overView = $overview;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCourseID()
    {
        return $this->courseID;
    }

    public function setCourseID($courseID)
    {
        $this->courseID = $courseID;
    }

    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

}