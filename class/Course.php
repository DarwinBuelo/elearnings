<?php

class Course
{
    public $courseID;
    public $courseName;
    public $courseDesc;
    public $courseCode;
    public $units;
    protected $creatorID;


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