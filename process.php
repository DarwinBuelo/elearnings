<?php
/**
 *  Will handle all the process on the system
 */

require 'init.php';

$task = Util::getParam('task');
$user = unserialize($_SESSION['user']);
if(isset($user)&& !empty($user)){
    switch ($task) {
        case 'logout':
            session_destroy();
            header('location:index.php');
            break;

        case 'delCourse':
            if($user->getRoleID() == Role::ROLE_TEACHER ){
                $cid = Util::getParam('cid');
                $backLink = Util::getParam('backLink');
                $where =['course_id '=>$cid];
                Dbcon::delete('courses',$where);
                Util::redirect($backLink);
            }
            break;
        case 'delLesson':
            if($user->getRoleID() == Role::ROLE_TEACHER || $user->getRoleID() == Role::ROLE_ADMIN){
                $lid = Util::getParam('lid');
                $backLink = Util::getParam('backLink');
                $where =['lesson_id '=>$lid];
                Dbcon::delete('lessons',$where);
                Util::redirect($backLink);
            }
            break;
        case 'enrollToCourse':
            $cid = Util::getParam('cid');
            $uid = $user->getStudentID();
            $openHash = hash('ripemd160', Util::dateNow());
            if(Course::EnrollTo($cid,$uid)){
                $_SESSION['message'][$openHash] = ['result'=>'success','message'=>'Successfully Enrolled to a course'];
                Util::redirect('student.php?message='.$openHash);
            }else{
                $_SESSION['message'][$openHash] = ['result'=>'failed','message'=>'Error in Enrolling to a course'];
            }
        case 'exportData':
            $sid = Util::getParam('sid');
            $data = unserialize($_SESSION['ExportData'][$sid]);

            $filename = date('YmdHis');
            $file = fopen("public/{$filename}.csv", 'w');
            foreach ($data as $row){
                fputcsv($file,$row);
            }
            fclose($file);
            echo "public/{$filename}.csv";
            break;
        case 'exportDataStudentDetails':
            $data = unserialize($_SESSION['ExportData']['studentDetails']);

            $filename = date('YmdHis');
            $file = fopen("public/{$filename}StudentDetails.csv", 'w');
            $csvHeader = [
                'Student ID',
                'Student Name',
                'School',
                'Address',
                'Contact No.',
                'Grade Level',
                'Birthday',
                'Age',
                'Email',
                'Allergies',
                'Program',
                'Mother\'s Name',
                'Mother\'s Occupation',
                'Mother\'s Office',
                'Mother\'s Tel No.',
                'Father\'s Name',
                'Father\'s Occupation',
                'Father\'s Office Address',
                'Father\'s Tel No',
                'No. Of siblings',
                'Siblings Name',
                'Sibling Age',
                'Sibling Grade Level',
                'Sibling School',
                'Other Programs Attended',
                'Suggestions',
                'Others',
                'Status'
            ];
            fputcsv($file,$csvHeader);
            foreach ($data as $item){
                foreach($item as $row){
                    $csvData = [
                        $row->getStudentID(),
                        $row->getStudentName(),
                        $row->getSchool(),
                        $row->getAddress(),
                        $row->getContactNo(),
                        $row->getGradeLevel(),
                        $row->getBirthday(),
                        $row->getAge(),
                        $row->getEmail(),
                        $row->getAllergies(),
                        $row->getProgram(),
                        $row->getMotherName(),
                        $row->getMotherOccupation(),
                        $row->getMotherOfficeAddress(),
                        $row->getMotherTelNo(),
                        $row->getFatherName(),
                        $row->getFatherOccupation(),
                        $row->getFatherOfficeAddress(),
                        $row->getFatherTelNo(),
                        $row->getNoOfSiblings(),
                        $row->getSiblingAge(),
                        $row->getSiblingNames(),
                        $row->getSiblingGradeLevel(),
                        $row->getSiblingSchool(),
                        $row->getOtherProgramsAttended(),
                        $row->getSuggestions(),
                        $row->getOthers()
                    ];
                    fputcsv($file,$csvData);
                }

            }
            fclose($file);
            echo "public/{$filename}StudentDetails.csv";
            break;
    }
}
