<?php
if (!empty(Util::getParam('submit')) && Util::getParam('submit') == 'save') {
    $name = ucfirst(Util::getParam('name'));
    $surname = ucfirst(Util::getParam('surname'));
    $mname = ucfirst(Util::getParam('mname'));
    $uname = Util::getParam('uname');
    $phone = Util::getParam('phone');
    $email = Util::getParam('email');
    $pass = 'admin123';
    $role = Util::getParam('role');

    if (User::addUser($name, $surname, $uname, $mname, $email, $pass, $role)) {
        $html = "<table>";
        $html .= "<tr><td>Name: </td><td>{$name} {$mname} {$surname}</td></tr>";
        $html .= "<tr><td>Phone: </td><td>{$phone}</td></tr>";
        $html .= "<tr><td>Email: </td><td>{$email}</td></tr>";
        $html .= "<tr><td>Password: </td><td>{$pass}</td></tr>";
        $html .= "</table>";

        $message = ['result' => 'success', 'message' => 'Successfully added user' . $html];
    } else {
        $message = ['result' => 'failed', 'message' => 'Failed to insert user'];
    }
}
?>
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
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" required>
                </div>
                <div class="form-group">
                    <label for="mname">Middle Name</label>
                    <input type="text" class="form-control" id="mname" name="mname" required>
                </div>
                <div class="form-group">
                    <label for="uname">Username</label>
                    <input type="text" class="form-control" id="uname" name="uname" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone No.</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>


            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>User Privilege</h4></div>
            <div class="card-body">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="role">Role</label>
                        </div>

                        <select class="custom-select" id="role" name="role" required>
                            <option selected>Choose...</option>
                            <?php
                            $roles = Role::loadArray();
                            $html = '';
                            foreach ($roles as $role) {
                                $html .= "<option value='{$role->getRoleID()}'>{$role->getRoleName()}</option>";
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