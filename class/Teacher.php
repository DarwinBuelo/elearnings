<?php

/**
 * Class Teacher
 *
 * @extend User
 * @description Holds all methods and variable for the teachers
 *
 */
class Teacher extends User
{
    const STUDENT_COURSE_TABLE = "student_course";
    const COURSE_TABLE = "courses";

    /**
     * TODO : group by course 
     *
     * @return boolean
     */
    public function getStudents()
    {
        $sql = "SELECT
                    student_id,
                    course_id
                FROM ".static::STUDENT_COURSE_TABLE;
        $sql .= " LEFT JOIN ".static::COURSE_TABLE." USING (course_id)
                WHERE 
                    TRUE 
                AND
                    courses.remove = 0
                AND
                    courses.creator = ".$this->getID();
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_all_assoc($result);
        $return = [];
        if (count($data) > 0) {
            foreach ($data as $result) {
                $return[$result['course_id']][$result['student_id']] = Student::Load($result['student_id']);
            }
        } else {
            $return = false;
        }
        return $return;
    }
}