<?php
/**
 * get the student details
 */
$students = Student::LoadArray();
$id = Util::getParam('id');
$task = Util::getParam('task');
if(!empty($task)){
    switch ($task){
        case 'approve':
            $userApprove = Student::Load($id);
            $userApprove->setStatus(Student::STATUS_APPROVED);
            $userApprove->submit();
            $userApprove = null;
            break;
    }
}
?>
<div class="row">
    <div class="col-md-12"><h3 class="text-center">List of Student for Approval</h3></div>
</div>
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

                </div>
                <div class="card-body">
                    <table id="studentData" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Email</th>
                            <th>Program</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($students as $student) {
                            if ($student->getStatus() == Student::STATUS_DISAPPROVED) {
                                $html = "<tr>";
                                $html .= "<td>" . $student->getStudentID() . "</td>";
                                $html .= "<td>" . $student->getStudentName() . "</td>";
                                $html .= "<td>" . $student->getAge() . "</td>";
                                $html .= "<td>" . $student->getEmail() . "</td>";
                                $html .= "<td>" . $student->getProgram() . "</td>";

                                $html .= "<td><a data-toggle='tooltip' title='Edit Exam' class='btn btn-success' href='admin.php?page=student&task=approve&id={$student->getStudentID()}'>Approve</a>";

                                $html .= "</td>";
                                $html .= "</tr>";

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
    jQuery('#studentData').DataTable();
</script>