<div class="d-flex flex-row justify-content-between p-3">
    <div class="w-25">
        <ul class="list-group position-fixed">
            <li class="list-group-item"><a href="<?php echo APP_URL; ?>">All</a></li>

            <?php foreach ($this->categories as $key => $value): ?>
            <li class="list-group-item"><a href="<?php echo $this->url->to('home/category/') . $value['name']; ?>"><?php echo $value['name']; ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>
    <div class="w-50">

        <?php foreach ($this->posts as $key => $value): ?>
        <div class="">
            <h3><?php echo $value['title']; ?></h3>
            <p>Category: <?php echo $value['category_name']; ?></p>
            <p><?php echo $value['body']; ?></p>
            <p>Created at: <?php echo $value['created_at']; ?></p>
        </div>
        <?php endforeach ?>

    </div>
    <aside class="w-25">
        <div class="col">
            <h5>Some Adverts here..</h5>
        </div>
    </aside>
</div>