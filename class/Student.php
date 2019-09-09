<?php


class Student extends StudentInterface
{
    /**
     * will get the course where the student is enrolled
     */
    public  function getCourseEnrolled()
    {
       $id = $this->getRegisteredUserID();

    }
}