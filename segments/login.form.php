<div class="counter">
    <div class="counter_background" style="background-image:url(images/piagotsky2.jpg)"></div>
    <div style="padding-left: 28vw;" class="container">
        <div class="row">
            <div class="counter_content col-md-8 center">
                <?php if (isset($message) && !empty($message)) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Login Failed: </strong> <?= $message ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="counter_form">
            <div class="row fill_height">
                <div class="col fill_height">
                    <form id="loginPanel" class="counter_form_content d-flex flex-column align-items-center justify-content-center"
                          action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="counter_form_title">Login Now</div>
                        <input type="text" class="counter_input" name="uname" placeholder="Email Address"
                               required>
                        <input type="password" class="counter_input" name="pswd" placeholder="Password"
                               required>
                        <button type="submit" class="counter_form_button">submit now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#loginPanel').validate()
</script>
