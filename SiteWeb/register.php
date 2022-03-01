<?php 

require "inc/config.php";

if(isset($_POST["form_register"])) {
    $_USER->register($_POST["email"], $_POST["password"]);
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inscription</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <?php include "inc/header.php"; ?>
        <!-- Page content-->
        <div class="container">
            <div class="text-center mt-5">
                <h1>Inscription</h1>
                <form method="POST" action="">
                    <input type="email" name="email" placeholder="Adresse email" />
                    <input type="text" name="password" placeholder="Mot de passe" />
                    <input type="submit" name="form_register" value="Je m'inscris" />
                </form>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
