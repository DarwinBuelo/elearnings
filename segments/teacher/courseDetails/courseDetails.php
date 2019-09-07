<?php
$cid = Util::getParam('cid');
if (!empty($cid)) {
    $course = Course::load($cid,$user->getID());
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4><?= $course->getCourseName() ?> - Details</h4></div>
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
                            foreach ($lessons as $lesson){
                                $html = "<tr>";
                                $html .= "<td>{$lesson->getTitle()}</td>";
                                $html .= "<td>{$lesson->getOverView()}</td>";
                                $html .= "<td>{$lesson->getDateCreated()}</td>";
                                $html .= "<td><a href='teacher.php?page=addLesson&lid={$lesson->getLessonID()}'>Edit</a> | ";
                                $backLink = urlencode($_SERVER['PHP_SELF'] ."?page=".Util::getParam('page') . "&cid=".$cid);
                                $html .= "<a href='process.php?task=delLesson&lid={$lesson->getLessonID()}&backLink={$backLink}'>Delete</a>";
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