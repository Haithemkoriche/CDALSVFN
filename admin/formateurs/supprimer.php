<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du formateur est spécifié dans l'URL
if (isset($_GET['id'])) {
    $formateurId = $_GET['id'];

    // Préparer et exécuter la requête de suppression
    $stmt = $conn->prepare("DELETE FROM formateurs WHERE ID_form = ?");
    $stmt->bind_param("i", $formateurId);
    $stmt->execute();

    // Vérifier si la suppression a réussi
    if ($stmt->affected_rows > 0) {
        echo "Formateur supprimé avec succès!";
    } else {
        echo "Une erreur s'est produite lors de la suppression du formateur.";
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
} else {
    echo "ID du formateur non spécifié.";
}
