<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si le formulaire d'ajout a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    // Insérer la nouvelle activité dans la base de données
    $sql = "INSERT INTO `activities` (`title`, `description`, `image`, `created_at`, `updated_at`) VALUES ('$title', '$description', '$image', NOW(), NOW())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 'Activité ajoutée avec succès.';
    } else {
        echo 'Erreur lors de l\'ajout de l\'activité: ' . mysqli_error($conn);
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
}
?>

<h2>Ajouter une activité</h2>
<form method="POST" action="ajouter.php">
    <label>Titre:</label><br>
    <input type="text" name="title"><br><br>
    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>
    <label>Image:</label><br>
    <input type="text" name="image"><br><br>
    <input type="submit" value="Ajouter">
</form>
