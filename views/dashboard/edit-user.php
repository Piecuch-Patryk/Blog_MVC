<div class="container">
    <div class="row">
        <div class="col">
            <h1>Edit user - <?php echo $this->fullName; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-10 mx-auto">
            <form action="<?php echo $this->url->to('user/update') ?>" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" value="<?php echo $this->name; ?>" class="form-control" aria-describedby="name">
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input name="surname" type="text" value="<?php echo $this->surname; ?>" class="form-control" aria-describedby="surname">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text" value="<?php echo $this->email; ?>" class="form-control text-muted" disabled aria-describedby="surname">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control">
                        <option value="user" <?php echo $this->role === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $this->role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="owner" <?php echo $this->role === 'owner' ? 'selected ' : ''; echo $this->loggedUserRole !== 'owner' ? 'disabled' : ''; ?>>Owner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="created_at">Created at</label>
                    <input name="created_at" type="text" value="<?php echo $this->created_at; ?>" class="form-control text-muted" disabled aria-describedby="created at">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>