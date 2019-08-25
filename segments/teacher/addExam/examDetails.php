<?php
$cid     = Util::getParam('cid');
$course  = Course::load($cid);
//let us now load the form to handle the exam
?>


<form action="teacher.php">
    Please Select a Lesson :
    <?php
    $lessons = $course->getLessons();

    $html = "<select>";
    foreach ($lessons as $lesson) {
        $html .= "<option>".$lesson->getTitle()."</option>";
    }
    $html .= "<select>";


    print $html;
    ?>

    <!-- Input Questions-->
    <br>Please Select exam type :
    <select name="examType">
        <option value="1">Essay</option>
        <option value="1">Multiple Choice</option>
        <option value="1">Fill in the Blank</option>
    </select>
    <br>
    Question:

    <input type="text" name="question"><br>
    Plese put the choices seperated by two forward slash's (//)
    <input type="text" name ="choices">
</form>
