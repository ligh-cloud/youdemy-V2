<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<h1>Sign Up</h1>
<form action="<?php echo URLROOT; ?>/userController/signup" method="POST">
    <input type="text" name="Fname" placeholder="First Name" required>
    <input type="text" name="Lname" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role" required>
        <option value="1">Admin</option>
        <option value="2">Teacher</option>
        <option value="3">Student</option>
    </select>
    <button type="submit">Sign Up</button>
</form>
<?php if (isset($data['error'])): ?>
    <p style="color: red;"><?php echo $data['error']; ?></p>
<?php endif; ?>

<?php if (isset($_SESSION['signup_success'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Inscription réussie!',
            text: 'Votre compte a été créé avec succès.',
            confirmButtonText: 'OK'
        });
        <?php unset($_SESSION['signup_success']); // Unset the session variable after displaying the message ?>
    </script>
<?php endif; ?>
</body>
</html>