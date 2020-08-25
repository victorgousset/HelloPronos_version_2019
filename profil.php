<?php 

error_reporting(E_ALL);
ini_set("display_errors","On");

session_start();
require 'includes/Database.php';
include 'includes/UsersInfos.php';

// Vérifier si il est connecté.
if (!isConnected()) {
    header('Location:auth/');
}

// Vérifier les abonnements.
$database = getPDO();
checkSubscribe($database);

// Vérifier si le Client est abonné.
if (!isSubscribe()) {
    header('refresh:3;url=index.php');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Espace VIP</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="script" href="css/js/bootstrap.js">
        <link rel="script" href="css/js/bootstrap.min.js">
    </head>
    <body>
        <div class="container-fullwidth d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-black border-bottom shadow-sm" style="background-color: #19160f;">
            <h5 class="my-0 mr-md-auto font-weight-normal text-white">Profil de <?= $_SESSION['userFirstname'] ?></h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <?php if (isConnected()) { ?>
                    <a class="p-2 text-white" href="auth/logout.php">Se déconnecter</a>
                <?php } else { ?>
                    <a class="p-2 text-white" href="auth/">Connexion</a>
                    <a class="p-2 text-white" href="auth/register.php">Inscription</a>
                <?php } ?>
            </nav>
            <a class="btn btn-outline-warning" href="index.php">Accueil</a>
            <a class="btn btn-outline-warning" href="vipconfirm.php">VIP</a>
        </div>


        <div class="card border-warning mb-3 w-80" style="margin-left: 5%; margin-right: 5%; position: relative;">
        
        <h5 class="card-title" style="color: black;"><u>Information sur votre profil:</u></h5>
            <p class="card-text" style="color: black;">
                <strong>-Pseudo: </strong> <?= $_SESSION['userPseudo'] ?><br>
                <strong>-Email: </strong> <?= $_SESSION['userEmail'] ?><br>
                <strong>-Prenom: </strong> <?= $_SESSION['userFirstname'] ?><br>
                <strong>-Nom: </strong> <?= $_SESSION['userLastname'] ?><br>
                <strong>-Pays: </strong> <?= $_SESSION['userCountry'] ?><br>
                <strong>-Ville: </strong> <?= $_SESSION['userCity'] ?><br>
                <strong>-Code postal: </strong> <?= $_SESSION['userPostalcode'] ?><br>
                <strong>-Tel: </strong> <?= $_SESSION['userPhone'] ?><br>
                <strong>-Fin d'abonnement: </strong> <?= $_SESSION['userSubscribeDelay']?><br>
                <strong>-Date d'inscription: </strong> <?= $_SESSION['userRegisterDate'] ?><br>
        </div>

        <a href="#" class="btn btn-outline-primary" style="margin-left: 5%; margin-right: 5%;">Modifier les informations personelles</a>
    </body>
</html>