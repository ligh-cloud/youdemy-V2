<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
<h1>Profile</h1>
<p>Welcome, <?php echo $_SESSION['nom'] . ' ' . $_SESSION['prenom']; ?></p>
<p>Email: <?php echo $_SESSION['email']; ?></p>
<p>Role: <?php echo $_SESSION['role']; ?></p>
</body>
</html>