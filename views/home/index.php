<div class="container">
    <div class="row">
        <div class="col">
            <h1>Home page</h1>
        </div>
    </div>

    <div class="row">

        <?php foreach ($this->posts as $key => $value): ?>
        <div class="col-5 mx-auto">
            <h3><?php echo $value['title']; ?></h3>
            <p><?php echo $value['body']; ?></p>
            <p>Created at: <?php echo $value['created_at']; ?></p>
        </div>
        <?php endforeach ?>

    </div>
</div>