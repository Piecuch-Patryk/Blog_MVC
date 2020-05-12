<div class="container">
    <div class="row">
        <div class="col">
            <h1>Edit post - <?php echo $this->posted_data['title']; ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form action="<?php echo $this->url->to('post/update'); ?>" method="post">
                <input type="hidden" name="post_id" value="<?php echo $this->posted_data['id']; ?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" value="<?php echo isset($this->posted_data['title']) ? $this->posted_data['title'] : ''; ?>" class="form-control" aria-describedby="title">
                    
                    <?php if ($this->e_title): ?>
                    <p class="text-danger"><?php echo $this->e_title ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <textarea name="body" class="form-control"><?php echo isset($this->posted_data['body']) ? $this->posted_data['body'] : ''; ?></textarea>

                    <?php if ($this->e_body): ?>
                    <p class="text-danger"><?php echo $this->e_body ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" class="form-control" aria-describedby="category">
                        <?php foreach ($this->categories as $key => $value): ?>
                        <option <?php echo $value['id'] === $this->posted_data['category_id'] ? 'selected' : ''; ?> value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>