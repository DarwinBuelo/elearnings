<?php
$week = [
    'Sunday',
    'Thursday',
    'Monday',
    'Friday',
    'Tuesday',
    'Saturday',
    'Wednesday'
];
?>
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
            <form action="teacher.php?page=courseList" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="cid" value="<?= isset($cid) ? $cid : null ?>">
                    <div id="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload" />
                    </div>
                    <div class="form-group">
                        <label for="name">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name"
                               value="<?= isset($courseName) ? $courseName : null ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Course Description</label>
                        <input type="text" class="form-control" id="course_desc" name="course_desc"
                               value="<?= isset($courseDescription) ? $courseDescription : null ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Course Code</label>
                        <input type="text" class="form-control" id="course_code" name="course_code"
                               value="<?= isset($courseCode) ? $courseCode : null ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Units</label>
                        <input type="number" class="form-control" id="units" name="units"
                               value="<?= isset($courseUnits) ? intval($courseUnits) : null ?>" required>
                    </div>
                    <label for="Sunday">Schedule Date</label>
                    <div class="form-group">
                    <?php
                        foreach ($week as $day) { ?>
                            <div class="form-group col-6">
                                <input type='checkbox' class='form-control col-3' name='scheduleDate[]' id='scheduleDate[]' value='<?= $day; ?>'><?= $day; ?>
                            </div>
                    <?php } ?>
                        <div class="form-group col-6">
                            <input type='checkbox' class='form-control col-3' id="checkAll" name="checkAll">Check All
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="timeFrom">From</label>
                        <input type="time" class="form-control" id="timeFrom" name="timeFrom" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="timeTo">To</label>
                        <input type="time" class="form-control" id="timeTo" name="timeTo" required>
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

<style type="text/css">
#image-preview {
  width: 400px;
  height: 400px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
#image-preview input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
  opacity: 0;
  z-index: 10;
}
#image-preview label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: #bdc3c7;
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  text-align: center;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery.uploadPreview({
    input_field: "#image-upload",   // Default: .image-upload
    preview_box: "#image-preview",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: false                 // Default: false
  });

  jQuery("#checkAll").click(function () {
      jQuery('input:checkbox').not(this).prop('checked', this.checked);
  });
});
</script>
