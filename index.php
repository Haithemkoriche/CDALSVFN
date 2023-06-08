<?php
include('config/bdd.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $name = $_POST["contact_name"];
  $email = $_POST["contact_email"];
  $phone = $_POST["contact_phone"];
  $message = $_POST["contact_message"];

  // Prepare and execute the SQL query
  $sql = "INSERT INTO contacts (name_contact, email_contact, phone_contact, message_contact)
          VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $name, $email, $phone, $message);
  if ($stmt->execute()) {
    // Show success message in Bootstrap modal
    echo '
      <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="successModalLabel">Message envoyé avec succès</h5>
            </div>
            <div class="modal-body">
              Votre message a été envoyé avec succès.
            </div>
           
          </div>
        </div>
      </div>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          var successModal = document.getElementById("successModal");
          var bootstrapModal = new bootstrap.Modal(successModal);
          bootstrapModal.show();
        });
      </script>
    ';
  }

  $stmt->close();
}



// Retrieving data from the "carousels" table
$carousels = [];
$sql = "SELECT * FROM carousels";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $carousels[] = $row;
  }
}
// Retrieving data from the "groupes" table
$groupes = [];
$sql = "SELECT * FROM groups";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $groupes[] = $row;
  }
}

// Retrieving data from the "activities" table
$activities = [];
$sql = "SELECT * FROM activities";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $activities[] = $row;
  }
}

// Retrieving data from the "ateliers" table
$ateliers = [];
$sql = "SELECT * FROM ateliers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $ateliers[] = $row;
  }
}

// Retrieving data from the "evenements" table
$evenements = [];
$sql = "SELECT * FROM evenements";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $evenements[] = $row;
  }
}


// Close the database connection
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/js/bootstrap.js">
    <link rel="stylesheet" href="assets/fonts/css/all.css">
    

    <title>CDALS</title>
</head>

<body style="scroll:smoth;">
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="images/logo1.png" width="90px" height="72px" alt="" srcset=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data -bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto text-capitalize ">
                    <a class="nav-link p-lg-3 active text-primary" aria-current="page" href="#">Acceuil</a>
                    <a class="nav-link p-lg-3 " href="#about">À propos</a>
                    <a class="nav-link p-lg-3 " href="#activités">activités</a>
                    <a class="nav-link p-lg-3 " href="#ateliers">Les ateliers</a>
                    <a class="nav-link p-lg-3 " href="#evenements">Événements</a>
                    <a class="nav-link p-lg-3 " href="#contact">Contact</a>
                </div>
            </div>
        </div>
    </nav>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php foreach ($carousels as $key => $slide) : ?>
      <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>" data-bs-interval="3000">
        <img src="images/slide/<?php echo $slide['path_car']; ?>" class="d-block w-100 blur carousel-img" style="height: calc(100vh - 72px);" alt="...">
        <div class="carousel-caption">
          <h1><?php echo $slide['titre_car']; ?></h1>
          <p><?php echo $slide['description_car']; ?></p>
          <div class="d-grid row-gap-3">
            <a href="#activités" class="btn btn-primary p-2">Inscrire</a>
            <a href="#contact" class="btn btn-light p-2">Contacter</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- about -->
<section id="about">
  <div class="container">
    <h2 style="text-align:center">À propos</h2>
    <div class="row">
      <div class="col-md-6">
        <img src="images/rouina.jpg" class="shadow-lg rounded mx-auto d-block img-fluid" alt="" srcset="" style="border-radius: 25% !important;">
      </div>
      <div class="col-md-6 m-md-auto mt-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, libero at auctor congue, enim
          tellus
          venenatis magna, in venenatis lectus tellus eu sapien. Proin quis neque rutrum, lobortis felis eu,
          vestibulum nibh. Nullam interdum sem ac nunc sodales, nec finibus justo sagittis.</p>
      </div>
    </div>
  </div>
</section>

<!-- end about -->
<!-- start activities -->
<section id="activités">
  <div class="container mb-5 mt-5 pt-5">
    <h2 style="text-align:center" class="mb-5 mt-5">Nos Activités </h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($activities as $activity) : ?>
        <div class="col">
          <div class="card h-100">
            <img src="images/<?php echo $activity['image_act']; ?>" class="card-img-top" alt="..." style="object-fit: cover; height: 300px;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?php echo $activity['titre_act']; ?></h5>
              <p class="card-text"><?php echo $activity['description_act']; ?></p>
              <button type="button" class="mt-auto btn btn-primary" data-toggle="modal" data-target="#inscriptionModal<?php echo $activity['ID_act']; ?>">
                Inscrire
              </button>
            </div>
          </div>
        </div>

        <!-- Modal pour l'activité spécifique -->
        <div class="modal fade" id="inscriptionModal<?php echo $activity['ID_act']; ?>" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel<?php echo $activity['ID_act']; ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="inscriptionModalLabel<?php echo $activity['ID_act']; ?>">Formulaire d'inscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="d-flex justify-content-center">
                  <form action="inscription_activite.php" method="POST">
                    <div class="row">
                      <div class="form-group col">
                        <label for="nom">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                      </div>
                      <div class="form-group col">
                        <label for="prenom">Prénom :</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                      </div>
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
                      <label for="adresse">Adresse :</label>
                      <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="row">
                      <div class="form-group col">
                        <label for="date_naissance">Date de naissance :</label>
                        <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                      </div>
                      <div class="form-group col">
                        <label for="lieu_naissance">Lieu de naissance :</label>
                        <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="groupe">Groupe :</label>
                      <select class="form-control" id="groupe" name="groupe" required>
                        <option value="">--choisis un group--</option>
                        <?php foreach ($groupes as $groupe) : ?>
                          <option value="<?php echo $groupe['ID_grp']; ?>"><?php echo $groupe['int_grp']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <input type="hidden" name="activite_id" value="<?php echo $activity['ID_act']; ?>">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- end activities -->



<!-- start ateliers -->
<section id="ateliers" class="bg-light py-5">
  <div class="container mb-5 mt-5">
    <h2 class="text-center mb-5 mt-5">Les ateliers proposés</h2>
    <div class="row">
      <?php foreach ($ateliers as $atelier) : ?>
        <div class="col-lg-4 col-md-6">
          <div class="card mb-4">
            <img src="images/<?php echo $atelier['image_ate']; ?>" class="card-img-top" alt="Atelier 1">
            <div class="card-body">
              <h3 class="card-title"><?php echo $atelier['intitule_ate']; ?></h3>
              <p class="card-text"><?php echo $atelier['description_ate']; ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>



<!-- end ateliers -->
<!-- start evenement -->
<section class="evenements" id="evenements">
  <div class="container">
    <h2 style="text-align:center" class="pt-5">Événements à venir</h2>
    <div class="evenements-liste">
      <?php foreach ($evenements as $evenement) : ?>
        <div class="evenement">
          <img src="images/<?php echo $evenement['image_E']; ?>" alt="Événement 1">
          <h3><?php echo $evenement['intitule_E']; ?></h3>
          <p><?php echo $evenement['description_E']; ?></p>
          <p><?php echo $evenement['date_d_E']; ?> jusqu'à <?php echo $evenement['date_f_E']; ?></p>
          <!-- <a href="inscription_evenement.php?id=<?php echo $evenement['ID_E']; ?>" class="btn btn-primary">Participer</a> -->
          <!-- Button pour ouvrir le modal -->
          <div class="text-center"> <!-- Ajout de la classe "text-center" pour le centrage -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inscriptionModal">
              Participer
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="inscriptionModalLabel">Formulaire d'inscription</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="inscription_evenement.php" method="post">
                    <div class="form-group">
                      <label for="nom">Nom :</label>
                      <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                      <label for="prenom">Prénom :</label>
                      <input type="text" class="form-control" id="prenom" name="prenom" required>
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
                      <label for="adresse">Adresse :</label>
                      <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <input type="hidden" name="evenement_id" value="<?php echo $evenement['ID_E']; ?>">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- end evenement -->

<!-- contact -->
<section id="contact">
  <div class="container">
    <h2 style="text-align:center">Contact</h2>
    <form action="" method="POST">
      <div class="form-group">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="contact_name" required>
      </div>
      <div class="form-group">
        <label for="email" class="form-label">Adresse email</label>
        <input type="email" class="form-control" id="email" name="contact_email" required>
      </div>
      <div class="form-group">
        <label for="contact-phone" class="form-label">Numero telephone :</label>
        <input type="tel" name="contact_phone" id="contact-phone" class="form-control">
      </div>
      <div class="form-group">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="contact_message" rows="5" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
  </div>
</section>

<!-- end contact -->
<footer class="mt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Nous contacter</h3>
                    <ul>
                        <li><i class="fa fa-map-marker"></i> 123 rue des Arts, Alger</li>
                        <li><i class="fa fa-phone"></i> +213 123 456 789</li>
                        <li><i class="fa fa-envelope"></i> info@cdls.com</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Suivez-nous</h3>
                    <ul class="social-media">
                        <i class="fa-brands fa-facebook"></i>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Inscription à la newsletter</h3>
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Entrez votre email...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">S'abonner</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <h3 class="mt-2 mb-2">Localisation : </h3>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12792.419703364221!2d2.9482025!3d36.7200412!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128faf8850f2ce0d%3A0xe04e843394305899!2sCenter%20Development%20Activities%20Scientists%20Ouledfayt%20Cdals!5e0!3m2!1sen!2sdz!4v1681857433561!5m2!1sen!2sdz"
                class="w-100" height="auto" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="bottom-footer mt-4 mb-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-0 text-center">&copy; 2023 Centre de développement de loisirs et scientifiques.
                            Tous droits réservés.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- Inclure les fichiers CSS de Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- Inclure les fichiers JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>

    <script src="assets/https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
