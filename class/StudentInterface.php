<?php


class StudentInterface
{
    const STUDENT_COURSE_TABLE = 'student_course';
    const REGISTERED_USER_TABLE = 'registered_user';
    
    public static function getEnrolledStudentCount($courseID = null)
    {
        if (!empty($courseID)){
            $sql = "
                SELECT 
                    count(*)
                FROM
                    ".static::STUDENT_COURSE_TABLE." sc
                INNER JOIN
                    ".static::REGISTERED_USER_TABLE." ru
                ON
                    sc.student_id = ru.student_id
                WHERE
                    sc.course_id = {$courseID} 
                AND
                    ru.status = 1
            ";
        } else {
            $sql = "
                SELECT 
                    count(*)
                FROM
                    ".static::STUDENT_COURSE_TABLE." sc
                INNER JOIN
                    ".static::REGISTERED_USER_TABLE." ru
                ON
                    sc.student_id = ru.student_id
                WHERE
                    ru.status = 1
            ";
        }
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_array($result);
        return $data[0];
    }

    public static function login($studentID, $password)
    {
           $sql = "
                SELECT
                    student_id    
                FROM
                    ".static::REGISTERED_USER_TABLE."
                WHERE
                    student_id = ".$studentID."
                AND
                    password = ".$password."
                AND    
                    status = 1
            ";
            $result = DBcon::execute($sql);
            $data = DBcon::fetch_array($result);
            return $data[0];
    }
}