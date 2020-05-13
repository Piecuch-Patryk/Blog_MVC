<div class="d-flex flex-column">
    <div class="">
        <ul class="d-flex flex-row flex-wrap justify-content-around list-group py-2">
            <li class="list-group-item <?php echo $this->active_category === NULL ? 'bg-info' : ''; ?>"><a class="<?php echo $this->active_category === NULL ? 'text-light' : ''; ?>" href="<?php echo APP_URL; ?>">All</a></li>

            <?php foreach ($this->categories as $key => $value): ?>
            <li class="list-group-item <?php echo $this->active_category == $value['id'] ? 'bg-info' : ''; ?>"><a class="<?php echo $this->active_category == $value['id'] ? 'text-light' : ''; ?>" href="<?php echo $this->url->to('home/category/') . $value['name']; ?>"><?php echo $value['name']; ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>
    <div>

        <?php foreach ($this->posts as $key => $value): ?>
        <div class="py-4 text-center">
            <h3 class="d-inline border-bottom px-3"><?php echo $value['title']; ?></h3>
            <p>Author: <?php echo $value['user_name'] . ' ' . $value['user_surname']; ?></p>
            <p>Category: <?php echo $value['category_name']; ?></p>
            <p><?php echo $value['body']; ?></p>
            <p>Created at: <?php echo $value['created_at']; ?></p>
        </div>
        <?php endforeach ?>

    </div>
    <aside class="d-none">
        <div class="col">
            <h5>Some Adverts here..</h5>
        </div>
    </aside>
</div>