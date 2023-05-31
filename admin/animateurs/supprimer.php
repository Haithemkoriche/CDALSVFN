<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si un ID d'animateur est spécifié dans l'URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Préparer et exécuter la requête de suppression de l'animateur
    $stmt = $conn->prepare("DELETE FROM animateurs WHERE ID_Anim = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Vérifier si la suppression a réussi
    if ($stmt->affected_rows > 0) {
        echo "Animateur supprimé avec succès!";
    } else {
        echo "Une erreur s'est produite lors de la suppression de l'animateur.";
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
} else {
    echo "ID d'animateur non spécifié.";
}
?>
