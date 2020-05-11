<h1>Create new user</h1>


<?php //echo $this->userExists ?>

<?php if(isset($this->userExists)): ?>
<p>Sorry, given email already exists in databse. Use different email address.</p>
<?php endif ?>

<?php if(isset($this->error)): ?>
<p>Something went wrong. Please try again.</p>
<?php endif ?>

<?php if (isset($this->errors)): ?>
<ul>
<?php foreach ($this->errors as $key => $value): ?>
    <li>
        <?php echo $value ?>
    </li>    
<?php endforeach ?>
</ul>
<?php endif ?>

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            
            <form action="<?php echo $this->url->to('user/store') ?>" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" value="<?php echo isset($this->postedData['name']) ? htmlentities($this->postedData['name']) : ''; ?>" class="form-control" aria-describedby="name">
                    <p class="text-danger"><?php echo $this->e_name; ?></p>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input name="surname" type="text" value="<?php echo isset($this->postedData['surname']) ? htmlentities($this->postedData['surname']) : ''; ?>" class="form-control" aria-describedby="surname">
                    <p class="text-danger"><?php echo $this->e_surname; ?></p>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text" value="<?php echo isset($this->postedData['email']) ? htmlentities($this->postedData['email']) : ''; ?>" class="form-control" aria-describedby="email">
                    <p class="text-danger"><?php echo $this->e_email; ?></p>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" aria-describedby="role">
                        <?php isset($this->postedData['role']) ? $this->role = $this->postedData['role'] : $this->role = ''; ?>
                        <option value="user" <?php echo $this->role === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $this->role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="owner" <?php echo $this->role === 'owner' ? 'selected' : ''; ?>>Owner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" aria-describedby="password">
                    <p class="text-danger"><?php echo $this->e_password; ?></p>
                </div>
                <div class="form-group">
                    <label for="password-repeat">Password Repeat</label>
                    <input name="password-repeat" type="password" class="form-control" aria-describedby="password repeat">
                    <p class="text-danger"><?php echo $this->e_password_repeat; ?></p>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
