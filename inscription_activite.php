<?php
include('config/bdd.php');
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];
$dateNaissance = $_POST['date_naissance'];
$lieuNaissance = $_POST['lieu_naissance'];
$groupe = $_POST['groupe'];
$activiteId = $_POST['activite_id'];

// Retrieving data from the "activities" table
$intituleA = '';
$sql1 = "SELECT titre_act FROM activities WHERE ID_act = $activiteId";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
  $row = $result1->fetch_assoc();
  $intituleA = $row['titre_act'];
}

// Retrieving data from the "groups" table
$intituleG = '';
$sql2 = "SELECT int_grp FROM groups WHERE ID_grp = $groupe";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
  $row = $result2->fetch_assoc();
  $intituleG = $row['int_grp'];
}

// Requête d'insertion des données dans la table participants
$sql = "INSERT INTO participants (Nom_p, prenom_p, addres_p, Email_p, telephon_p, date_n_p, lieu_n_p, ID_act_foreign, ID_grp_foreign)
        VALUES ('$nom', '$prenom', '$adresse', '$email', '$telephone', '$dateNaissance', '$lieuNaissance', '$activiteId', '$groupe')";

if ($conn->query($sql) === TRUE) {

  // Générer le fichier PDF
  require('fpdf/fpdf.php');

  // Créer une nouvelle instance PDF
  $pdf = new FPDF();
  $pdf->AddPage();

  // Définir la police et la taille
  $pdf->SetFont('Arial', 'B', 14);
 
  // Afficher les données du formulaire
  $pdf->Cell(0, 10, 'Form Data', 0, 1, 'C');
  $pdf->Ln(10);

  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(40, 10, 'Nom:', 0);
  $pdf->Cell(0, 10, $nom, 0, 1);

  $pdf->Cell(40, 10, 'Prenom:', 0);
  $pdf->Cell(0, 10, $prenom, 0, 1);

  $pdf->Cell(40, 10, 'Email:', 0);
  $pdf->Cell(0, 10, $email, 0, 1);

  $pdf->Cell(40, 10, 'Numero Telephone:', 0);
  $pdf->Cell(0, 10, $telephone, 0, 1);

  $pdf->Cell(40, 10, 'Adresse:', 0);
  $pdf->Cell(0, 10, $adresse, 0, 1);

  $pdf->Cell(40, 10, 'Date de naissance:', 0);
  $pdf->Cell(0, 10, $dateNaissance, 0, 1);

  $pdf->Cell(40, 10, 'Lieu de naissance:', 0);
  $pdf->Cell(0, 10, $lieuNaissance, 0, 1);

  $pdf->Cell(40, 10, 'Activite:', 0);
  $pdf->Cell(0, 10, $intituleA, 0, 1);

  $pdf->Cell(40, 10, 'Groupe:', 0);
  $pdf->Cell(0, 10, $intituleG, 0, 1);

  // Sauvegarder le fichier PDF
  $pdf->Output('form_data.pdf', 'D');
  

  // Rediriger vers une autre page
  // header("Location: index.php");
  // exit();
} else {
  echo "Erreur lors de l'enregistrement : " . $conn->error;
}

$conn->close();
