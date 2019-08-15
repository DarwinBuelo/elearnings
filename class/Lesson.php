<?php

/**
 * Class Lesson
 *
 * all about the lessons
 */
class Lesson
{
    protected $lessonID;
    protected $title;
    protected $overView;
    protected $content;
    protected $units;
    protected $courseID;
    protected $dateCreated;

    /**
     * @return mixed
     */
    public function getLessonID()
    {
        return $this->lessonID;
    }

    public function setLessonID($id)
    {
        $this->lessonID = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getOverView()
    {
        return $this->overView;
    }

    public function setOverView($overview)
    {
        $this->title = $overview;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getUnits()
    {
        return $this->units;
    }

    public function setUnits($units)
    {
        $this->units = $units;
    }

    public function getCourseID()
    {
        return $this->courseID;
    }

    public function setCourseID($courseID)
    {
        $this->courseID = $courseID;
    }

    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }
}