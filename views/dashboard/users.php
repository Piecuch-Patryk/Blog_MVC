<div class="container">
    <h1>All users</h1>

    <?php if ($this->user_created): ?>
    <div class="row">
        <div class="col">
            <p class="text-success">User created successfully!</p>
        </div>
    </div>
    <?php endif ?>
    
    <?php if ($this->user_updated): ?>
    <div class="row">
        <div class="col">
            <p class="text-success">User updated successfully!</p>
        </div>
    </div>
    <?php endif ?>

    <?php if ($this->delete_error): ?>
    <div class="row">
        <div class="col">
            <p class="text-danger">Something went wrong. Please try again.</p>
        </div>
    </div>
    <?php endif ?>

    <?php if ($this->delete_success): ?>
    <div class="row">
        <div class="col">
            <p class="text-success">User deleted successfully!</p>
        </div>
    </div>
    <?php endif ?>

    <!-- Desktop & Tablet -->
    <div class="row d-none d-md-block">
        <div class="col">
            <table class="table table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($this->users as $key => $value): ?>
                    <tr>
                        <th scope="row"><?php echo $value['id']; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['surname']; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $value['role']; ?></td>
                        <td><?php echo $value['created_at']; ?></td>
                        <td>
                            <!-- owner -->
                            <?php if ($this->loggedUserRole === 'owner' && $value['role'] === 'owner'): ?>
                            <a href="<?php echo $this->url->to('user/edit/') . $value['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                            <?php endif ?>
                            <!-- admin -->
                            <?php if ($value['role'] !== 'owner'): ?>
                            <a href="<?php echo $this->url->to('user/edit/') . $value['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                            <a href="<?php echo $this->url->to('user/delete/') . $value['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                            <?php endif ?>
                            <?php if ($this->loggedUserRole !== 'owner' && $value['role'] === 'owner'): ?>
                            <span class="text-muted">Restricted</span>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile only -->
    <div class="row d-block d-md-none">
        <div class="col">
            <ul class="list-group">
                <?php foreach ($this->users as $key => $value): ?>
                <li class="list-group-item">
                    <div>
                        ID: <?php echo $value['id']; ?>
                    </div>
                    <div>
                        Name: <?php echo $value['name']; ?>
                    </div>
                    <div>
                        Surname: <?php echo $value['surname']; ?>
                    </div>
                    <div>
                        Email: <?php echo $value['email']; ?>
                    </div>
                    <div>
                        Role: <?php echo $value['role']; ?>
                    </div>
                    <div>
                        Created at: <?php echo $value['created_at']; ?>
                    </div>
                    <div class="d-flex justify-content-around p-3">
                        <!-- owner -->
                        <?php if ($this->loggedUserRole === 'owner' && $value['role'] === 'owner'): ?>
                        <a href="<?php echo $this->url->to('user/edit/') . $value['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <?php endif ?>
                        <!-- admin -->
                        <?php if ($value['role'] !== 'owner'): ?>
                        <a href="<?php echo $this->url->to('user/edit/') . $value['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="<?php echo $this->url->to('user/delete/') . $value['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                        <?php endif ?>
                        <?php if ($this->loggedUserRole !== 'owner' && $value['role'] === 'owner'): ?>
                        <span class="text-muted">Actions not permitted</span>
                        <?php endif ?>
                    </div>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>


