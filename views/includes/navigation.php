<!-- All users -->
<a href="<?php echo APP_URL ?>">Home</a>
<a href="<?php echo $this->url->to('posts') ?>">Posts</a>

<!-- Hide for logged -->
<?php if(!$this->logged): ?>
<a href="<?php echo $this->url->to('login') ?>">Login</a>

<!-- Logged in -->
<?php elseif($this->logged): ?>
<!-- Admin & Owner -->
<?php if ($this->loggedUserRole !== 'user'): ?>
<a href="<?php echo $this->url->to('dashboard/users') ?>">Users</a>
<a href="<?php echo $this->url->to('dashboard/create-user') ?>">Create User</a>
<?php endif ?>

<!-- Admin & Owner & User -->
<a href="<?php echo $this->url->to('') ?>">Create Post</a>
<a href="<?php echo $this->url->to('') ?>">My Posts</a>
<a href="<?php echo $this->url->to('user/logout') ?>">Logout</a>
<?php endif ?>