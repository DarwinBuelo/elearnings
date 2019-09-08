<?php


class StudentInterface
{
    const STUDENT_COURSE_TABLE = 'student_course';
    const REGISTERED_USER_TABLE = 'registered_user';

    const STATUS_APPROVED = 1;
    const STATUS_DISAPPROVED = 0;

    public $registeredUserID;
    public $studentID; // setter and getter , load
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

    public $status;// new


    public static function getEnrolledStudentCount($courseID = null)
    {
        if (!empty($courseID)) {
            $sql = "
                SELECT 
                    count(*)
                FROM
                    " . static::STUDENT_COURSE_TABLE . " sc
                INNER JOIN
                    " . static::REGISTERED_USER_TABLE . " ru
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
                    " . static::STUDENT_COURSE_TABLE . " sc
                INNER JOIN
                    " . static::REGISTERED_USER_TABLE . " ru
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
                    " . static::REGISTERED_USER_TABLE . "
                WHERE
                    student_id = " . $studentID . "
                AND
                    password = " . $password . "
                AND    
                    status = 1
            ";
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_array($result);
        return $data[0];
    }


    public function LoadArray(array $ids = null)
    {
        $return = [];
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $Object = self::Load($id);
                if ($Object) {
                    $return[$id] = $Object;
                }
            }

        } else {
            $table = self::REGISTERED_USER_TABLE;
            $sql = "SELECT registered_user_id FROM {$table}";
            $result = DBcon::execute($sql);
            $data = DBcon::fetch_all_assoc($result);
            foreach ($data as $key => $value) {
                $return[$value['id']] = self::load($value['id']);
            }
        }
        return $return;
    }

    public static function Load($id)
    {
        $table = self::REGISTERED_USER_TABLE;
        $sql = "SELECT * FROM {$table} WHERE registered_user_id = {$id}";
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_assoc($result);
        if (!empty($data)) {
            /**
             * TODO: check the data if correctly set
             */
            $new = new self();
            $new->setAddress($data['address']);
            $new->setAge($data['age']);
            $new->setAllergies($data['allergies']);
            $new->setContactNo($data['contactNo']);
            $new->setDate($data['date']);
            $new->setEmail($data['email']);
            $new->setFatherName($data['fatherName']);
            $new->setFatherOfficeAddress($data['fatherOfficeAddress']);
            $new->setFatherTelNo($data['fatherTelNo']);
            $new->setMotherName($data['motherName']);
            $new->setMotherOfficeAddress($data['motherOfficeAddress']);
            $new->setMotherTelNo($data['motherTelNo']);
            $new->setNoOfSiblings($data['NoOfSiblings']);
            $new->setSiblingNames($data['siblingNames']);
            $new->setSiblingAge($data['siblingAge']);
            $new->setSiblingGradeLevel($data['siblingGradeLevel']);
            $new->setSiblingSchool($data['siblingSchool']);
            $new->setOtherProgramsAttended($data['otherProgramsAttended']);
            $new->setOthers($data['others']);
            $new->setRegisteredUserID($data['registeredUserID']);
            $new->setStudentName($data['studentName']);
            $new->setSchool($data['school']);
            $new->setGradeLevel($data['gradeLevel']);
            $new->setProgram($data['program']);
            return $new;
        } else {
            return false;
        }
    }


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

    public function getFatherName()
    {
        return $this->fatherName;
    }

    public function setFatherOccupation($occupation)
    {
        $this->fatherOccupation = $occupation;
    }

    public function getFatherOccupation()
    {
        return $this->fatherOccupation;
    }

    public function setFatherOfficeAddress($address)
    {
        $this->fatherOfficeAddress = $address;
    }

    public function getFatherOfficeAddress()
    {
        return $this->fatherOfficeAddress;
    }

    public function setFatherTelNo($telNo)
    {
        $this->fatherTelNo = $telNo;
    }

    public function getFatherTelNo()
    {
        return $this->fatherTelNo;
    }

    public function setMotherName($name)
    {
        $this->motherName = $name;
    }

    public function getMotherName()
    {
        return $this->motherName;
    }

    public function setMotherOccupation($occupation)
    {
        $this->motherOccupation = $occupation;
    }

    public function getMotherOccupation()
    {
        return $this->motherOccupation;
    }

    public function setMotherOfficeAddress($address)
    {
        $this->motherOccupation = $address;
    }

    public function getMotherOfficeAddress()
    {
        return $this->motherOfficeAddress;
    }

    public function setMotherTelNo($telNo)
    {
        $this->motherTelNo = $telNo;
    }

    public function getMotherTelNo()
    {
        return $this->motherTelNo;
    }

    public function setNoOfSiblings($siblingsNo)
    {
        $this->noOfSiblings = $siblingsNo;
    }

    public function getNoOfSiblings()
    {
        return $this->noOfSiblings;
    }

    public function setSiblingNames($names)
    {
        $this->siblingNames = $names;
    }

    public function getSiblingNames()
    {
        return $this->siblingNames;
    }

    public function setSiblingAge($age)
    {
        $this->siblingAge = $age;
    }

    public function getSiblingAge()
    {
        return $this->siblingAge;
    }

    public function setSiblingGradeLevel($gradeLevel)
    {
        $this->siblingGradeLevel = $gradeLevel;
    }

    public function getSiblingGradeLevel()
    {
        return $this->siblingGradeLevel;
    }

    public function setSiblingSchool($siblingSchool)
    {
        $this->siblingSchool = $siblingSchool;
    }

    public function setOtherProgramsAttended($programAttended)
    {
        $this->otherProgramsAttended = $programAttended;
    }

    public function getOtherProgramsAttended()
    {
        return $this->otherProgramsAttended;
    }

    public function setSuggestions($suggestions)
    {
        $this->suggestions = $suggestions;
    }

    public function getSuggestions()
    {
        return $this->suggestions;
    }

    public function setOthers($others)
    {
        $this->others = $others;
    }

    public function getOthers()
    {
        return $this->others;
    }

    public function setRegisteredUserID($id)
    {
        $this->registeredUserID = $id;
    }

    public function getRegisteredUserID()
    {
        return $this->registeredUserID;
    }

    public function setStudentName($name)
    {
        $this->studentName;
    }

    /**
     * @return mixed
     */
    public function getStudentName()
    {
        return $this->studentName;
    }

    public function setSchool($school)
    {
        $this->school = $school;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function setGradeLevel($gradeLevel)
    {
        $this->gradeLevel = $gradeLevel;
    }

    public function getGradeLevel()
    {
        return $this->gradeLevel;
    }

    public function setProgram($program)
    {
        $this->program = $program;
    }

    public function getProgram()
    {
        return $this->program;
    }

    public function setStudentID($id)
    {
        $this->studentID = $id;
    }

    public function getStudentID()
    {
        return $this->studentID;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus(){
        return $this->status;
    }
}