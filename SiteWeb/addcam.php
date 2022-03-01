<?php 

require "inc/config.php";

if($_SESSION["id"] > 0) {
} else {
    header('Location: login.php');
}

if($_USER->isEditor() == false) {
    header("Location: index.php");
}

if(isset($_POST["form_add_cam"])) {
    $_CAM->createCam($_POST["localisation"], $_POST["ipAddress"], $_POST["port"]);
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ajouter une caméra</title>
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
                <h1>Créer une caméra</h1>
                <form method="POST" action="">
                    <input type="text" name="localisation" placeholder="Description / Localisation" />
                    <input type="text" name="ipAddress" placeholder="Adresse IP" />
                    <input type="text" name="port" placeholder="Port (ex. 16050)" />
                    <input type="submit" name="form_add_cam" value="Ajouter la caméra" />
                </form>
            </div>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Localisation / description</th>
                <th scope="col">Adresse IP</th>
                <th scope="col">Port</th>
                <th scope="col">Port</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $req = $_SQL->prepare("SELECT * FROM cam");
                    $req->execute();

                    $count = $req->rowCount();

                    if($count > 0) {
                        while($info = $req->fetch()) {
                            ?>
                            <tr>
                            <th scope="row"><?php echo $info["id"]; ?></th>
                            <td><?php echo $info["localisation"]; ?></td>
                            <td><?php echo $info["ipAddress"]; ?></td>
                            <td><?php echo $info["port"]; ?></td>
                            <td><button class="btn-danger">Supprimer</button></td>
                            </tr>
                            <?php
                        }
                    }

                ?>
            </tbody>
            </table>
        </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
