<?php
/**
 * This holds the page
 * page=courseList
 *
 */
$submit            = Util::getParam('submit');
$cid               = Util::getParam('cid');
$courseName        = Util::getParam('course_name');
$courseDescription = Util::getParam('course_desc');
$courseCode        = Util::getParam('course_code');
$units             = Util::getParam('units');
$task              = Util::getParam('task');
$message           = null;
$path ='images/upload';
//switch between task
switch ($task) {
    case 'trash':
        $result = Course::archive($cid);
        if ($result) {
            $message = ['result' => 'success', 'message' => 'Successfuly Deleted'];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed to Delete'];
        }
        break;
    case 'edit':
        if (!empty($cid)) {
            $html = '<script>';
            $html .= 'jQuery(window).on("load",function(){';
            $html .= 'jQuery("#AddCourseDetails").modal("show")';
            $html .= '});';
            $html .= '</script>';
            echo $html;
        }
        $course            = Course::load($cid);
        $courseName        = $course->getCourseName();
        $courseDescription = $course->getDesc();
        $courseCode        = $course->getCourseCode();
        $courseUnits       = $course->getUnits();
        break;
}

if (isset($submit) && !empty($submit)) {
    if (!empty($cid)) {
        //update
        $course = Course::load($cid);
        $course->setCourseName($courseName);
        $course->setDesc($courseDescription);
        $course->setCourseCode($courseCode);
        $course->setUnits($units);
        $course->setCreatorID($user->getID());

        $videoUp                     = new Upload($_FILES['image']);
        $videoUp->file_new_name_body = "testFile";

        if ($videoUp->uploaded) {
            $videoUp->Process($path);
            if ($videoUp->processed) {
                //upload success
                $course->setFeatureImage($videoUp->file_dst_name);
            } else {
                echo 'error : '.$videoUp->log;
            }
        }
        $result = $course->submit();

        if ($result) {
            $cid               = null;
            $courseName        = null;
            $courseDescription = null;
            $courseCode        = null;
            $units             = null;
            $message           = ['result' => 'success', 'message' => 'Successfuly saved'];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed save course'];
        }
    } else {
        // add

        $videoUp                     = new Upload($_FILES['image']);
        $videoUp->file_new_name_body = "testFile";

        if ($videoUp->uploaded) {
            $videoUp->Process($path);
            if ($videoUp->processed) {
                //upload success
                $fImage = $videoUp->file_dst_name;
            } else {
                echo 'error : '.$videoUp->log;
            }
        }
        $data   = [
            'course_name' => $courseName,
            'course_desc' => $courseDescription,
            'course_code' => $courseCode,
            'units' => $units,
            'creator' => $user->getID(),
            'feature_image' => isset($fImage) ? $fImage : null,
        ];
        $result = Course::addCourse($data);
        if ($result) {
            $cid               = null;
            $courseName        = null;
            $courseDescription = null;
            $courseCode        = null;
            $units             = null;
            $message           = ['result' => 'success', 'message' => 'Successfully added a course '];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed added a course'];
        }
    }
}
?>
<?php if (!empty($message) && $message['result'] == 'failed'): ?>
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Failed</span>
        <?= $message['message'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php elseif (!empty($message) && $message['result'] == 'success'): ?>
    <div class="sufee-alert alert with-close alert-success  alert-dismissible fade show">
        <span class="badge badge-pill badge-success ">Success</span>
        <?= $message['message'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>

<?php
require 'segments/teacher/addCourse/addCourse.php';
// will display user courses
$courses = Course::LoadArray(null, $user->getID());
?>

<div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Courses List - Select a course</strong>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#AddCourseDetails">Add Course</button>
                </div>
                <div class="card-body">
                    <table id="courses" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Course Name</th>
                                <th>Course Description</th>
                                <th>Units</th>
                                <th>Lessons</th>
                                <th>Exams</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($courses as $course) {
                                $countLessons = count($course->getLessons());
                                $countExams   = 0;
                                foreach ($course->getLessons() as $lesson) {
                                    $countExams += $lesson->getExams() != false ? count($lesson->getExams()) : 0;
                                }

                                $html     = "<tr>";
                                $html     .= "<td><img src='images/upload/{$course->getFeatureImage()}' width='100px'></td>";
                                $html     .= "<td>{$course->getCourseName()}</td>";
                                $html     .= "<td>{$course->getDesc()}</td>";
                                $html     .= "<td>{$course->getUnits()}</td>";
                                $html     .= "<td>{$countLessons}</td>";
                                $html     .= "<td>{$countExams}</td>";
                                $html     .= "<td>";
                                $backLink = urlencode($_SERVER['PHP_SELF']."?page=".Util::getParam('page'));
                                $html     .= "<div class='btn-group'>";

                                $html .= "<a data-toggle='tooltip' title='View Details' class='btn btn-success btn-sm' href='teacher.php?page=courseDetails&cid={$course->getCourseID()}'><i class='fa fa-eye'></i></a>";

                                if ($countLessons > 0) {
                                    $html .= "<a data-toggle='tooltip' title='Add Exam' class='btn btn-success btn-sm' href='teacher.php?page=examDetails&cid={$course->getCourseID()}'><i class='fa fa-file-text-o'></i></a>";
                                } else {
                                    $html .= "<a data-toggle='tooltip'  title='Add Exam' class='btn btn-secondary btn-sm disable' href='#'><i class='fa fa-file-text-o'></i></a>";
                                }

                                $html .= "<a data-toggle='tooltip' title='Add Lesson' class='btn btn-success btn-sm' href='teacher.php?page=addLesson&courseID={$course->getCourseID()}'><i class='fa fa-files-o'></i></a>";
                                $html .= "<a data-toggle='tooltip' title='Edit Course' class='btn btn-success btn-sm' href='teacher.php?page=courseList&task=edit&cid={$course->getCourseID()}'><i class='fa fa-edit'></i></a>";
                                $html .= "<a data-toggle='tooltip' title='Delete Course' class='btn btn-danger btn-sm' href='teacher.php?page=courseList&task=trash&cid={$course->getCourseID()}'><i class='fa fa-trash'></i></a>";

                                $html .= "</div>";
                                $html .= "</td></tr>";
                                print $html;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
<script>
    jQuery('#courses').DataTable();
</script>