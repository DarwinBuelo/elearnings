<?php
$cid = Util::getParam('cid');
if (!empty($cid)) {
    $course = Course::load($cid, $user->getID());
    ?>
    <div class="row">
        <div class="col-md-12 d-inline-flex p-3">
            <div class="justify-content-center align-items-center">
                <h4 class=""><?= ucfirst($course->getCourseName()) ?> - Details</h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>List of Lessons</h4></div>
                <div class="card-body">
                    <table id="lessons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Lesson Title</th>
                            <th>Lesson Overview</th>
                            <th>Date Created</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $lessons = $course->getLessons();
                        foreach ($lessons as $lesson) {
                            $html = "<tr>";
                            $html .= "<td>{$lesson->getTitle()}</td>";
                            $html .= "<td>{$lesson->getOverView()}</td>";
                            $html .= "<td>{$lesson->getDateCreated()}</td>";
                            $html .= "<div class='btn-group'>";
                            $html .= "<td><a data-toggle='tooltip' title='Edit Lesson' class='btn btn-success btn-sm' href='teacher.php?page=addLesson&lid={$lesson->getLessonID()}'><i class='fa fa-files-o'></i></a>";
                            $backLink = urlencode($_SERVER['PHP_SELF'] . "?page=" . Util::getParam('page') . "&cid=" . $cid);
                            $html .= "<a data-toggle='tooltip' title='Delete Lesson' class='btn btn-danger btn-sm'href='process.php?task=delLesson&lid={$lesson->getLessonID()}&backLink={$backLink}'><i class='fa fa-trash'></i></a>";
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
    <script>
        jQuery('#lessons').DataTable();
    </script>
    <?php

}