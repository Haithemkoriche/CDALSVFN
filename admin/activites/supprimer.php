<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'activité est passé en paramètre dans l'URL
if (isset($_GET['id'])) {
    $activityId = $_GET['id'];

    // Supprimer l'activité de la base de données
    $sql = "DELETE FROM `activities` WHERE `ID_act` = $activityId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 'Activité supprimée avec succès.';
    } else {
        echo 'Erreur lors de la suppression de l\'activité: ' . mysqli_error($conn);
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
} else {
    echo 'ID de l\'activité non spécifié.';
}
?>
