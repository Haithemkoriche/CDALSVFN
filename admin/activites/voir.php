<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'activité est passé en paramètre dans l'URL
if (isset($_GET['id'])) {
    $activityId = $_GET['id'];

    // Récupérer les détails de l'activité depuis la base de données
    $sql = "SELECT `ID_act`, `title`, `description`, `image`, `created_at`, `updated_at` FROM `activities` WHERE `ID_act` = $activityId";
    $result = mysqli_query($conn, $sql);

    // Vérifier si l'activité existe
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Afficher les détails de l'activité
        echo '<h2>Détails de l\'activité</h2>';
        echo '<p><strong>Titre:</strong> ' . $row['title'] . '</p>';
        echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
        echo '<p><strong>Image:</strong> <img src="../../images/' . $row['image'] . '" width="200" height="200"></p>';
        echo '<p><strong>Date de création:</strong> ' . $row['created_at'] . '</p>';
        echo '<p><strong>Date de modification:</strong> ' . $row['updated_at'] . '</p>';
    } else {
        echo 'Activité non trouvée.';
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
} else {
    echo 'ID de l\'activité non spécifié.';
}
?>
