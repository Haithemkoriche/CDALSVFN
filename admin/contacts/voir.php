<?php
// Inclure le fichier de configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du contact est spécifié dans l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupérer l'ID du contact depuis l'URL
    $id = $_GET["id"];

    // Préparer et exécuter la requête de sélection du contact spécifié
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id_contact = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier s'il y a un résultat
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row["name_contact"];
        $email = $row["email_contact"];
        $phone = $row["phone_contact"];
        $message = $row["message_contact"];
        ?>

        <?php include("../layout.php"); ?>
        <div class="container">
            <h2>Details du contact</h2>
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">ID</th>
                        <td><?php echo $id; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Nom</th>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Téléphone</th>
                        <td><?php echo $phone; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Message</th>
                        <td><?php echo $message; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php include("../footer.html");

    } else {
        echo "Aucun contact trouvé avec cet ID.";
    }

    // Fermer les ressources
    $stmt->close();
    $conn->close();
} else {
    echo "ID du contact non spécifié.";
}
?>
