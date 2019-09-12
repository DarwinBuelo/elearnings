<?php


class CourseMethods extends CourseInterface
{

    public static function EnrollTo($cid,$uid){
        $data = ['course_id'=>$cid,'student_id'=>$uid];
        if(Dbcon::insert('student_course',$data)){
            return true;
        }else{
            return false;
        }
    }


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

    public static function archive(int $cid){
        $data = ['remove'=> 1];
        $where = ['course_id' => $cid];
        Dbcon::update('courses',$data,$where);
    }

    public static function load($id){
        $sql =  "SELECT
                        *
                 FROM
                    courses
                 WHERE
                    course_id = {$id}";
        $result = Dbcon::execute($sql);
        $data =Dbcon::fetch_assoc($result);
        $new = new static();
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

    public static function getExamsCount($courseID = null)
    {
        if (!empty($courseID)){
            $sql = "SELECT 
                        COUNT(*)
                    FROM
                        ".static::EXAMS_TABLE."
                    WHERE
                        course_id = {$courseID} ";
        } else {
            $sql ="SELECT 
                        COUNT(*)
                    FROM
                        ".static::EXAMS_TABLE;
        }
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_array($result);
        return $data[0];
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
}