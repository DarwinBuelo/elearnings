<?php
// will display user courses
$courses =  Course::LoadArray();
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
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($courses as $course){
                            $html =  "<tr>";
                            $html .= "<td><a href='teacher.php?page=courseDetails&cid={$course->getCourseID()}'>{$course->getCourseName()}</a></td>";
                            $html .= "<td>{$course->getDesc()}</td>";
                            $html .= "<td>{$course->getUnits()}</td>";
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
</div><!-- .animated -->
<script>
    jQuery('#courses').DataTable();
</script>