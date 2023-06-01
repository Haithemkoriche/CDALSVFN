<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION["admin_email"])) {
  header("Location: index.html");
  exit();
}

// Retrieve the admin email from the session
$adminEmail = $_SESSION["admin_email"];

// Display welcome message or perform admin-specific actions
// ...

// Logout functionality
if (isset($_GET["logout"])) {
  session_destroy();
  header("Location: index.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/fonts/css/all.css" />
    <link rel="stylesheet" href="../assets/fonts/css/fontawesome.css" />
    <link rel="stylesheet" href="../assets/fonts/css/all.min.css" />
    <link rel="stylesheet" href="../assets/fonts/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.3.0/font-awesome-animation.min.css" />

    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="../admin_panel.php">
              <?php  echo "Welcom,  $adminEmail";?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin_panel.php">Dashboard</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="?logout">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container mt-5"></div>
  </body>
</html>
