<div class="counter">
    <div class="counter_background" style="background-image:url(images/piagotsky2.jpg)"></div>
    <div style="padding-left: 28vw;" class="container">
        <div class="row">
        </div>
        <div class="counter_form" style="padding-bottom: 5vh; padding-top: 25vh">
            <div class="row fill_height">
                <div class="col fill_height">
                    <form class="counter_form_content d-flex flex-column align-items-center justify-content-center"
                          action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="counter_form">
                        <div class="counter_form_title" style="padding-top: 5vh; text-align: center">Register Now</div>
                            <label>Date</label>
                            <input type="date" class="counter_input" disabled name="date" value="<?php echo date('Y-m-d');?>">
                            <label >Name of Student</label>
                            <input type="text" class="counter_input" name="name" required>
                            <label >School</label>
                            <input type="text" class="counter_input" name="school">
                            <label >Address</label>
                            <input type="text" class="counter_input" name="address" required>
                            <label >Contact No</label>
                            <input type="text" class="counter_input" name="contact" required>
                            <label >Grade Level</label>
                            <input type="text" class="counter_input" name="gradeLevel">
                            <label >Birthday (dd/MM/yyyy)</label>
                            <input type="date" class="counter_input" name="birthday" value="<?php echo date('Y-m-d');?>" required>
                            <label >Age</label>
                            <input type="number" class="counter_input" name="age">
                            <label >Email Address</label>
                            <input type="email" class="counter_input" name="emailAddress" required>
                            <label >Allergies</label>
                            <input type="text" class="counter_input" name="allergies">
                            <?php $courses =  Course::LoadArray(); ?>
                            <label >Program</label>
                            <select multiple="multiple" class="counter_input" name="program[]" style="display: none;" id="program[]" required>
                                <?php foreach ($courses as $Course) {
                                    $courseName =  $Course->getCourseName(); ?>
                                    <option value="<?= $courseName.', '.$Course->getCourseID(); ?>"><?= $courseName; ?></option>
                                <?php } ?>
                            </select>
                            <label >Mother's Name</label>
                            <input type="text" class="counter_input" name="mothersName">
                            <label >Mother Occupation</label>
                            <input type="text" class="counter_input" name="motherOccupation">
                            <label >Mother Office Address</label>
                            <input type="text" class="counter_input" name="motherOfficeAddress">
                            <label >Mother Tel. No</label>
                            <input type="text" class="counter_input" name="motherTelNo">
                            <label >Father's Name</label>
                            <input type="text" class="counter_input" name="fathersName">
                            <label >Father Occupation</label>
                            <input type="text" class="counter_input" name="fatherOccupation">
                            <label >Father Office Address</label>
                            <input type="text" class="counter_input" name="fatherOfficeAddress">
                            <label >Father Tel. No</label>
                            <input type="text" class="counter_input" name="fatherTelNo">
                            <label >No. of Siblings</label>
                            <input type="number" class="counter_input" name="noOfSiblings">
                            <label >Other Programs Being Attended In The City</label>
                            <input type="text" class="counter_input" name="otherProgram">
                            <label >Suggestions</label>
                            <textarea style="height: 20vh;" class="counter_input" name="suggestions"> </textarea>
                            <label >Others</label>
                            <input type="text" class="counter_input" name="others">
                        <button type="submit" name="register" class="counter_form_button">submit now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>