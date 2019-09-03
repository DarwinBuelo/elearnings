
<!-- Modal -->
<div class="modal fade" id="AddCourseDetails" tabindex="-1" role="dialog" aria-labelledby="AddCourseDetails"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Course Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="teacher.php?page=courseList" method="post">
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
