<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Définir les variables
$nom = "";
$prenom = "";
$email = "";
$telephone = "";
$adresse = "";
$evenement_id = "";
$success = false;

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les données du formulaire
  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $email = $_POST["email"];
  $telephone = $_POST["telephone"];
  $adresse = $_POST["adresse"];
  $evenement_id = $_POST["evenement_id"];

  // Préparer et exécuter la requête d'insertion des données du participant
  $stmt = $conn->prepare("INSERT INTO participant_evenement (nom_p_e, prenom_p_e, email_p_e, telephone_p_e, adresse_p_e, evenement_id) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $nom, $prenom, $email, $telephone, $adresse, $evenement_id);
  $stmt->execute();

  // Vérifier si l'insertion a réussi
  if ($stmt->affected_rows == 1) {
    $success = true;
    header("Location: participants.php?evenement_id=".$evenement_id."&add=true?");
    exit();
  }
}
?>

<?php include("../layout.php"); ?>

<head>
  <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
  <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
  <h2><a href="participants.php?evenement_id=<?php echo @$_GET['evenement_id']; ?>" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Ajouter un participant</h2>
  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <input type="hidden" name="evenement_id" value="<?php echo @$_GET['evenement_id']; ?>">
    <div class="form-group">
      <label for="nom">Nom :</label>
      <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>">
    </div>
    <div class="form-group">
      <label for="prenom">Prénom :</label>
      <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenom; ?>">
    </div>
    <div class="form-group">
      <label for="email">Email :</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="form-group">
      <label for="telephone">Téléphone :</label>
      <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $telephone; ?>">
    </div>
    <div class="form-group">
      <label for="adresse">Adresse :</label>
      <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $adresse; ?>">
    </div>
    <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
  </form>
</div>

<?php include("../footer.html"); ?>