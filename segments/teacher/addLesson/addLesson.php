<?php
$submit = Util::getParam('submit');
if (isset($submit) && !empty($submit)) {
    $lessonTitle = Util::getParam('lessonTittle');
    $lessonOverview = Util::getParam('lessonOverview');
    $content = Util::getParam('content');
    $courseID = Util::getParam('courseID');
    $createdDate = date('Y-m-d');

    $data = [
        'title' => $lessonTitle,
        'overview' => $lessonOverview,
        'content' => $content,
        'course_id' =>$courseID,
        'date_created' => $createdDate
    ];
    $result = Lesson::addLesson($data);
    if ($result) {
        $message = ['result' => 'success', 'message' => 'Successfuly added a Lesson with a title "'.$lessonTitle.'"'];
    } else {
        $message = ['result' => 'error', 'message' => 'Failed added a Lesson'];
    }
}


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
            <div class="card-header"><h4>Lesson</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="courseID">Course</label>
                        </div>

                        <select class="custom-select" id="courseID" name="courseID">
                            <option selected>Choose...</option>
                            <?php
                            $courses = Course::loadArray();
                            $html = '';
                            foreach ($courses as $course) {
                                $html .= "<option value='{$course->getCourseID()}'>{$course->getCourseName()}</option>";
                            }
                            print $html;
                            ?>
                        </select>
                    </div>

                <div class="form-group">
                    <label for="lessonTittle">Lesson Title</label>
                    <input type="text" class="form-control" id="lessonTittle" name="lessonTittle">
                </div>
                <div class="form-group">
                    <label for="lessonOverview">Lesson Overview</label>
                    <input type="text" class="form-control" id="lessonOverview" name="lessonOverview">
                </div>
                <div class="form-group">
                    <label for="content">Lesson Content</label>
                    <textarea id="content" name="content" style="height:50vh;width:100%;"></textarea>
                </div>
                <script>
                    var textarea = document.getElementById('content');
                    sceditor.create(textarea, {
                        format: 'bbcode',
                        icons: 'monocons',
                        style: '../minified/themes/content/default.min.css'
                    });

                </script>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right" name="submit" value="save">Save</button>
            </div>
        </div>
    </div>
</form>