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
                        <div class="counter_form_title" style="padding-top: 5vh;">Register Now</div>
                        <div class="counter_form">
                            <label>Date</label>
                            <input type="date" class="counter_input" disabled name="date" value="<?php echo date('Y-m-d');?>">
                        </div>
                        <div class="counter_form">
                            <label >Name of Student</label>
                            <input type="text" class="counter_input" name="name">
                        </div>
                        <div class="counter_form">
                            <label >School</label>
                            <input type="text" class="counter_input" name="school">
                        </div>
                        <div class="counter_form">
                            <label >Address</label>
                            <input type="text" class="counter_input" name="address">
                        </div>
                        <div class="counter_form">
                            <label >Contact No</label>
                            <input type="text" class="counter_input" name="contact">
                        </div>
                        <div class="counter_form">
                            <label >Grade Level</label>
                            <input type="text" class="counter_input" name="gradeLevel">
                        </div>
                        <div class="counter_form">
                            <label >Birthday (dd/MM/yyyy)</label>
                            <input type="date" class="counter_input" name="birthday" value="<?php echo date('Y-m-d');?>">
                        </div>
                         <div class="counter_form">
                            <label >Age</label>
                            <input type="number" class="counter_input" name="age">
                         </div>
                         <div class="counter_form">
                            <label >Email Address</label>
                            <input type="email" class="counter_input" name="emailAddress">
                         </div>
                         <div class="counter_form">
                            <label >Allergies</label>
                            <input type="text" class="counter_input" name="allergies">
                         </div>
                        <?php
                            $courses =  Course::LoadArray();
                        ?>
                        <div class="counter_form">
                            <label >Program</label>
                            <select multiple="multiple" class="counter_input" name="program[]" style="display: none;" id="program[]">
                                <?php foreach ($courses as $Course) {
                                    $courseName =  $Course->getCourseName();
                                    ?>
                                    <option value="<?= $courseName; ?>"><?= $courseName; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                         <div class="counter_form">
                            <label >Mother's Name</label>
                            <input type="text" class="counter_input" name="mothersName">
                         </div>
                         <div class="counter_form">
                            <label >Mother Occupation</label>
                            <input type="text" class="counter_input" name="motherOccupation">
                </div>
                         <div class="counter_form">
                            <label >Mother Office Address</label>
                            <input type="text" class="counter_input" name="motherOfficeAddress">
                         </div>
                         <div class="counter_form">
                            <label >Mother Tel. No</label>
                            <input type="text" class="counter_input" name="motherTelNo">
                         </div>
                         <div class="counter_form">
                            <label >Father's Name</label>
                            <input type="text" class="counter_input" name="fathersName">
                         </div>
                         <div class="counter_form">
                            <label >Father Occupation</label>
                            <input type="text" class="counter_input" name="fatherOccupation">
                         </div>
                        <div class="counter_form">
                            <label >Father Office Address</label>
                            <input type="text" class="counter_input" name="fatherOfficeAddress">
                        </div>
                        <div class="counter_form">
                            <label >Father Tel. No</label>
                            <input type="text" class="counter_input" name="fatherTelNo">
                        </div>
                        <div class="counter_form">
                            <label >No. of Siblings</label>
                            <input type="number" class="counter_input" name="noOfSiblings">
                        </div>
                        <div class="counter_form">
                            <label >Other Programs Being Attended In The City</label>
                            <input type="text" class="counter_input" name="otherProgram">
                        </div>
                        <div class="counter_form">
                            <label >Suggestions</label>
                            <textarea style="height: 20vh;" class="counter_input" name="suggestions"> </textarea>
                        </div>
                        <div class="counter_form">
                            <label >Others</label>
                            <input type="text" class="counter_input" name="others">
                        </div>
                        <button type="submit" name="register" class="counter_form_button">submit now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>