<?php

class Course
{
    private $courseID;
    private $courseName;
    private $courseDesc;
    private $courseCode;
    private $units;
    private $creatorID;

    /**
     * @TODO : Creator is not set when adding the course.
     */


    public static function LoadArray(array $ids = null){
        if(isset($ids)){
            $return = [];
            foreach ($ids as $id){
                $return[$id] = self::load($id);
            }
            return $return;
        } else{
            $sql =  "SELECT
                            course_id as id
                     FROM
                        courses";
            $result = Dbcon::execute($sql);
            $data =Dbcon::fetch_all_assoc($result);
            $return = [];

            foreach ($data as $key =>$value){
                $return[$value['id']] = self::load($value['id']);
            }
            return $return;
        }
    }

    public function load($id){
        $sql =  "SELECT
                        *
                 FROM
                    courses
                 WHERE
                    course_id = {$id}";
        $result = Dbcon::execute($sql);
        $data =Dbcon::fetch_assoc($result);
        $new = new self();
        $new->setCourseID($data['course_id']);
        $new->setCourseCode($data['course_code']);
        $new->setCourseName($data['course_name']);
        $new->setDesc($data['course_desc']);
        $new->setUnits($data['units']);
        $new->setCreatorID($data['creator']);
        return $new;
    }

    public function getLessons(){
        $sql = "
                SELECT 
                    lesson_id as id
                FROM
                    lessons
                WHERE
                    course_id = {$this->courseID}";
        $resultObj = Dbcon::execute($sql);
        $results = Dbcon::fetch_all_array($resultObj);
        $ids=[];
        foreach($results as $result){
            $ids[] = $result[0];
        }
        $return = Lesson::LoadArray($ids);
        return $return;
    }
    /**
     * @param $data
     * @return bool
     */
    public static function addCourse($data){
        if(is_array($data) && count($data) > 0){
            DBcon::insert('courses', $data);
            return true;
        }
    }
    // will save to the database any update
    public function submit(){
        $data = [
            'course_name' => $this->getCourseName(),
            'course_code' => $this->getCourseCode(),
            'course_desc' => $this->getCourseCode(),
            'units'       => $this->getUnits(),
            'creator'     => $this->getCreatorID()
        ];
        $where = ['course_id'=> $this->getCourseID()];
        $return = DBcon::update('courses',$data,$where);
        return $return;
    }

    public static function getCourseCount($teacherID = null){
        if (!empty($teacherID)){
            $sql = "SELECT 
                        COUNT(*)
                    FROM
                        courses
                    WHERE
                        creator = {$teacherID} ";
        }else{
            $sql ="SELECT 
                        COUNT(*)
                    FROM
                        courses";
        }
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_array($result);
        return $data[0];
    }

    public function getCourseID()
    {
        return $this->courseID;
    }

    public function setCourseID($id)
    {
        $this->courseID = $id;
    }

    public function getCourseName()
    {
        return $this->courseName;
    }

    public function setCourseName($name)
    {
        $this->courseName = $name;
    }

    public function getDesc()
    {
        return $this->courseDesc;
    }

    public function setDesc($desc)
    {
        $this->courseDesc = $desc;
    }

    public function getUnits()
    {
        return $this->units;
    }

    public function setUnits($units)
    {
        $this->units = $units;
    }

    public function getCourseCode(){
        return $this->courseCode;
    }

    public function setCourseCode($courseCode){
        $this->courseCode =$courseCode;
    }

    public function setCreatorID($creatorID){
        $this->creatorID = $creatorID;
    }

    public function getCreatorID(){
        return $this->creatorID;
    }
}