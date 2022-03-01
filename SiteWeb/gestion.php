<?php 

require "inc/config.php";

if($_SESSION["id"] > 0) {
} else {
    header('Location: login.php');
}

if($_USER->isEditor() == false) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gestion</title>
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
                <button class="btn-success" onclick="Ordre('camOn');">Démarrer</button>
                <button class="btn-danger" onclick="Ordre('camOff');">Eteindre</button>
                <br/><br/><br/><br/>
                <button class="btn-primary" onclick="Ordre('moveUp');">Monter en haut</button>   
                <br/><br/>
                <button class="btn-warning" onclick="Ordre('zoomMin');">Zoom -</button> 
                <button class="btn-primary" onclick="Ordre('moveLeft');">Tourner à gauche</button> 
                <button class="btn-primary" onclick="Ordre('moveRight');">Tourner à droite</button> 
                <button class="btn-warning" onclick="Ordre('zoomMax');">Zoom +</button> 
                <br/><br/>
                <button class="btn-primary" onclick="Ordre('moveDown');">Desendre en bas</button>
                <br/><br/>
                <button class="btn-danger" onclick="Ordre('movementStop');">Arrêt mouvement</button>
                <button class="btn-success" onclick="Ordre('moveReset');">Remettre à Zéro</button>


            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="cam.js"></script>
        <script>
            // Créer une connexion WebSocket
            const socket = new WebSocket('ws://192.168.65.153:16050');

            function Ordre(method) {
                const messageCam = method;

                socket.send(messageCam);
            }
        </script>
    </body>
</html>
