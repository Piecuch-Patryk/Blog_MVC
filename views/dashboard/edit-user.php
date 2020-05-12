<div class="container">
    <div class="row">
        <div class="col">
            <h1>Edit user - <?php echo isset($this->full_name) ? $this->full_name : 'nothing found'; ?></h1>
        </div>
    </div>

    <?php if (isset($this->user_data_error) || isset($this->db_error) || isset($this->user_not_found)): ?>
    <div class="row">
        <div class="col">
            <p class="text-danger">Colud not load user's data. Please try again later.</p>
        </div>
    </div>
    <?php endif ?>

    <div class="row">
        <div class="col-10 mx-auto">
            <form action="<?php echo $this->url->to('user/update/') . $this->id; ?>" method="post">
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
                    <input name="email" type="text" value="<?php echo $this->email; ?>" class="form-control text-muted" readonly aria-describedby="email">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" <?php $this->role = isset($this->role) ? $this->role : 'user' ; ?>>
                        <option value="user" <?php echo $this->role === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $this->role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="owner" <?php echo $this->role === 'owner' ? 'selected ' : ''; echo $this->logged_user_role !== 'owner' ? 'disabled' : ''; ?>>Owner</option>
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