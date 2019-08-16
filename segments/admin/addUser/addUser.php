<form action="admin.php?page=addUser" method="post">
    <div class="row right">
        <div class="col-md-12 p-3">
            <button type="submit" class="btn btn-success float-right" name="submit" value="Save">Save</button>
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
                            <label class="input-group-text" for="gender3">Role</label>
                        </div>
                        
                        <select class="custom-select" id="gender3">
                            <option selected>Choose...</option>
                            <?php
                            $roles = Role::loadArray();
                            $html = '';
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