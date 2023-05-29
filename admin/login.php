<?php
session_start();

include('config/bdd.php');

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
  } else {
    // Admin credentials are invalid, show error message
    echo "Invalid email or password";
  }

  // Close the statement and database connection
  $stmt->close();
  $conn->close();
}
?>
