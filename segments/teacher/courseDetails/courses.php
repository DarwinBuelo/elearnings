<?php
// will display user courses
$courses =  Course::LoadArray(null,$user->getID());
?>
<div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Courses List</strong>
                </div>
                <div class="card-body">
                    <table id="courses" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Course Description</th>
                            <th>Units</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($courses as $course) {
                            $html =  "<tr>";
                            $html .= "<td>{$course->getCourseName()}</td>";
                            $html .= "<td>{$course->getDesc()}</td>";
                            $html .= "<td>{$course->getUnits()}</td>";
                            $html .= "<td><a href='admin.php?page=courseDetails&cid={$course->getCourseID()}'>View</a> | ";
                            $html .="<a href='admin.php?page=addCourse&cid={$course->getCourseID()}'>Edit</a> | ";
                            $backLink = urlencode($_SERVER['PHP_SELF'] ."?page=".Util::getParam('page'));
                            $html .="<a href='process.php?cid={$course->getCourseID()}&task=delCourse&backLink={$backLink}'>Delete</a>";
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
