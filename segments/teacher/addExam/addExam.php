<?php

?>
<?php if (!empty($message) && $message['result'] == 'failed'): ?>
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Failed</span>
        <?= $message['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php elseif(!empty($message) && $message['result'] == 'success'):?>
    <div class="sufee-alert alert with-close alert-success  alert-dismissible fade show">
        <span class="badge badge-pill badge-success ">Success</span>
        <?= $message['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>
<form action="teacher.php?page=addLesson" method="post">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h4>Exam for UNDER CONSTRUCTION</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="hidden" name="lid" value="<?= isset($lid)? $lid: null ?>">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="courseID">Course</label>
                        </div>

                        <select class="custom-select" id="courseID" name="courseID">
                            <option>Choose...</option>
                            <?php
                            $courses = Course::loadArray();
                            $html = '';
                            foreach ($courses as $course) {
                                if(isset($courseID) && $course->getCourseID() == $courseID){
                                    $html .= "<option value='{$course->getCourseID()}' selected >{$course->getCourseName()}</option>";
                                }else{
                                    $html .= "<option value='{$course->getCourseID()}'>{$course->getCourseName()}</option>";
                                }

                            }
                            print $html;
                            ?>
                        </select>
                    </div>

                <div class="form-group">
                    <label for="lessonTittle">Lesson Title</label>
                    <input type="text" class="form-control" id="lessonTittle" name="lessonTittle" value="<?= isset($lessonTitle)?$lessonTitle:null ?>">
                </div>
                <div class="form-group">
                    <label for="lessonOverview">Lesson Overview</label>
                    <input type="text" class="form-control" id="lessonOverview" name="lessonOverview" value="<?= isset($lessonOverview) ? $lessonOverview : null ?>">
                </div>
                <div class="form-group">
                    <label for="content">Lesson Content</label>
                    <textarea id="content" name="content" style="width:100%;height: 50vh"><?= isset($content)?$content:null ?></textarea>
                </div>
                <script>
                    var textarea = document.getElementById('content');
                    sceditor.create(textarea, {
                        format: 'bbcode',
                        icons: 'monocons',
                        style: '../minified/themes/content/modern.min.css'
                    });

                </script>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success float-right" name="submit" value="save">Save</button>
                    </div>
                </div>

                </div>

        </div>
    </div>
</form>