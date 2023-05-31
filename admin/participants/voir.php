<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Vérifier si l'ID du participant est passé en paramètre d'URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Préparer et exécuter la requête pour récupérer les informations du participant
    $stmt = $conn->prepare("SELECT participants.*, activities.titre_act, groups.int_grp FROM participants LEFT JOIN activities ON participants.ID_act_foreign = activities.ID_act LEFT JOIN groups ON participants.ID_grp_foreign = groups.ID_grp WHERE participants.ID_p = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si le participant existe
    if ($result->num_rows > 0) {
        $participant = $result->fetch_assoc();
    } else {
        echo "Participant non trouvé.";
        exit();
    }
} else {
    echo "ID du participant non spécifié.";
    exit();
}
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Participant</h2>
    <table class="table">
        <tbody>
            <tr>
                <th>Nom</th>
                <td><?php echo $participant["Nom_p"]; ?></td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td><?php echo $participant["prenom_p"]; ?></td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td><?php echo $participant["addres_p"]; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $participant["Email_p"]; ?></td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td><?php echo $participant["telephon_p"]; ?></td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td><?php echo $participant["date_n_p"]; ?></td>
            </tr>
            <tr>
                <th>Lieu de naissance</th>
                <td><?php echo $participant["lieu_n_p"]; ?></td>
            </tr>
            <tr>
                <th>Activité</th>
                <td><?php echo $participant["titre_act"]; ?></td>
            </tr>
            <tr>
                <th>Groupe</th>
                <td><?php echo $participant["int_grp"]; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?php include("../footer.html"); ?>