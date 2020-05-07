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


<form action="<?php echo $this->url->to('user/store') ?>" method="post">

    <label for="name">Name</label>
    <input name="name" type="text" value="<?php echo isset($this->postedData['name']) ? $this->postedData['name'] : ''; ?>">
    <label for="surname">Surname</label>
    <input name="surname" type="text" value="<?php echo isset($this->postedData['surname']) ? $this->postedData['surname'] : ''; ?>">
    <label for="email">Email</label>
    <input name="email" type="text" value="<?php echo isset($this->postedData['email']) ? $this->postedData['email'] : ''; ?>">
    <label for="role">Role</label>
    <select name="role">
        <?php isset($this->postedData['role']) ? $this->role = $this->postedData['role'] : $this->role = ''; ?>
        <option value="user" <?php echo $this->role === 'user' ? 'selected' : ''; ?>>User</option>
        <option value="admin" <?php echo $this->role === 'admin' ? 'selected' : ''; ?>>Admin</option>
        <option value="owner" <?php echo $this->role === 'owner' ? 'selected' : ''; ?>>Owner</option>
    </select>
    <label for="password">Password</label>
    <input name="password" type="password">
    <label for="password-repeat">Password Repeat</label>
    <input name="password-repeat" type="password">

    <button>Submit</button>

</form>