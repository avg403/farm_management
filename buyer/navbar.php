<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>


<header id="header" class="fixed-top">
  <div class="container align-items-center justify-content-lg-between">

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Farm System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link scrollto active" href="#home">Home</a>
            <a class="nav-link scrollto" href="#about">About</a>

            <a class="nav-link scrollto " href="#products">Shopping</a>
            <a class="nav-link scrollto" href="myCart.php">My Cart</a>
            <a class="nav-link scrollto" href="buyer_profile.php">Profile</a>
            <a class="nav-link scrollto" href="../index.php?logout=1">Log Out</a>
            <?php
            session_start();

            if (isset($_GET['logout']) && $_GET['logout'] == 1) {

              session_unset();
              session_destroy();
              header("Location: ../index.php");
              exit;
            }
            ?>




            <i class="bi bi-list mobile-nav-toggle"></i>
          </div>
        </div>
      </div>
    </nav>

  </div>
</header>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>