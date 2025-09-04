<?php
include_once 'database.php';
include_once 'login-form.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login & Register</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
<div class="login-container">
    <?php if (!empty($message)): ?>
        <div class="msg"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
        <h2 class="login-form">Login</h2>
        <h2 class="register-form">Register</h2>
        <input class="login-input" type="email" name="email" placeholder="Email" required>
        <input class="login-input" type="password" name="password" placeholder="Password" required>
        <input class="login-input register-form" type="text" name="adress" placeholder="Adress">
        <input class="login-input register-form" type="text" name="city" placeholder="City">
        <input class="login-input register-form" type="text" name="fullname" placeholder="Full name">
        <button class="login-btn login-form" type="submit" name="action" value="login">Login</button>
        <p id="no-acc" class="login-question login-form">Don't have an account?</p>
        <button class="login-btn register-form" type="submit" name="action" value="signup">Register</button>
        <p id="yes-acc" class="login-question register-form">Already have an account?</p>
    </form>
</div>
</body>
</html>