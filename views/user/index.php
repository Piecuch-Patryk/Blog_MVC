<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            <?php if (!empty($this->e_logging)): ?>
            <p class="text-danger">Email or Password incorrect. Please try again.</p>
            <?php endif ?>
            <form action="user/login" method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="text" class="form-control" aria-describedby="email" value="<?php echo isset($this->postedData) ? htmlentities($this->postedData, ENT_SUBSTITUTE) : ''; ?>">
                    <p class="text-danger"><?php echo $this->e_email; ?></p>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control">
                    <p class="text-danger"><?php echo $this->e_password; ?></p>
                </div>
                <div class="form-group form-check text-center">
                    <input name="remember-me" type="checkbox" class="form-check-input px-0">
                    <label class="form-check-label px-0" for="remeber-me">Remember me</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
