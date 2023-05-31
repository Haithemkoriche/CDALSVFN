<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Récupérer la liste des ateliers
$stmtAte = $conn->prepare("SELECT ID_ate, Nom_ate FROM ateliers");
$stmtAte->execute();
$resultAte = $stmtAte->get_result();
$ateliers = $resultAte->fetch_all(MYSQLI_ASSOC);

// Récupérer la liste des événements
$stmtEvent = $conn->prepare("SELECT ID_E, Nom_E FROM evenements");
$stmtEvent->execute();
$resultEvent = $stmtEvent->get_result();
$evenements = $resultEvent->fetch_all(MYSQLI_ASSOC);

// Récupérer la liste des groupes
$stmtGroup = $conn->prepare("SELECT ID_grp, Nom_grp FROM groups");
$stmtGroup->execute();
$resultGroup = $stmtGroup->get_result();
$groupes = $resultGroup->fetch_all(MYSQLI_ASSOC);

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
    $idAtelier = $_POST["id_atelier"];
    $idEvenement = $_POST["id_evenement"];
    $idGroupe = $_POST["id_groupe"];

    // Préparer et exécuter la requête d'insertion des données du participant
    $stmt = $conn->prepare("INSERT INTO participants (Nom_p, prenom_p, addres_p, Email_p, telephon_p, date_n_p, lieu_n_p, ID_ate_foreign, ID_E_foreign, ID_grp_foreign) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiiii", $nom, $prenom, $adresse, $email, $telephone, $dateNaissance, $lieuNaissance, $idAtelier, $idEvenement, $idGroupe);
    $stmt->execute();

    // Rediriger vers la page de liste des participants après l'ajout
    header("Location: table.php");
    exit();
}
?>

<?php include("../layout.php"); ?>
<div class="container">
    <h2>Ajouter un participant</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
        </div>
        <div class="form-group">
            <label for="lieu_naissance">Lieu de naissance :</label>
            <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" required>
        </div>
        <div class="form-group">
            <label for="id_atelier">Atelier :</label>
            <select class="form-control" id="id_atelier" name="id_atelier" required>
                <?php foreach ($ateliers as $atelier) : ?>
                    <option value="<?php echo $atelier["ID_ate"]; ?>"><?php echo $atelier["Nom_ate"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_evenement">Événement :</label>
            <select class="form-control" id="id_evenement" name="id_evenement" required>
                <?php foreach ($evenements as $evenement) : ?>
                    <option value="<?php echo $evenement["ID_E"]; ?>"><?php echo $evenement["Nom_E"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_groupe">Groupe :</label>
            <select class="form-control" id="id_groupe" name="id_groupe" required>
                <?php foreach ($groupes as $groupe) : ?>
                    <option value="<?php echo $groupe["ID_grp"]; ?>"><?php echo $groupe["Nom_grp"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include("../footer.html"); ?>