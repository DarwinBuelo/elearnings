<?php

class Course
{
    public $courseID;
    public $courseName;
    public $courseDesc;
    public $courseCode;
    public $units;

    /**
     * @param array $id
     * @return array|bool
     */
    public static function LoadArray(array $id){
        if(isset($id)){
            $data = [];
            foreach($id as $item){
                $sql ="SELECT 
                            course_id,
                            course_name
                            course_desc
                        WHERE
                            course_id = '{$item}'";
                $result = Dbcon::execute($sql);
                $data[$item] = Dbcon::fetch_assoc($result);
            }
            return $data;
        }
        return false;
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
}