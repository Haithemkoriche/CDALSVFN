<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Récupérer l'ID du participant à modifier
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $adresse = $_POST["adresse"];
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];
        $dateNaissance = $_POST["date_naissance"];
        $lieuNaissance = $_POST["lieu_naissance"];
        $idactivite = $_POST["id_activite"];
        $idGroupe = $_POST["id_groupe"];

        // Préparer et exécuter la requête de mise à jour des données du participant
        $stmt = $conn->prepare("UPDATE participants SET Nom_p = ?, prenom_p = ?, addres_p = ?, Email_p = ?, telephon_p = ?, date_n_p = ?, lieu_n_p = ?, ID_act_foreign = ?, ID_E_foreign = ?, ID_grp_foreign = ? WHERE ID_p = ?");
        $stmt->bind_param("ssssssiiii", $nom, $prenom, $adresse, $email, $telephone, $dateNaissance, $lieuNaissance, $idactivite, $idEvenement, $idGroupe, $id);
        $stmt->execute();

        // Rediriger vers la page de liste des participants après la modification
        header("Location: index.php");
        exit();
    }

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
    <h2>Modifier le participant</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $participant["Nom_p"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $participant["prenom_p"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $participant["addres_p"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $participant["Email_p"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $participant["telephon_p"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo $participant["date_n_p"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="lieu_naissance">Lieu de naissance :</label>
            <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" value="<?php echo $participant["lieu_n_p"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="id_activite">Activité :</label>
            <select class="form-control" id="id_activite" name="id_activite" required>
                <?php foreach ($activities as $activite) : ?>
                    <option value="<?php echo $activite["ID_act"]; ?>" <?php if ($activite["ID_act"] == $participant["ID_act_foreign"]) echo "selected"; ?>><?php echo $activite["titre_act"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_groupe">Groupe :</label>
            <select class="form-control" id="id_groupe" name="id_groupe" required>
                <?php foreach ($groupes as $groupe) : ?>
                    <option value="<?php echo $groupe["ID_grp"]; ?>" <?php if ($groupe["ID_grp"] == $participant["ID_grp_foreign"]) echo "selected"; ?>><?php echo $groupe["int_grp"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<?php include("../footer.html"); ?>