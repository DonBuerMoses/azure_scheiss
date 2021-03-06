<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">
    <link href="http://fonts.cdnfonts.com/css/symbol-crucifix" rel="stylesheet">
    <title>Jesus Shop</title>
</head>

<body class="d-flex flex-column">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <div class="navbar-cross">t</div>
        <a class="navbar-brand" href="./index.html">Jesus! Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="./index.html">Home</a>
            <a class="nav-link active" aria-current="page" href="./login.html">Login</a>
            <a class="nav-link active" aria-current="page" href="./user.php">User</a>
            <a class="nav-link" href="./formular.html">Formular</a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Content --> 
    <div class="container content">
    <article class="main-content">
        <h2><?php 
        session_start();
        echo 'Hi, ' . $_SESSION["email"] . ' ' . $_SESSION["passwort"]; ?></h2>    
    </article>
    
    </div>

    <!-- Footer-->
    <div class="footer">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script><!-- Footer bar-->
        <div class="p-4 mt-5 bg-light text-center"><small>Kontaktinformationen</small></div>
    </div>
</body>
</html>