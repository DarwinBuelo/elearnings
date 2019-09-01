<?php
/**
 * Display the list of exams for the course
 */
$lessons = $course->getLessons();

?>
<div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Exam List for the course "<?= $course->getCourseName()?>" </strong>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModalCenter">Add Exam</button>
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
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($lessons as $lesson) {
                            $Exams = $lesson->getExams();
                            foreach ($Exams as $exam){
                                //exams
                                $html =  "<tr>";
                                $html .= "<td>".$exam->getExamID()."</td>";
                                $html .= "<td>".$exam->getExamType()."</td>";
                                $html .= "<td>".$exam->getExamQuestion()."</td>";
                                $html .= "<td>".$exam->getPoints()."</td>";
                                $html .= "<td>".$exam->getDuration()." min</td>";


                                print $html;
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