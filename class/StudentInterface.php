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
                    *   
                FROM
                    " . static::REGISTERED_USER_TABLE . "
                WHERE
                    student_id = '" . $studentID . "'
                AND
                    password = '" . $password . "'
                AND    
                    status = 1
            ";
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_assoc($result);
        if (!empty($data)) {
            $new = new self();
            $new->setRegisteredUserID($data['registered_user_id']);
            $new->setStudentID($data['student_id']);
            $new->setDate($data['date']);
            $new->setStudentName($data['student_name']);
            $new->setSchool($data['school']);
            $new->setAddress($data['address']);
            $new->setContactNo($data['contact_no']);
            $new->setGradeLevel($data['grade_level']);
            $new->setContactNo($data['contact_no']);
            $new->setBirthday($data['birthday']);
            $new->setAge($data['age']);
            $new->setEmail($data['email_address']);
            $new->setAllergies($data['allergies']);
            $new->setProgram($data['program']);
            $new->setMotherName($data['mothers_name']);
            $new->setMotherOccupation($data['mother_occupation']);
            $new->setMotherOfficeAddress($data['mother_office_address']);
            $new->setMotherTelNo($data['mother_tel_no']);
            $new->setFatherName($data['fathers_name']);
            $new->setFatherOccupation($data['father_occupation']);
            $new->setFatherOfficeAddress($data['father_office_address']);
            $new->setFatherTelNo($data['father_tel_no']);
            $new->setNoOfSiblings($data['no_of_siblings']);
            $new->setSiblingNames($data['sibling_names']);
            $new->setSiblingAge($data['sibling_age']);
            $new->setSiblingGradeLevel($data['sibling_grade_level']);
            $new->setSiblingSchool($data['sibling_school']);
            $new->setOtherProgramsAttended($data['other_programs_attended']);
            $new->setSuggestions($data['suggestions']);
            $new->setOthers($data['others']);
            $new->setStatus($data['status']);
            return $new;
        }
    }


    public static function LoadArray(array $ids = null)
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
            $sql = "SELECT student_id FROM {$table}";
            $result = DBcon::execute($sql);
            $data = DBcon::fetch_all_assoc($result);
            foreach ($data as $key => $value) {
                $return[$value['student_id']] = self::load($value['student_id']);
            }
        }
        return $return;
    }

    public static function Load($id)
    {
        $table = self::REGISTERED_USER_TABLE;
        $sql = "SELECT * FROM {$table} WHERE student_id = {$id}";
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_assoc($result);
        if (!empty($data)) {
            $new = new self();
            $new->setRegisteredUserID($data['registered_user_id']);
            $new->setStudentID($data['student_id']);
            $new->setDate($data['date']);
            $new->setStudentName($data['student_name']);
            $new->setSchool($data['school']);
            $new->setAddress($data['address']);
            $new->setContactNo($data['contact_no']);
            $new->setGradeLevel($data['grade_level']);
            $new->setContactNo($data['contact_no']);
            $new->setBirthday($data['birthday']);
            $new->setAge($data['age']);
            $new->setEmail($data['email_address']);
            $new->setAllergies($data['allergies']);
            $new->setProgram($data['program']);
            $new->setMotherName($data['mothers_name']);
            $new->setMotherOccupation($data['mother_occupation']);
            $new->setMotherOfficeAddress($data['mother_office_address']);
            $new->setMotherTelNo($data['mother_tel_no']);
            $new->setFatherName($data['fathers_name']);
            $new->setFatherOccupation($data['father_occupation']);
            $new->setFatherOfficeAddress($data['father_office_address']);
            $new->setFatherTelNo($data['father_tel_no']);
            $new->setNoOfSiblings($data['no_of_siblings']);
            $new->setSiblingNames($data['sibling_names']);
            $new->setSiblingAge($data['sibling_age']);
            $new->setSiblingGradeLevel($data['sibling_grade_level']);
            $new->setSiblingSchool($data['sibling_school']);
            $new->setOtherProgramsAttended($data['other_programs_attended']);
            $new->setSuggestions($data['suggestions']);
            $new->setOthers($data['others']);
            $new->setStatus($data['status']);
            return $new;
        } else {
            return false;
        }
    }

    public function getCoursesEnrolled()
    {
        $sql = "SELECT * FROM student_course WHERE student_id = {$this->getStudentID()}";
        $result = DBcon::execute($sql);
        $data = DBcon::fetch_all_assoc($result);
        if (count($data) > 0) {
            $ids = [];
            foreach ($data as $value) {
                $ids[] = $value['course_id'];
            }
            $return = Course::LoadArray($ids);
        } else {
            $return = false;
        }

        return $return;

    }


    public function submit()
    {
        $data = [
            'date' => $this->getDate(),
            'student_name' => $this->getStudentName(),
            'school' => $this->getSchool(),
            'address' => $this->getAddress(),
            'contact_no' => $this->getContactNo(),
            'grade_level' => $this->getGradeLevel(),
            'birthday' => $this->getBirthday(),
            'age' => $this->getAge(),
            'email_address' => $this->getEmail(),
            'allergies' => $this->getAllergies(),
            'mothers_name' => $this->getMotherName(),
            'mother_occupation' => $this->getMotherOccupation(),
            'mother_office_address' => $this->getMotherOfficeAddress(),
            'mother_tel_no' => $this->getMotherTelNo(),
            'fathers_name' => $this->getFatherName(),
            'father_occupation' => $this->getFatherOccupation(),
            'father_office_address' => $this->getFatherOfficeAddress(),
            'father_tel_no' => $this->getFatherTelNo(),
            'no_of_siblings' => $this->getNoOfSiblings(),
            'sibling_names' => $this->getSiblingNames(),
            'sibling_age' => $this->getSiblingAge(),
            'sibling_grade_level' => $this->getSiblingGradeLevel(),
            'sibling_school' => $this->getSiblingSchool(),
            'other_programs_attended' => $this->getOtherProgramsAttended(),
            'suggestions' => $this->getSuggestions(),
            'others' => $this->getOthers(),
            'status' => $this->getStatus(),
        ];
        $where = ['student_id' => $this->getStudentID()];
        $return = DBcon::update(self::REGISTERED_USER_TABLE, $data, $where);
        return $return;
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
        return $this->contactNo;
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

    public function getSiblingSchool()
    {
        return $this->siblingSchool;
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
        $this->studentName = $name;
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

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRoleID()
    {
        return 3;// constant for student
    }
}