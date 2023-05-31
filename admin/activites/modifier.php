<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'activité est passé en paramètre dans l'URL
if (isset($_GET['id'])) {
  $activityId = $_GET['id'];

  // Vérifier si le formulaire de modification a été soumis
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données soumises du formulaire
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    // Mettre à jour les détails de l'activité dans la base de données
    $sql = "UPDATE `activities` SET `title` = '$title', `description` = '$description', `image` = '$image', `updated_at` = NOW() WHERE `ID_act` = $activityId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo 'Activité modifiée avec succès.';
    } else {
      echo 'Erreur lors de la modification de l\'activité: ' . mysqli_error($conn);
    }
  } else {
    // Récupérer les détails de l'activité depuis la base de données
    $sql = "SELECT `ID_act`, `title`, `description`, `image`, `created_at`, `updated_at` FROM `activities` WHERE `ID_act` = $activityId";
    $result = mysqli_query($conn, $sql);

    // Vérifier si l'activité existe
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      // Afficher le formulaire de modification
      echo '<h2>Modifier l\'activité</h2>';
      echo '<form method="POST" action="modifier.php?id=' . $activityId . '">';
      echo '<label>Titre:</label><br>';
      echo '<input type="text" name="title" value="' . $row['title'] . '"><br><br>';
      echo '<label>Description:</label><br>';
      echo '<textarea name="description">' . $row['description'] . '</textarea><br><br>';
      echo '<label>Image:</label><br>';
      echo '<input type="text" name="image" value="' . $row['image'] . '"><br><br>';
      echo '<input type="submit" value="Modifier">';
      echo '</form>';
    } else {
      echo 'Activité non trouvée.';
    }
  }

  // Fermer la connexion à la base de données
  mysqli_close($conn);
} else {
  echo 'ID de l\'activité non spécifié.';
}
