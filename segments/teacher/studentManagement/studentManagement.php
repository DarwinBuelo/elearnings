<?php
$User = unserialize($_SESSION['user']);
$Students = $User->getStudents();
$_SESSION['ExportData']['studentDetails'] = serialize($Students);
?>
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <strong class="card-title">List of Students</strong>
                        </div>
                        <div class="col-md-6 text-right">
                            <buttton class='btn btn-primary right' id="exportdata">Download</buttton>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="courses" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Course Enrolled</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($Students)) {
                                foreach ($Students as $key => $Course) {
                                    $CourseObj = Course::Load($key);
                                    if (!empty($Course)) {
                                        foreach ($Course as $Student) {
                                            $html = "<tr>";
                                            $html .= "<td>{$Student->getStudentID()}</td>";
                                            $html .= "<td><a href='teacher.php?page=studentProfile&sid={$Student->getStudentID()}'>{$Student->getStudentName()}</a></td>";
                                            $html .= "<td>{$CourseObj->getCourseName()}</td>";
                                            print $html;
                                        }
                                    }
                                }
                            } else {
                                $html = "<tr><td colspan='4'>No Result Found</td></tr>";
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


    <script>
        jQuery(document).ready(function () {
            //download click
            jQuery('#exportdata').click(function () {
                jQuery.ajax({
                    url: '/process.php',
                    data: {
                        'task': 'exportDataStudentDetails',
                    },
                    success: function (response) {
                        window.open(response, '_blank');
                        console.log('success ' + response);
                    },
                    error: function (response) {
                        console.log('error ' + response);
                    }

                })
            });
        });
    </script>