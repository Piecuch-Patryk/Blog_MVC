<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo APP_URL; ?>">Blog MVC</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo APP_URL ?>">Home <span class="sr-only">(current)</span></a>
            </li>

            <!-- Hide for logged -->
            <?php if(!$this->logged): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $this->url->to('login') ?>">Login</a>
            </li>

            <!-- Logged in -->
            <?php elseif($this->logged): ?>
            <!-- Admin & Owner -->

            <?php if ($this->loggedUserRole !== 'user'): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Users
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $this->url->to('dashboard/users') ?>">All</a>
                    <a class="dropdown-item" href="<?php echo $this->url->to('dashboard/create-user') ?>">Create</a>
                </div>
            </li>
            <?php endif ?>

            <!-- Admin & Owner & User -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Posts
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $this->url->to('dashboard/posts') ?>">My posts</a>
                    <a class="dropdown-item" href="<?php echo $this->url->to('post/create') ?>">Create</a>
                </div>
            </li>

            <!-- User profile -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Profile
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $this->url->to('user/edit/') . $this->user_data['id'] ?>">Edit</a>
                    <a class="dropdown-item" href="<?php echo $this->url->to('user/logout') ?>">Logout</a>
                </div>
            </li>
            <?php endif ?>
            <!-- End logged in -->
        </ul>
    </div>
</nav>