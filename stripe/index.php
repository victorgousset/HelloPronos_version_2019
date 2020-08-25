<?php
session_start();
require '../includes/Database.php';
include '../includes/UsersInfos.php';

require "class/User_prePaiement.php";

// Vérifier si il est connecté.
if (!isConnected()) {
    header('Location:../auth/');
}

// Vérifier si le Client est abonné.
if (isSubscribe()) {
    header('Location:../vip.php');
}

$bdd = getPDO();
var_dump($_SESSION['userParrain']);
$code = "coucou";
$pre = new User_prePaiement($bdd, $code);
$pre->getSale();
?>
<!doctype html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Achat d'Abonnement</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
  </head>
 <body>

      <div class="container">
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="../images/logo.png" alt="" width="72" height="72">
                <h2>Achat | Abonnement</h2>
                <p class="lead">Vous êtes sur le point d'acheter un abonnement, vos données de paiements sont <b style="color: #6ab04c;">100% sécurisés</b>.</p>
            </div>
      </div>


</body>
</html>