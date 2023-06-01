
  <?php
  include("config/bdd.php");
  // Vérifier si le formulaire a été soumis
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $evenementId = $_POST['evenement_id'];

    // Valider et enregistrer les données dans la base de données

    // Retrieving data from the "evenements" table
    $evenements = [];
    $sql1 = "SELECT intitule_E FROM evenements WHERE `ID_E`=$evenementId";
    $result = $conn->query($sql1);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $intituleE = $row['intitule_E'];
    }

    // Exemple de code pour enregistrer les données dans la base de données

    // Préparer la requête SQL pour insérer les données dans la table participant_evenement
    $sql = "INSERT INTO participant_evenement (nom_p_e, prenom_p_e, email_p_e, telephone_p_e, adresse_p_e, evenement_id)
            VALUES ('$nom', '$prenom', '$email', '$telephone', '$adresse', '$evenementId')";

    if ($conn->query($sql) === TRUE) {

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

      $pdf->Cell(40, 10, 'Numéro Téléphone:', 0);
      $pdf->Cell(0, 10, $telephone, 0, 1);

      $pdf->Cell(40, 10, 'Adresse:', 0);
      $pdf->Cell(0, 10, $adresse, 0, 1);

      
      $pdf->Cell(40, 10, 'Evenements:', 0);
      $pdf->Cell(0, 10, $intituleE, 0, 1);

      // Save PDF file
      $pdf->Output('form_data.pdf', 'D');

      // Redirect to another page
      // header("Location: index.php");
      // exit();
    } else {
      echo "Erreur lors de l'inscription : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
  }
  ?>

