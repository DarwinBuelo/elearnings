<script>
.column {
    float: left;
    width: 50%;
    padding: 10px;
}
.row:after {
    content: "";
    display: table;
    clear: both;
}
</script>
<!--Edit Exam Modal-->
<div class="modal fade" id="ExamForm" tabindex="-1" role="dialog" aria-labelledby="ExamForm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" style="width: 65vw">
            <div class="modal-header">
                <h5 class="modal-title" id="ExamForm">Exam Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="width: 65vw">

                <form action="#" method="post" id="formEditExam">
                    <input type="hidden" class="form-control" id="examID" value="<?= $eid; ?>">
                    <input type="hidden" class="form-control" id="courseID" value="<?= $cid; ?>">
                    <input type="hidden" class="form-control" id="lessonID" value="<?= $lessonID; ?>">
                    <div class="form-group" style="margin-left: 20px">
                        <div class="row">
                            <div class="column" style="width: 50%">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="eid" value="<?= isset($eid) ? $eid : null ?>">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="lessonID">Lesson </label>
                                    </div>
                                        <?php
                                            $lessons = $course->getLessons();
                                            $html = null;
                                            foreach ($lessons as $lesson) {
                                                if (isset($lessonID) && $lessonID == $lesson->getLessonID()) {
                                                    ?><input type="text" class="form-control" value="<?= $lesson->getTitle(); ?>" disabled><?php
                                                }
                                            }
                                        ?>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="examType">Exam Type</label>
                                    </div>
                                    <select name="examType" id="examType" class="custom-select" onchange="exampTypeFunction()">
                                        <option>Choose...</option>
                                        <?php
                                            $types = Exam::getExamTypes();
                                            $html = null;
                                            foreach ($types as $key => $value) {
                                                $html .= "<option value='" . $key . "'>" . $value . "</option>";
                                            }
                                            print $html;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea type="text" class="form-control" id="question" name="question"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="points">Points</label>
                                    <input type="number" class="form-control" id="points" name="points" value="1">
                                </div>
                                <div class="form-group" id="answerContainerSelect">
                                    <label for="selectAnswer">Correct Answer</label>
                                    <select name="selectAnswer" id="selectAnswer" class="custom-select">
                                        <option>Choose...</option>
                                        <?php
                                            $html = '';
                                            $html .= "<option value='true'>true</option>";
                                            $html .= "<option value='false'>false</option>";
                                            print $html;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="answerContainerText">
                                    <label for="answer">Correct Answer</label>
                                    <input type="text" class="form-control" id="answer" name="answer">
                                </div>
                                <div class="form-group">
                                    <label for="examOptions" id="labelChoice">Choices</label>
                                    <input type="text" class="form-control" id="examOptions0" name="examOptions0">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="examOptions1" name="examOptions1">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="examOptions2" name=examOptions2">
                                </div>
                            </div>
                            <div class="column" style="margin-left: 20px; width: 40%;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="chooseQuestion">Questions</label>
                                    </div>
                                    <select class="custom-select" onchange="displayFunction()" id="chooseQuestion" name="chooseQuestion">
                                        <option>Choose...</option>
                                    </select>
                                </div>
                                <div class="form-group" id="editQuestionContainer">
                                    <label for="editQuestion">Edit Question</label>
                                    <textarea type="text" class="form-control" id="editQuestion" name="editQuestion"></textarea>
                                </div>
                                <div class="input-group mb-3" id="editAnswerContainer">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="lessonID">Answer</label>
                                    </div>
                                    <input type="text" class="form-control" id="editAnswer" name="editAnswer" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="answer">Points</label>
                                    <input type="number" class="form-control" id="editPoints" name="editPoints" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="answer" id="labelEditChoice">Choices</label>
                                    <input type="text" class="form-control" id="choice0" name="choice0" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="choice1" name="choice1" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="choice2" name="choice2" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="choice3" name="choice3" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary btnEdit" name="btnEdit">Edit</button>
                            <button type="submit" class="btn btn-success btnSave">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Add Exam Modal-->
<div class="modal fade" id="AddExam" tabindex="-1" role="dialog" aria-labelledby="AddExam" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ExamForm">Exam Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formAddExam" method="post">
                    <input type="hidden" class="form-control" id="teacherID" value="<?= $teacherID; ?>">
                    <input type="hidden" class="form-control" id="courseID" value="<?= $cid; ?>">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="hidden" name="eid" value="<?= isset($eid) ? $eid : null ?>">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="lessonIDEdit">Lesson </label>
                            </div>
                            <select class="custom-select" id="lessonIDEdit" name="lessonIDEdit">
                                <option>Choose...</option>
                                <?php
                                    $lessons = $course->getLessons();
                                    $html = null;
                                    foreach ($lessons as $lesson) {
                                        $html .= "<option value='" . $lesson->getLessonID() . "'>" . $lesson->getTitle() . "</option>";
                                    }
                                    print $html;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="attempts">Attempts</label>
                            <input type="number" class="form-control" id="attempts" name="attempts">
                        </div>
                        <div class="form-group">
                            <label for="items">Items</label>
                            <input type="number" class="form-control" id="items" name="items">
                        </div>
                        <div class="form-group">
                            <label for="passingScore">Passing Score</label>
                            <input type="number" class="form-control" id="passingScore" name="passingScore">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration (Minutes)</label>
                            <input type="number" class="form-control" id="duration" name="passingScore">
                        </div>
                        <div class="form-group">
                            <label for="examDate">Start Date</label>
                            <input type="datetime-local" class="form-control" name="examDate" id="examDate" value="<?= $datetime->format('Y-m-d\TH:i:s'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="examDue">Due Date</label>
                            <input type="datetime-local" class="form-control" name="examDue" id="examDue" value="<?= $datetime->format('Y-m-d\TH:i:s'); ?>" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>