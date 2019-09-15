<?php
/**
 * Display the list of exams for the course
 */
$lessons = $course->getLessons();
?>
<?php if (!empty($message) && $message['result'] == 'failed'): ?>
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Failed</span>
        <?= $message['message'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php elseif (!empty($message) && $message['result'] == 'success'): ?>
    <div class="sufee-alert alert with-close alert-success  alert-dismissible fade show">
        <span class="badge badge-pill badge-success ">Success</span>
        <?= $message['message'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>
<div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Exam List for the course "<?= $course->getCourseName() ?>" </strong>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                            data-target="#ExamForm">Add Exam
                    </button>
                </div>
                <div class="card-body">
                    <table id="exams" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Exam ID</th>
                            <th>Type</th>
                            <th>Question</th>
                            <th>Points</th>
                            <th>Duration</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($lessons as $lesson) {
                            $Exams = $lesson->getExams();
                            if ($Exams) {
                                $examList = Exam::getExamTypes();
                                foreach ($Exams as $exam) {
                                    //exams
                                    $html = "<tr>";
                                    $html .= "<td>" . $exam->getExamID() . "</td>";
                                    $html .= "<td>" . $examList[$exam->getExamType()] . "</td>";
                                    $html .= "<td>" . $exam->getExamQuestion() . "</td>";
                                    $html .= "<td>" . $exam->getPoints() . "</td>";
                                    $html .= "<td>" . $exam->getDuration() . " min</td>";
                                    $html .= "<div class='btn-group'>";
                                    $html .= "<td><a data-toggle='tooltip' title='Edit Exam' class='btn btn-success btn-sm' href='admin.php?page=examDetails&cid={$course->getCourseID()}&task=edit&eid={$exam->getExamID()}'><i class='fa fa-edit'></i></a>";
                                    $backLink = urlencode($_SERVER['PHP_SELF'] . "?page=" . Util::getParam('page') . "&cid=" . $cid);
                                    $html .= "<a data-toggle='tooltip' title='Delete Exam' class='btn btn-danger btn-sm'href='admin.php?page=examDetails&cid={$course->getCourseID()}&task=trash&eid={$exam->getExamID()}'><i class='fa fa-trash'></i></a>";
                                    $html .= "</div>";

                                    $html .= "</td>";
                                    $html .= "</tr>";

                                    print $html;
                                }
                            }
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
    jQuery('#exams').DataTable();
</script>