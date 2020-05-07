<h1>Create new user</h1>


<?php //echo $this->userExists ?>

<?php if(isset($this->userExists)): ?>
<p>Sorry, given email already exists in databse. Use different email address.</p>
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
    <input name="name" type="text">
    <label for="surname">Surname</label>
    <input name="surname" type="text">
    <label for="email">Email</label>
    <input name="email" type="text">
    <label for="role">Role</label>
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
        <option value="owner">Owner</option>
    </select>
    <label for="password">Password</label>
    <input name="password" type="password">
    <label for="password-repeat">Password Repeat</label>
    <input name="password-repeat" type="password">

    <button>Submit</button>

</form>