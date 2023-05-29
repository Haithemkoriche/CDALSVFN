<?php
include('config/bdd.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Start output buffering
    ob_start();

    // Retrieve the form data
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $dateNaissance = $_POST["date_naissance"];
    $lieuNaissance = $_POST["lieu_naissance"];
    $numeroTelephone = $_POST["numero"];
    $adresse = $_POST["addres"];

    // Prepare the SQL statement
    $sql = "INSERT INTO participants (Nom_p, prenom_p, addres_p, Email_p, telephon_p, date_n_p, lieu_n_p) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nom, $prenom, $adresse, $email, $numeroTelephone, $dateNaissance, $lieuNaissance);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Form data saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();

    // Generate PDF file
    require('fpdf/fpdf.php');

    // Create a new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font and size
    $pdf->SetFont('Arial', 'B', 14);

    // Output form data
    $pdf->Cell(0, 10, 'Form Data', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'Nom:', 0);
    $pdf->Cell(0, 10, $nom, 0, 1);

    $pdf->Cell(40, 10, 'Prénom:', 0);
    $pdf->Cell(0, 10, $prenom, 0, 1);

    $pdf->Cell(40, 10, 'Email:', 0);
    $pdf->Cell(0, 10, $email, 0, 1);

    $pdf->Cell(40, 10, 'Date de Naissance:', 0);
    $pdf->Cell(0, 10, $dateNaissance, 0, 1);

    $pdf->Cell(40, 10, 'Lieu de Naissance:', 0);
    $pdf->Cell(0, 10, $lieuNaissance, 0, 1);

    $pdf->Cell(40, 10, 'Numéro Téléphone:', 0);
    $pdf->Cell(0, 10, $numeroTelephone, 0, 1);

    $pdf->Cell(40, 10, 'Adresse:', 0);
    $pdf->Cell(0, 10, $adresse, 0, 1);

    // Save PDF file
    $pdf->Output('form_data.pdf', 'D');

    // Clear the output buffer
    ob_end_clean();
}
?>
<?php include('layouts/header.html'); ?>

<div class="container">
  <div class="text-center mb-5 mt-5">
    <h1 class="display-5">Rejoignez notre centre de développement d'activités de loisirs et scientifiques !
    </h1>
    <p class="lead"> Découvrez de nouveaux passe-temps, développez des compétences et rencontrez des personnes
      partageant les mêmes centres d'intérêt dans notre centre de loisirs et scientifique. Inscrivez-vous dès
      maintenant pour une vie plus enrichissante et passionnante !</p>
  </div>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="row needs-validation" novalidate>
    <div class="row mt-2 mb-2">
      <div class="col-md-6">
        <label for="nom" class="form-label">Nom :</label>
        <input type="text" id="nom" name="nom" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label for="prenom" class="form-label">Prénom :</label>
        <input type="text" id="prenom" name="prenom" class="form-control">
      </div>
    </div>
    <label for="email" class="form-label">Email :</label>
    <input type="email" name="email" id="email" class="form-control" required>
    <div class="row mt-2 mb-2">
      <div class="col-md-6">
        <label for="date-naissance" class="form-label">Date de Naissance : </label>
        <input type="date" name="date_naissance" id="date-naissance" class="form-control">
      </div>
      <div class="col-md-6">
        <label for="lieu" class="form-label">Lieu de Naissance :</label>
        <input type="text" name="lieu_naissance" id="lieu" class="form-control">
      </div>
    </div>
    <label for="numero" class="form-label">Numero Téléphone : </label>
    <input type="tel" name="numero" id="numero" class="form-control">
    <label for="addres" class="form-label mt-2 mb-2">Votre Adresse :</label>
    <input type="text" class="form-control" id="addres" name="addres">
    <div class="mt-5 mb-2 me-5 d-flex justify-content-end ">
      <input type="submit" value="S'inscrir" class="btn btn-primary p-3 pe-5 ps-5">
    </div>
  </form>
</div>

<?php include('layouts/footer.html'); ?>
