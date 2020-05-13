<div class="container">
    <div class="row">
        <div class="col">
            <h1><?php echo $this->post['title'] ?></h1>
            <p>Category: <?php echo $this->post['category_name']; ?></p>
            <p>Author: <?php echo $this->post['user_name'] . ' ' . $this->post['user_surname']; ?></p>
            <p><?php echo $this->post['body']; ?></p>
            <p>Created: <?php echo $this->post['created_at']; ?></p>
        </div>
    </div>
</div>