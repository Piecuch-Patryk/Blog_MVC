<!-- All users -->
<a href="<?php echo APP_URL ?>">Home</a>
<a href="<?php echo $this->url->to('posts') ?>">Posts</a>

<!-- Hide for logged -->
<?php if(!$this->logged): ?>
<a href="<?php echo $this->url->to('login') ?>">Login</a>
<!-- Logged users -->
<?php elseif($this->logged): ?>
<a href="<?php echo $this->url->to('dashboard/create-user') ?>">Create User</a>
<a href="<?php echo $this->url->to('') ?>">Create Post</a>
<a href="<?php echo $this->url->to('') ?>">My Posts</a>
<a href="<?php echo $this->url->to('user/logout') ?>">Logout</a>
<?php endif ?>