<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];

    // Préparer et exécuter la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO formateurs (Nom_form, prenom_form, Email_form, telephon_form) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $prenom, $email, $telephone);
    $stmt->execute();

    // Vérifier si l'insertion a réussi
    if ($stmt->affected_rows > 0) {
    header("Location: index.php?add=true");
        exit(); 
    } else {
        $danger=true;
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
}
?>

<?php include("../layout.php"); ?>
<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container">
    <h2><a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Ajouter un formateur</h2>
    <?php if (@$danger) : ?>
        <div class="alert alert-danger" role="alert">
            Le formateur a n'été pas ajouté avec succès.
        </div>
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group mt-2">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" name="nom" id="nom">
        </div>
        <div class="form-group mt-2"> 
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" name="prenom" id="prenom">
        </div>
        <div class="form-group mt-2">
            <label for="email">Email :</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group mt-2">
            <label for="telephone">Téléphone :</label>
            <input type="text" class="form-control" name="telephone" id="telephone">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
    </form>
</div>

<?php include("../footer.html"); ?>
