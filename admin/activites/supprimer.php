<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID de l'activité à supprimer est passé en paramètre
if (isset($_GET['id'])) {
    $id_act = $_GET['id'];

    // Supprimer l'activité de la base de données
    $sql = "DELETE FROM `activities` WHERE `ID_act` = $id_act";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: index.php");
        exit();
    } else {
        echo 'Erreur lors de la suppression de l\'activité: ' . mysqli_error($conn);
    }
}
?>
