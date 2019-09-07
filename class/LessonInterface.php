<?php


class LessonInterface
{
    const LESSONS_TABLE = 'lessons';

    public static function getLessonCount($courseID = null)
    {
        if (!empty($courseID)){
            $sql = "SELECT 
                        COUNT(*)
                    FROM
                        ".static::LESSONS_TABLE."
                    WHERE
                        course_id = {$courseID} ";
        } else {
            $sql ="SELECT 
                        COUNT(*)
                    FROM
                        ".static::LESSONS_TABLE;
        }
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_array($result);
        return $data[0];
    }
}