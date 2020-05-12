<div class="container">
    <div class="row">
        <div class="col">
            <h1>Create new post</h1>

            <?php if(isset($this->db_error)): ?>
            <p>Something went wrong. Please try again.</p>
            <?php endif ?>

        </div>
    </div>
    <div class="row">
        <div class="col-10 mx-auto">
            
            <form action="<?php echo $this->url->to('post/store'); ?>" method="post">
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
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
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
