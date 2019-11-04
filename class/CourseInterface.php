<?php


class CourseInterface
{

    const EXAMS_TABLE = 'exams';
    const TABLE_STUDENT_EXAM = 'student_exam';

    public $courseID;
    public $courseName;
    public $courseDesc;
    public $courseCode;
    public $units;
    public $creatorID;
    public $featureImage;
    public $archive;
    public $timeTo;
    public $timeFrom;
    public $scheduleDate;



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
            'time_from'   => $this->getTimeFrom(),
            'time_to'     => $this->getTimeTo(),
            'schedule_day'=> $this->getScheduleDate(),
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

    /**
     * @param $courseID
     * @param $remarks 1 = pass / 0 = fail
     * @return int
     */
    public static function getRemarksCount($courseID, $remarks)
    {
        $sql = "
            SELECT
                count(*)
            FROM
                ".self::TABLE_STUDENT_EXAM." se
            INNER JOIN
                ".self::EXAMS_TABLE." e
            ON
                se.exam_id = e.exam_id
            WHERE
                e.course_id = {$courseID}
            AND 
                se.remarks = {$remarks}
        ";
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_array($result);
        return (int) $data[0];
    }

    public function getStudents(){
        $sql = "SELECT * FROM student_course WHERE course_id ={$this->getCourseID()}";
        $result =  DBcon::execute($sql);
        $data = DBcon::fetch_all_assoc($result);
        $ids = [];

        if(count($data) > 0){
            foreach($data as $student){
                $ids[] = $student['student_id'];
            }
            $return =Student::LoadArray($ids);
        }else{
            $return = false;
        }
        return $return;
    }



    public function isArchived(){
        return $this->archive;
    }

    public function setTimeFrom($timeFrom)
    {
        $this->timeFrom = $timeFrom;
    }

    public function getTimeFrom()
    {
        return $this->timeFrom;
    }

    public function setTimeTo($timeTo)
    {
        $this->timeTo = $timeTo;
    }

    public function getTimeTo()
    {
        return $this->timeTo;
    }

    public function setScheduleDate($date)
    {
        $this->scheduleDate = $date;
    }

    public function getScheduleDate()
    {
        return $this->scheduleDate;
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

    public function getCreatorDetails(){
        $user = User::Load($this->creatorID);
        return $user;
    }

    public function setFeatureImage($link){
        $this->featureImage = $link;
    }

    public function getFeatureImage(){
        return $this->featureImage;
    }


}