<h1>Edit user - <?php echo $this->fullName; ?></h1>

<form action="<?php echo $this->url->to('user/update'); ?>" method="post">
    <label for="name">Name</label>
    <input name="name" type="text" value="<?php echo $this->name; ?>">

    <label for="surname">Surname</label>
    <input name="surname" type="text" value="<?php echo $this->surname; ?>">

    <label for="email">Email</label>
    <input name="email" type="text" value="<?php echo $this->email; ?>" disabled>

    <label for="role">Role</label>
    <select name="role">
        <option value="user" <?php echo $this->role === 'user' ? 'selected' : ''; ?>>User</option>
        <option value="admin" <?php echo $this->role === 'admin' ? 'selected' : ''; ?>>Admin</option>
        <option value="owner" <?php echo $this->role === 'owner' ? 'selected ' : ''; echo $this->loggedUserRole !== 'owner' ? 'disabled' : ''; ?>>Owner</option>
    </select>

    <label for="email">Created at</label>
    <input name="email" type="text" value="<?php echo $this->created_at; ?>" disabled>

    <button>Submit</button>
</form>