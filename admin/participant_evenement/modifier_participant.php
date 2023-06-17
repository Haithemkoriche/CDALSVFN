<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du participant est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
  // Récupérer l'ID du participant depuis l'URL
  $id = $_GET["id"];

  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $adresse = $_POST["adresse"];

    // Préparer et exécuter la requête de mise à jour du participant spécifié
    $stmt = $conn->prepare("UPDATE participant_evenement SET nom_p_e = ?, prenom_p_e = ?, email_p_e = ?, telephone_p_e = ?, adresse_p_e = ? WHERE id_p_e = ?");
    $stmt->bind_param("sssssi", $nom, $prenom, $email, $telephone, $adresse, $id);
    $stmt->execute();

    // Vérifier si la mise à jour a réussi
    if ($stmt->affected_rows > 0) {
      $success = true;
    } else {
      $danger = true;
    }
  }

  // Préparer et exécuter la requête pour récupérer les informations du participant spécifié
  $stmt = $conn->prepare("SELECT * FROM participant_evenement WHERE id_p_e = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  // Vérifier si le participant existe dans la base de données
  if ($result->num_rows == 1) {
    // Récupérer les informations du participant
    $row = $result->fetch_assoc();
    $nom = $row["nom_p_e"];
    $prenom = $row["prenom_p_e"];
    $email = $row["email_p_e"];
    $telephone = $row["telephone_p_e"];
    $adresse = $row["adresse_p_e"];
  } else {
    // Rediriger vers la page de liste des participants si le participant n'existe pas
    header("Location: participants.php?evenement_id=" . $_GET['evenement_id'] . "");
    exit();
  }
} else {
  // Rediriger vers la page de liste des participants si l'ID du participant n'est pas spécifié dans l'URL
  header("Location: participants.php?evenement_id=" . $_GET['evenement_id'] . "");
  exit();
}
?>

<?php include("../layout.php"); ?>

<head>
  <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
  <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
  <h2><a href="participants.php?evenement_id=<?php echo @$_GET['evenement_id']; ?>" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a>Modifier le participant</h2>
  <?php if (@$success) : ?>
    <div class="alert alert-success" role="alert">
      Les données du participant ont été modifiées avec succès.
    </div>
  <?php endif; ?>
  <?php if (@$danger) : ?>
    <div class="alert alert-danger" role="alert">
      Une erreur s'est produite lors de la mise à jour du participant.
    </div>
  <?php endif; ?>
  <form action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id; ?>&evenement_id=<?php echo @$_GET['evenement_id']; ?>"" method="POST">
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
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
  </form>
</div>

<?php include("../footer.html"); ?>