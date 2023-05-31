<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du carousel est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID du carousel depuis l'URL
    $id = $_GET["id"];

    // Préparer et exécuter la requête de suppression
    $stmt = $conn->prepare("DELETE FROM carousels WHERE ID_carousel = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Vérifier si la suppression a réussi
    if ($stmt->affected_rows > 0) {
        header("location: index.php");
        exit();
    } else {
        echo "Une erreur s'est produite lors de la suppression du carousel.";
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
} else {
    echo "ID du carousel non spécifié.";
}
?>
