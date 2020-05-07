<h1>login form</h1>

<?php if (isset($this->postedData)): ?>
<p>Email or Password incorrect. Please try again.</p>
<?php endif ?>

<form action="user/login" method="post">
    <input type="text" name="email" placeholder="email" value="<?php echo isset($this->postedData) ? $this->postedData : ''; ?>">
    <input type="password" name="password" placeholder="password">
    <button>Submit</button>
</form>
