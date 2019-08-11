<?php
if (!empty(Util::getParam('submit')) && Util::getParam('submit') == 'save') {
    $name    = Util::getParam('name');
    $surname = Util::getParam('surname');
    $mname   = Util::getParam('mname');
    $uname   = Util::getParam('uname');
    $phone   = Util::getParam('phone');
    $email   = Util::getParam('email');
    $pass    = 'admin123';
    $role    = Util::getParam('role');

    if (User::addUser($name, $surname, $uname, $mname, $email, $pass, $role)) {
        $message = ['result' => 'success', 'message' => 'Successfully added user'];
    } else {
        $message = ['result' => 'failed', 'message' => 'Failed to insert user'];
    }
}
?>
<?php if (!empty($message) && $message['result'] == 'failed'): ?>
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        <span class="badge badge-pill badge-danger">Success</span>
        You successfully read this important alert.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php elseif(!empty($message) && $message['result'] == 'success'):?>
    <div class="sufee-alert alert with-close alert-success  alert-dismissible fade show">
        <span class="badge badge-pill badge-success ">Success</span>
        You successfully read this important alert.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>
<form action="admin.php?page=addUser" method="post">
    <div class="row right">
        <div class="col-md-12 p-3">
            <button type="submit" class="btn btn-success float-right" name="submit" value="save">Save</button>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>User Details</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname">
                </div>
                <div class="form-group">
                    <label for="mname">Middle Name</label>
                    <input type="text" class="form-control" id="mname" name="mname">
                </div>
                <div class="form-group">
                    <label for="uname">Username</label>
                    <input type="text" class="form-control" id="uname" name="uname">
                </div>
                <div class="form-group">
                    <label for="phone">Phone No.</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="pwd">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>


            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>User Privilege</h4></div>
            <div class="card-body">
                <div class="form-group"><div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="role">Role</label>
                        </div>

                        <select class="custom-select" id="role" name="role">
                            <option selected>Choose...</option>
                            <?php
                            $roles = Role::loadArray();
                            $html  = '';
                            foreach ($roles as $role) {
                                $html .= "<option value='{$role['id']}'>{$role['role_name']}</option>";
                            }
                            print $html;
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>