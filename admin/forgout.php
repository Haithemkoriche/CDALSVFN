<?php 
require_once "../config/bdd.php";
require_once "../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/PHPMailer/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/PHPMailer/src/SMTP.php';

$to_email = "korichehaithem2018@gmail.com";
$subject = "Simple Email Testing via PHP";
$body = "Hello,\nIt is a testing email sent by PHP Script";

// Initialize PHPMailer
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "webgeniusalgerie@gmail.com";
$mail->Password = "@Genius123";
$mail->SMTPSecure = "tls";
$mail->Port = 587;

$mail->setFrom("webgeniusalgerie@gmail.com");
$mail->addAddress($to_email);
$mail->Subject = $subject;
$mail->Body = $body;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $sql = "SELECT * FROM admins WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Admin credentials are valid, set session and redirect to admin panel
    if ($mail->send()) {
      $send_success = true;
    } else {
      $send_failed = true;
      echo "Mailer Error: " . $mail->ErrorInfo;
    }
    
  } else {
    // Admin credentials are invalid, show error message
    $danger = true;
  }
  $stmt->close();
  $conn->close();
}

?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">mot de pass oublié</div>
        <div class="card-body">
          <form action="" method="POST">
            <?php if (@$danger) : ?>
              <div class="alert alert-danger" role="alert">
                Invalid email.
              </div>
            <?php endif; ?>
            <?php if (@$send_success) : ?>
              <div class="alert alert-success" role="alert">
                Nous avons envoyer le mot de pass dans votre mail.
              </div>
            <?php endif; ?>
            <?php if (@$send_failed) : ?>
              <div class="alert alert-danger" role="alert">
                error .
              </div>
            <?php endif; ?>
            <div class="form-group">
              <label class="form-label" for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <button type="submit" class="btn btn-primary mt-2">Récuperer le mot de pass</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>