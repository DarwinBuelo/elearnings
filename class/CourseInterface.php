<?php


class CourseInterface
{
    const EXAMS_TABLE = 'exams';

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
}