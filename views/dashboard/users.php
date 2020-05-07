<h1>All users</h1>

<?php if (isset($this->isUserCreated)): ?>
<p>User created successfully!</p>
<?php endif ?>

<table>
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created at</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>

<?php foreach ($this->users as $key => $value): ?>
    <tr>


        <td><?php echo $value['id'] ?></td>
        <td><?php echo $value['name'] ?></td>
        <td><?php echo $value['surname'] ?></td>
        <td><?php echo $value['email'] ?></td>
        <td><?php echo $value['role'] ?></td>
        <td><?php echo $value['created_at'] ?></td>
        <td>
            <a href="<?php echo $this->url->to('user/edit/') . $value['id'] ?>">Edit</a>
            <a href="<?php echo $this->url->to('user/delete/') . $value['id'] ?>">Delete</a>
        </td>
    </tr>
<?php endforeach ?>

</tbody>
</table>


