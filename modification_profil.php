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

if(isset($_POST['submit_password'])) {
    $password = htmlspecialchars($_POST['password']);
    $password_confirm = htmlspecialchars($_POST['password_confirm']);
    if((!empty($_POST['password'])) && (!empty($_POST['password_confirm']))) {
        if($password == $password_confirm) {
            $database = getPDO();

            $id_user = $_SESSION['userID'];
            //$crypt_password = sha1($password);

            $change_password = $database->prepare("UPDATE users_vg SET user_password = $password WHERE id = $id_user");
            $change_password->execute();

            

        } else {
            echo "les mdp sont mauvais";
        }
    } else {
        echo "tous les champs sont pas remplis";
    }
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
            <a class="btn btn-outline-warning" href="profil.php">Profil</a>
        </div>

        <div class="password">
                    <input type="password" class="password" name="password">
                    <input type="password" class="password_confirm" name="password_confirm">
                    <input type="submit" class="submit_password" name="submit_password">
        </div>
</body>
</html>