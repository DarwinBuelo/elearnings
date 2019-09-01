<?php
// will display user courses
$courses =  Course::LoadArray(null,$user->getID());
require 'segments/teacher/addCourse/addCourse.php'
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
                            $countExams = 0;
                            foreach ($course->getLessons() as $lesson){
                                $countExams += $lesson->getExams() != false ? count($lesson->getExams()) : 0 ;
                            }

                            $html =  "<tr>";
                            $html .= "<td>{$course->getCourseName()}</td>";
                            $html .= "<td>{$course->getDesc()}</td>";
                            $html .= "<td>{$course->getUnits()}</td>";
                            $html .= "<td>{$countLessons}</td>";
                            $html .= "<td>{$countExams}</td>";
                            $html .= "<td>";
                            $backLink = urlencode($_SERVER['PHP_SELF'] ."?page=".Util::getParam('page'));
                            $html .= "<div class='btn-group'>";
                            if($countLessons > 0){
                                $html .="<a data-toggle='tooltip' title='Add Exam' class='btn btn-success btn-sm' href='teacher.php?page=examDetails&cid={$course->getCourseID()}'><i class='fa fa-file-text-o'></i></a>";
                                $html .="<a data-toggle='tooltip' title='Add Lesson' class='btn btn-success btn-sm' href='teacher.php?page=addLesson&courseID={$course->getCourseID()}'><i class='fa fa-files-o'></i></a>";
                            }else{
                                $html .="<a href='teacher.php?page=addLesson&courseID={$course->getCourseID()}'>Add Lesson</a>";
                            }
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