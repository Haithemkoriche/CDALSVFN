<?php
session_start();

include('../config/bdd.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Prepare the SQL statement
  $sql = "SELECT * FROM admins WHERE email = ? AND password = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows == 1) {
    // Admin credentials are valid, set session and redirect to admin panel
    $_SESSION["admin_email"] = $email;
    header("Location: admin_panel.php");
    exit();
  } else { // Admin credentials are invalid, show error message 
    $danger= true;
  } // Close the statement and database connection
  $stmt->close();
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Admin Login</div>
          <div class="card-body">
            <form action="" method="POST">
            <?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
        Invalid email or password.
        </div>
    <?php endif; ?>
              <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required />
              </div>
              <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
              </div>
              <button type="submit" class="btn btn-primary mt-2">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>