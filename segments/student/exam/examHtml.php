<div class="counter_form" style="padding-bottom: 5vh; padding-top: 25vh">
    <div class="row fill_height">
        <div class="col fill_height">
            <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" action="" method="post">
                <div class="counter_form">
                    <div class="counter_form_title" style="padding-top: 5vh; text-align: center">Register Now</div>
                    <label>Date</label>
                    <input type="date" class="counter_input" disabled name="date" value="<?php echo date('Y-m-d');?>">
                    <label >Name of Student</label>
                    <input type="text" class="counter_input" name="name" required>
                    <label >School</label>
                    <input type="text" class="counter_input" name="school">
                </div>
            </form>
        </div>
    </div>
</div>