<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION["admin_email"])) {
  header("Location: login.php");
  exit();
}

// Retrieve the admin email from the session
$adminEmail = $_SESSION["admin_email"];

// Display welcome message or perform admin-specific actions
// ...

// Logout functionality
if (isset($_GET["logout"])) {
  session_destroy();
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <span class="nav-link">Welcome, <?php echo $adminEmail; ?></span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?logout">Logout</a>
      </li>
    </ul>
    </div>
  </nav>

  <div class="container mt-5">
    <h1>Welcome to the Admin Panel</h1>
    <!-- Admin-specific actions and content -->
    <!-- ... -->
  </div>
</body>
</html>
