<?php
// Inclure la configuration de la base de données
require_once '../../config/bdd.php';

// Récupérer la liste des activities
$stmtAte = $conn->prepare("SELECT ID_act, titre_act FROM activities");
$stmtAte->execute();
$resultAte = $stmtAte->get_result();
$activities = $resultAte->fetch_all(MYSQLI_ASSOC);

// Récupérer la liste des groupes
$stmtGroup = $conn->prepare("SELECT ID_grp, int_grp FROM groups");
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
    $idactivite = $_POST["id_activite"];
    $idGroupe = $_POST["id_groupe"];

    // Préparer et exécuter la requête d'insertion des données du participant
    $stmt = $conn->prepare("INSERT INTO participants (Nom_p, prenom_p, addres_p, Email_p, telephon_p, date_n_p, lieu_n_p, ID_act_foreign, ID_grp_foreign) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiii", $nom, $prenom, $adresse, $email, $telephone, $dateNaissance, $lieuNaissance, $idactivite, $idGroupe);
    $stmt->execute();

    // Rediriger vers la page de liste des participants après l'ajout
    header("Location: index.php?add=true");
    exit();
}
?>
  
<?php include("../layout.php"); ?>
<head>
    <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<div class="container"> 
    <h2><a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> Ajouter un participant</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <div class="row">
        <div class="form-group mt-2 col-lg-6">
            <label class="form-label" for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group mt-2 col-lg-6">
            <label class="form-label" for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div> 
        </div>
        <div class="form-group mt-2"> 
            <label class="form-label" for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group mt-2">
            <label class="form-label" for="telephone">Téléphone :</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
        <div class="form-group mt-2">
            <label class="form-label" for="adresse">Adresse :</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>
        <div class="row">
        <div class="form-group mt-2 col-lg-6">
            <label class="form-label" for="date_naissance">Date de naissance :</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
        </div>
        <div class="form-group mt-2 col-lg-6">
            <label class="form-label" for="lieu_naissance">Lieu de naissance :</label>
            <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" required>
        </div>
        </div>
        <div class="form-group mt-2"> 
            <label class="form-label" for="id_activite">activité :</label>
            <select class="form-control" id="id_activite" name="id_activite" required>
                <?php foreach ($activities as $activite) : ?>
                    <option value="<?php echo $activite["ID_act"]; ?>"><?php echo $activite["titre_act"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mt-2">
            <label class="form-label" for="id_groupe">Groupe :</label>
            <select class="form-control" id="id_groupe" name="id_groupe" required>
                <?php foreach ($groupes as $groupe) : ?>
                    <option value="<?php echo $groupe["ID_grp"]; ?>"><?php echo $groupe["int_grp"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class=" mt-2 btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include("../footer.html"); ?>