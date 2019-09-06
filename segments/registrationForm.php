<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<div class="counter">
    <div class="counter_background" style="background-image:url(images/piagotsky2.jpg)"></div>
    <div style="padding-left: 28vw;" class="container">
        <div class="row">
        </div>
        <div class="counter_form" style="padding-bottom: 5vh;">
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
<script>
    $(document).ready(function(){
        $(function(){
            $("select").dashboardCodeBsMultiSelect();
        });
        $("select").bsMultiSelect({
            selectedPanelDefMinHeight: 'calc(2.25rem + 2px)',
            selectedPanelLgMinHeight: 'calc(2.875rem + 2px)',
            selectedPanelSmMinHeight: 'calc(1.8125rem + 2px)',
            selectedPanelDisabledBackgroundColor: '#e9ecef',
            selectedPanelFocusBorderColor: '#80bdff',
            selectedPanelFocusBoxShadow: '0 0 0 0.2rem rgba(0, 123, 255, 0.25)',
            selectedPanelFocusValidBoxShadow: '0 0 0 0.2rem rgba(40, 167, 69, 0.25)',
            selectedPanelFocusInvalidBoxShadow: '0 0 0 0.2rem rgba(220, 53, 69, 0.25)',
            filterInputColor: '#495057',
            selectedItemContentDisabledOpacity: '.65',
            dropdDownLabelDisabledColor: '#6c757d',
            containerClass: 'dashboardcode-bsmultiselect',
            dropDown: '<a href="https://www.jqueryscript.net/menu/">Menu</a>',
            Class: 'dropdown-menu',
            dropDownItemClass: 'px-2',
            dropDownItemHoverClass: 'text-primary bg-light',
            selectedPanelClass: 'form-control',
            selectedItemClass: 'badge',
            removeSelectedItemButtonClass: 'close',
            filterInputItemClass: '',
            filterInputClass: ''
    });
    });
</script>