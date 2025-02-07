<?php
require_once '../app/bootstrap.php';

try {
    // Get database instance and attempt connection
    $db = Database::getInstance()->getConnection();
    $connectionMessage = "Database connection successful!";
} catch (Exception $e) {
    $connectionMessage = "Database connection failed: " . $e->getMessage();
}

$init = new Core();
?>

<!DOCTYPE html>
0
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Youdemy</title>
</head>
<body>
<h1>Welcome to Youdemy</h1>
<p><?php echo $connectionMessage; ?></p>

</body>
</html>