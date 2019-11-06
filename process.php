<?php
/**
 *  Will handle all the process on the system
 */
require 'init.php';

$task = Util::getParam('task');
$user = unserialize($_SESSION['user']);
if (isset($user) && !empty($user)) {
    switch ($task) {
        case 'logout':
            session_destroy();
            header('location:index.php');
            break;

        case 'delCourse':
            if ($user->getRoleID() == Role::ROLE_TEACHER) {
                $cid = Util::getParam('cid');
                $backLink = Util::getParam('backLink');
                $where = ['course_id ' => $cid];
                Dbcon::delete('courses', $where);
                Util::redirect($backLink);
            }
            break;
        case 'delLesson':
            if ($user->getRoleID() == Role::ROLE_TEACHER || $user->getRoleID() == Role::ROLE_ADMIN) {
                $lid = Util::getParam('lid');
                $backLink = Util::getParam('backLink');
                $where = ['lesson_id ' => $lid];
                Dbcon::delete('lessons', $where);
                Util::redirect($backLink);
            }
            break;
        case 'enrollToCourse':
            $cid = Util::getParam('cid');
            $uid = $user->getStudentID();
            $openHash = hash('ripemd160', Util::dateNow());
            if (Course::EnrollTo($cid, $uid)) {
                $_SESSION['message'][$openHash] = ['result' => 'success', 'message' => 'Successfully Enrolled to a course'];
                Util::redirect('student.php?message=' . $openHash);
            } else {
                $_SESSION['message'][$openHash] = ['result' => 'failed', 'message' => 'Error in Enrolling to a course'];
            }
        case 'exportData':
            $sid = Util::getParam('sid');
            $data = unserialize($_SESSION['ExportData'][$sid]);

            $filename = date('YmdHis');
            $file = fopen("public/{$filename}.csv", 'w');
            foreach ($data as $row) {
                fputcsv($file, $row);
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
            fputcsv($file, $csvHeader);
            foreach ($data as $item) {
                foreach ($item as $row) {
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
                    fputcsv($file, $csvData);
                }
            }
            fclose($file);
            echo "public/{$filename}StudentDetails.csv";
            break;
        case 'uploadGallery':
            $path = 'images/gallery';
            Util::debug($_FILES);
            $fileToUpload = $_FILES['imageToUpload'];
            $Uploader = new Upload($fileToUpload);
            if ($Uploader->uploaded) {
                $Uploader->Process($path);
                if ($Uploader->processed) {
                    $dataToInsert = ['filename' => $Uploader->file_dst_name, 'description' => Util::getParam('description'), 'remove' => 0];
                    Dbcon::insert(Gallery::TABLE_NAME, $dataToInsert);
                    echo 'file Uploaded';
                } else {
                    echo 'error : ' . $Uploader->log;
                }
            }
            Util::redirect($_SERVER['HTTP_REFERER']);
            break;
        case 'editImage':
            $id = Util::getParam('imageID');
            $desc = Util::getParam('desc');
            Dbcon::update(Gallery::TABLE_NAME,['description' => $desc ],['image_id' => $id] );
            break;
        case 'deleteImage':
            $id = Util::getParam('imageID');
            Dbcon::update(Gallery::TABLE_NAME,['remove'=>'1'],['image_id'=>$id]);
            break;
        case 'getDetailsExam':
            $examID = Util::getParam('examID');
            $studentId = Util::getParam('studentID');
            echo json_encode(Exam::getStudentGraph($examID,$studentId));
            break;
    }
}
