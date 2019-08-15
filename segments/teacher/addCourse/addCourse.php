<?php
$submit = Util::getParam('submit');
if (isset($submit) && !empty($submit)) {
    $courseName        = Util::getParam('course_name');
    $courseCode        = Util::getParam('course_desc');
    $courseDescription = Util::getParam('course_code');
    $units             = Util::getParam('units');

    $data = [
        'course_name' => $courseName,
        'course_desc' => $courseDescription,
        'course_code' => $courseCode,
        'units' => $units
    ];
    $result = Course::addCourse($data);
    if($result){
        $message = ['result'=>'success','message'=>'Successfuly added a course'];
    }else{
                $message = ['result'=>'error','message'=>'Failed added a course'];

    }
}
?>
<?php if (!empty($message) && $message['result'] == 'failed'): ?>
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Failed</span>
        You successfully read this important alert.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php elseif(!empty($message) && $message['result'] == 'success'):?>
    <div class="sufee-alert alert with-close alert-success  alert-dismissible fade show">
        <span class="badge badge-pill badge-success ">Success</span>
        You successfully read this important alert.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>
<form action="teacher.php?page=addCourse" method="post">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header"><h4>Course Details</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Course Name</label>
                    <input type="text" class="form-control" id="course_name" name="course_name">
                </div>
                <div class="form-group">
                    <label for="surname">Course Description</label>
                    <input type="text" class="form-control" id="course_desc" name="course_desc">
                </div>
                <div class="form-group">
                    <label for="surname">Course Code</label>
                    <input type="text" class="form-control" id="course_code" name="course_code">
                </div>
                <div class="form-group">
                    <label for="surname">Units</label>
                    <input type="number" class="form-control" id="units" name="units">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right" name="submit" value="save">Save</button>
            </div>
        </div>
    </div>

</form>