<div class="container">
    <div class="row">
        <div class="col">
            <h1>All your posts</h1>
        </div>
    </div>

    <?php if ($this->db_error): ?>
    <div class="row">
        <div class="col">
            <p class="text-danger">Could not load Your posts. Please, try again later.</p>
        </div>
    </div>
    <?php endif ?>

    <?php if ($this->post_created): ?>
    <div class="row">
        <div class="col">
            <p class="text-success">Post created successfully!</p>
        </div>
    </div>
    <?php endif ?>

    <div class="row">
        <?php foreach ($this->posts as $key => $value): ?>
        <div class="col-5">
            <h3><?php echo $value['title']; ?></h3>
            <p><?php echo $value['body']; ?></p>
            <p><?php echo $value['created_at']; ?></p>
        </div>
        <?php endforeach ?>
    </div>
</div>