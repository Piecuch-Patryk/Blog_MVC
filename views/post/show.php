<div class="container text-center">

    <?php if ($this->db_error): ?>
    <div class="row">
        <div class="col">
            <p class="text-danger text-center">Something went wrong. Did not find the post.</p>
        </div>
    </div>
    <?php endif ?>

    <?php if ($this->db_error_comment): ?>
    <div class="row">
        <div class="col">
            <p class="text-danger text-center">Something went wrong. Could not upload your comment. Please try again later.</p>
        </div>
    </div>
    <?php endif ?>

    <?php if ($this->validate_error): ?>
    <div class="row">
        <div class="col">
            <p class="text-danger text-center">Your comment is not valid. Please check the comment form below.</p>
        </div>
    </div>
    <?php endif ?>

    <?php if ($this->comment_added): ?>
    <div class="row">
        <div class="col">
            <p class="text-success text-center">Your comment has been added. Thanks for your opinion.</p>
        </div>
    </div>
    <?php endif ?>

    <article class="row">
        <div class="col">
            <h1><?php echo $this->post['title'] ?></h1>
            <p>Category: <?php echo $this->post['category_name']; ?></p>
            <p>Author: <?php echo $this->post['user_name'] . ' ' . $this->post['user_surname']; ?></p>
            <p><?php echo $this->post['body']; ?></p>
            <p>Created: <?php echo $this->post['created_at']; ?></p>
        </div>
    </article>

    <section class="row border py-3">
        <div class="col-12">
            <h2>Share your opinion about the article</h2>
        </div>
        <div class="col-12">
            <form action="<?php echo $this->url->to('comment/store'); ?>" method="post">
                <input type="hidden" name="post_id" value="<?php echo $this->post['id']; ?>">
                <div class="form-group text-left">
                    <label for="name">Name</label>
                    <input name="name" type="text" value="<?php echo isset($this->posted_data['name']) ? $this->posted_data['name'] : ''; ?>" class="form-control" aria-describedby="name">
                    
                    <?php if ($this->e_name): ?>
                    <p class="text-danger"><?php echo $this->e_name; ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group text-left">
                    <label for="body">Comment</label>
                    <textarea name="body" class="form-control"><?php echo isset($this->posted_data['body']) ? $this->posted_data['body'] : ''; ?></textarea>

                    <?php if ($this->e_body): ?>
                    <p class="text-danger"><?php echo $this->e_body; ?></p>
                    <?php endif ?>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    
    <?php if ($this->related_comments): ?>
    <section class="row">
        <div class="col">
            <ul class="list-group">
                <?php foreach ($this->related_comments as $key => $value): ?>
                <li class="list-group-item">
                    <h4><?php echo $value['name']; ?></h4>
                    <p><?php echo $value['body']; ?></p>
                    <p>Created at: <?php echo $value['created_at']; ?></p>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
    </section>
    <?php else: ?>
        <div class="row">
            <div class="col">
                <p>No comments for this post yet. Add one!</p>
            </div>
        </div>
    <?php endif ?>

    <?php if (!$this->related_posts_error): ?>
    <section class="row">
        <div class="col-12">
            <h2>More from category: <?php echo $this->post['category_name']; ?></h2>
        </div>
        <div class="col-12">
            <ul class="list-group">

                <?php foreach($this->related_posts as $key => $value): ?>

                <?php if (count($this->related_posts) < 2): ?>
                    <li class="my-3 text-light">Sorry, no more articles in: <?php echo $value['category_name']; ?>.</li>

                <?php elseif ($value['id'] !== $this->post['id']): ?>
                <li class="list-group-item my-3">
                    <h3><?php echo $value['title']; ?></h3>
                    <p>Author: <?php echo $value['user_name'] . ' ' . $value['user_surname']; ?></p>
                    <p><?php echo mb_strimwidth($value['body'], 0, 100, '...'); ?> <a class="" href="<?php $this->url->to('post/show/') . $value['id']; ?>">[read more]</a></p>
                    <p>Created at: <?php echo $value['created_at']; ?></p>
                </li>
                <?php endif ?>

                <?php endforeach ?>
            </ul>
        </div>
    </section>
    <?php endif ?>
</div>