<?php
$sid = Util::getParam('sid');
$Student = Student::Load($sid);
$StudentAnalysis = Exam::getStudentAnalysis($sid);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">  <h4 >User Profile</h4></div>
            <div class="panel-body">
                <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                    <img alt="User Pic" src="images/avatar.jpg" id="profile-image1" class="img-circle img-responsive">
                </div>
                <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
                    <div class="container" >
                        <h2><?= $Student->getStudentName() ?></h2>
                        <p><b> Student</b></p>
                    </div>
                    <hr>
                    <ul class="container details" >
                        <li><p><span class="fa fa-envelope" style="width:30px;"></span><?= $Student->getEmail() ?></p></li>
                        <li><p><span class="fa fa-address-book" style="width:30px;"></span><?= $Student->getAddress()?></p></li>
                        <li><p><span class="fa fa-graduation-cap" style="width:30px;"></span><?= $Student->getSchool()?></p></li>
                        <li><p><span class="fa fa-child" style="width:30px;"></span><?= $Student->getAge()?> yrs old</p></li>
                    </ul>
                    <hr>
                    <div class="col-sm-5 col-xs-6 tital " >Date Of Joining: <?= Util::date($Student->getDate())?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Student Analysis</strong>
                </div>
                <div class="card-body">
                    <table id="courses" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Lesson</th>
                            <th>Exam Title</th>
                            <th>Items</th>
                            <th>Score</th>
                            <th>Remarks</th>
                            <th>Attempt/s</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($StudentAnalysis)) {
                            foreach ($StudentAnalysis as $details) {
                                $remarks = ($details['remarks'] == 1 ? 'Pass' : 'Failed');
                                $html = "<tr>";
                                $html .= "<td>{$details['lessonTitle']}</td>";
                                $html .= "<td>{$details['examTitle']}</td>";
                                $html .= "<td>{$details['items']}</td>";
                                $html .= "<td>{$details['score']}</td>";
                                $html .= "<td>{$remarks}</td>";
                                $html .= "<td>{$details['attempts']}</td>";
                                print $html;
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
</div>