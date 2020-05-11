<div class="container">
    <div class="row">
        <div class="col">
            <h1>Create new user</h1>

            <?php if(isset($this->user_exists)): ?>
            <p>Sorry, given email already exists in databse. Use different email address.</p>
            <?php endif ?>

            <?php if(isset($this->db_error)): ?>
            <p>Something went wrong. Please try again.</p>
            <?php endif ?>

        </div>
    </div>
    <div class="row">
        <div class="col-10 mx-auto">
            
            <form action="<?php echo $this->url->to('user/store') ?>" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" value="<?php echo isset($this->postedData['name']) ? htmlentities($this->postedData['name']) : ''; ?>" class="form-control" aria-describedby="name">
                    
                    <?php if (isset($this->errors['e_name'])): ?>
                    <p class="text-danger"><?php echo $this->errors['e_name'] ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input name="surname" type="text" value="<?php echo isset($this->postedData['surname']) ? htmlentities($this->postedData['surname']) : ''; ?>" class="form-control" aria-describedby="surname">

                    <?php if (isset($this->errors['e_surname'])): ?>
                    <p class="text-danger"><?php echo $this->errors['e_surname'] ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text" value="<?php echo isset($this->postedData['email']) ? htmlentities($this->postedData['email']) : ''; ?>" class="form-control" aria-describedby="email">

                    <?php if (isset($this->errors['e_email'])): ?>
                    <p class="text-danger"><?php echo $this->errors['e_email'] ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" aria-describedby="role">
                        <?php isset($this->posted_data['role']) ? $this->role = $this->posted_data['role'] : $this->role = ''; ?>
                        <option value="user" <?php echo $this->role === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $this->role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="owner" <?php echo $this->role === 'owner' ? 'selected' : ''; ?> <?php echo $this->role !== 'owner' ? 'disabled' : '' ?>>Owner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" aria-describedby="password">

                    <?php if (isset($this->errors['e_password'])): ?>
                    <p class="text-danger"><?php echo $this->errors['e_password'] ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="password-repeat">Password Repeat</label>
                    <input name="password-repeat" type="password" class="form-control" aria-describedby="password repeat">

                    <?php if (isset($this->errors['e_password_repeat'])): ?>
                    <p class="text-danger"><?php echo $this->errors['e_password_repeat'] ?></p>
                    <?php endif ?>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
