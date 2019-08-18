<?php
$cid = Util::getParam('cid');
if (!empty($cid)) {
    $course = Course::load($cid);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4><?= $course->getCourseName() ?> - Details</h4></div>
                <div class="card-body">
                    <table id="courses" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Lesson Title</th>
                            <th>Lesson Overview</th>
                            <th>Date Created</th>
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
                                $html .= "</tr>";

                                print $html;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php

}