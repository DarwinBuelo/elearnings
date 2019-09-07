<?php

class Course
{
    private $courseID;
    private $courseName;
    private $courseDesc;
    private $courseCode;
    private $units;
    private $creatorID;
    private $featureImage;
    private $archive;

    /**
     * @TODO : Creator is not set when adding the course.
     */

    /**
     * @param array|null $ids
     * @param null $teacherID
     * @return array
     */
    public static function LoadArray(array $ids = null,$teacherID = null,$archive=false){
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
                        courses
                     WHERE
                        true";
            //filter by teacher
            if(!empty($teacherID)){
                $sql .= " AND creator =  {$teacherID}";
            }
            //filter removed course
            if(!$archive){
                $sql .= " AND remove = 0";
            }
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
        $new->setFeatureImage($data['feature_image']);
        $new->archive = $data['remove'] == 0 ? true : false ;
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
    /**
     * Save the data
     */
    public function submit(){
        $data = [
            'course_name' => $this->getCourseName(),
            'course_code' => $this->getCourseCode(),
            'course_desc' => $this->getDesc(),
            'units'       => $this->getUnits(),
            'creator'     => $this->getCreatorID(),
            'feature_image'=> $this->getFeatureImage()
        ];
        $where = ['course_id'=> $this->getCourseID()];
        $return = DBcon::update('courses',$data,$where);
        return $return;
    }

    public static function getCourseCount($teacherID = null,$archived=false){
        if (!empty($teacherID)){
            $sql = "SELECT 
                        COUNT(*)
                    FROM
                        courses
                    WHERE
                        creator = {$teacherID} ";
            if(!$archived){
                $sql .= " AND remove = 0";
            }
        }else{
            $sql ="SELECT 
                        COUNT(*)
                    FROM
                        courses
                    WHERE 
                          TRUE";

            if(!$archived){
                $sql .= " AND remove = 0";
            }
        }
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_array($result);
        return $data[0];
    }

    public static function archive(int $cid){
        $data = ['remove'=> 1];
        $where = ['course_id' => $cid];
        Dbcon::update('courses',$data,$where);
    }

    public function isArchived(){
        return $this->archive;
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

    public function setFeatureImage($link){
        $this->featureImage = $link;
    }

    public function getFeatureImage(){
        return $this->featureImage;
    }

   
}