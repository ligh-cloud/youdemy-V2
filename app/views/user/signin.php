<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<h1>Sign In</h1>
<form action="<?php echo URLROOT; ?>/userController/signin" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Sign In</button>
</form>
<?php if (isset($data['error'])): ?>
    <p style="color: red;"><?php echo $data['error']; ?></p>
<?php endif; ?>
</body>
</html>