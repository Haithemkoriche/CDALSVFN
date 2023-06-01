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
  $stmt->execute();

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

<?php include('layouts/header.html'); ?>

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php foreach ($carousels as $key => $slide) : ?>
      <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>" data-bs-interval="3000">
        <img src="images/slide/<?php echo $slide['path_car']; ?>" class="d-block w-100 blur carousel-img" alt="...">
        <div class="carousel-caption">
          <h1><?php echo $slide['titre_car']; ?></h1>
          <p><?php echo $slide['description_car']; ?></p>
          <div class="d-grid row-gap-3">
            <a href="/inscrir" class="btn btn-primary p-2">Inscrire</a>
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
        <img src="images/rouina.jpg" class="rounded mx-auto d-block img-fluid" alt="" srcset="">
      </div>
      <div class="col-md-6 m-md-auto mt-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, libero at auctor congue, enim
          tellus
          venenatis magna, in venenatis lectus tellus eu sapien. Proin quis neque rutrum, lobortis felis eu,
          vestibulum nibh. Nullam interdum sem ac nunc sodales, nec finibus justo sagittis.</p>
        <a href="about.html" class="btn btn-primary">En savoir plus</a>
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
              <a href="incrir.php" class="mt-auto btn btn-primary">Inscrire</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- end activities -->

<!-- start ateliers -->
<section id="ateliers">
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
          <p><?php echo $evenement['date_d_E']; ?> jusqu'a <?php echo $evenement['date_f_E']; ?></p>
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

<?php include('layouts/footer.html'); ?>