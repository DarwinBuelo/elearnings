<?php
$submit = Util::getParam('submit');
$cid = Util::getParam('cid');

if (isset($submit) && !empty($submit)) {
    $courseName = Util::getParam('course_name');
    $courseDescription = Util::getParam('course_desc');
    $courseCode = Util::getParam('course_code');
    $units = Util::getParam('units');

    $data = [
        'course_name' => $courseName,
        'course_desc' => $courseDescription,
        'course_code' => $courseCode,
        'units' => $units,
        'creator' => $user->getID()
    ];
    if (!empty($cid)) {
        //update
        $course = Course::load($cid);
        $course->setCourseName($courseName);
        $course->setDesc($courseDescription);
        $course->setCourseCode($courseCode);
        $course->setUnits($units);
        $course->setCreatorID($user->getID);
        $result = $course->submit();
        if ($result) {
            $cid = null;
            $courseName = null;
            $courseDescription = null;
            $courseCode = null;
            $units = null;
            $message = ['result' => 'success', 'message' => 'Successfuly saved' . var_dump($course->getCreatorID())];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed save course'];
        }
    } else {
        // add
        $result = Course::addCourse($data);
        if ($result) {
            $cid = null;
            $courseName = null;
            $courseDescription = null;
            $courseCode = null;
            $units = null;
            $message = ['result' => 'success', 'message' => 'Successfully added a course '];
        } else {
            $message = ['result' => 'error', 'message' => 'Failed added a course'];
        }
    }
}

if (!empty($cid)) {
    $course = Course::load($cid);
    $courseName = $course->getCourseName();
    $courseDescription = $course->getDesc();
    $courseCode = $course->getCourseCode();
    $courseUnits = $course->getUnits();
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
<!-- Modal -->
<div class="modal fade" id="AddCourseDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Course Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="teacher.php?page=addCourse" method="post">
                <div class="modal-body">


                    <input type="hidden" name="cid" value="<?= isset($cid) ? $cid : null ?>">
                    <div class="form-group">
                        <label for="name">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name"
                               value="<?= isset($courseName) ? $courseName : null ?>">
                    </div>
                    <div class="form-group">
                        <label for="surname">Course Description</label>
                        <input type="text" class="form-control" id="course_desc" name="course_desc"
                               value="<?= isset($courseDescription) ? $courseDescription : null ?>">
                    </div>
                    <div class="form-group">
                        <label for="surname">Course Code</label>
                        <input type="text" class="form-control" id="course_code" name="course_code"
                               value="<?= isset($courseCode) ? $courseCode : null ?>">
                    </div>
                    <div class="form-group">
                        <label for="surname">Units</label>
                        <input type="number" class="form-control" id="units" name="units"
                               value="<?= isset($courseUnits) ? intval($courseUnits) : null ?>">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit" value="save">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
