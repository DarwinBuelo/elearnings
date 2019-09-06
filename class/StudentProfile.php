<?php

/**
 * PIA GotSky
 * This object is based on the enrollment form of PIA GotSky
 *
 */
class StudentProfile
{
    public $registeredUserID;
    public $date;
    public $studentName;
    public $school;
    public $address;
    public $contactNo;
    public $gradeLevel;
    public $birthday;
    public $age;
    public $email;
    public $allergies;
    public $program; //course
    public $motherName;
    public $motherOccupation;
    public $motherOfficeAddress;
    public $motherTelNo;
    public $fatherName;
    public $fatherOccupation;
    public $fatherOfficeAddress;
    public $fatherTelNo;
    public $noOfSiblings;
    public $siblingNames;
    public $siblingAge;
    public $siblingGradeLevel;
    public $siblingSchool;
    public $otherProgramsAttended;
    public $suggestions;
    public $others;

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;
    }

    public function getAllergies()
    {
        return $this->allergies;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setContactNo($contactNo)
    {
        $this->contactNo = $contactNo;
    }

    public function getContactNo()
    {
        return $this->getContactNo();
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFatherName($fatherNames)
    {
        $this->fatherName = $fatherNames;
    }

    public function getFatherName(){
        return $this->fatherName;
    }
}