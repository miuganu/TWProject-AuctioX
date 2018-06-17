<div class="container-bubble container-bubble--small <?php if (empty($errors) === false) echo 'error-form'; ?>" >
    <form class="small-form" action="login.php" method="post">
        <h1 class="small-form-title">Sign In</h1>
        <input type="text" placeholder="username" class="login-input" name="username" required>
        <input type="password" placeholder="password" class="login-input" name="password" required>
        <div class="error-message"> <?php echo output_errors($errors); ?> </div>
        <button type="submit" class="login-button">Login</button>
    </form>
</div>

<h1 class="container-title">AuctioX</h1>

<div class="container-bubble container-bubble--mini">
    <a class="sing-un-button" style="width: 90%; margin-bottom: 0" href="SignUp.php"> Make an account</a>
</div>
</main>
</div>
</body>
</html>