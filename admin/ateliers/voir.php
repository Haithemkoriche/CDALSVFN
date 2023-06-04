<?php include("../layout.php"); ?>
<head>
            <link rel="stylesheet" href="../../assets/fonts/css/all.min.css">
        </head>
<div class="container">
    <h2>Détails de l'atelier</h2>
    <?php
    // Inclure le fichier de configuration de la base de données
    require_once '../../config/bdd.php';

    // Vérifier si l'ID de l'atelier est passé en paramètre dans l'URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Récupérer les informations de l'atelier avec l'ID spécifié
        $sql = "SELECT * FROM ateliers WHERE ID_ate = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Vérifier si l'atelier existe
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<h3>Intitulé : ' . $row['intitule_ate'] . '</h3>';
            echo '<p>Description : ' . $row['description_ate'] . '</p>';
            echo '<img src="../../images/' . $row['image_ate'] . '" width="200" height="200" alt="Image de l\'atelier">';
            echo '<p>Formateur : ' . $row['ID_form_foreign'] . '</p>';
        } else {
            echo '<p>Aucun atelier trouvé avec cet ID.</p>';
        }

        // Fermer la connexion à la base de données
        $stmt->close();
    } else {
        echo '<p>Aucun ID d\'atelier spécifié.</p>';
    }

    // Fermer la connexion à la base de données
    $conn->close();
    ?>
     <a href="index.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> </a> <a href="modifier.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
    <a href="supprimer.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
</div>
<?php include("../footer.html"); ?>
