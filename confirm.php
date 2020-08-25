<?php 

session_start();
require 'includes/Database.php';
include 'includes/UsersInfos.php';

// Vérifier si il est connecté.
if (!isConnected()) {
    header('Location:auth/');
}

// Vérifier si le Client est abonné.
if (isSubscribe()) {
    header('Location:auth/');
}

// Gestion de la confirmation de l'Achat!
$token = $_POST['stripeToken'];
$email = isset($_POST['email']) ? $_POST['email'] : $_SESSION['userEmail'];
$name = $_POST['name'];
$amount = $_SESSION['subConfirm']['sub_price'] * 100;

if (!empty($token)) {

    require('includes/Stripe.php');
    $stripe = new Stripe('sk_live_sEaT9rAfQyTnwhT30P5re6Ep00ZYdaHilv');
    $customer = $stripe->api('customers', [
        'source' => $token,
        'description' => $name,
        'email' => $email
    ]);
    $stripe->api('charges', [
        'amount' => $amount,
        'currency' => 'eur',
        'customer' => $customer->id
    ]);
    /*$charge = \Stripe\Charge::create([
        'amount' => 999,
        'currency' => 'eur',
        'description' => 'Example charge',
        'source' => $token,
    ]);*/

    $messageSucces = 'Félecitation vous venez de vous abonner pour : <span style="font-weight: 700;">' . $_SESSION['subConfirm']['sub_delay'] .' MOIS</span> !';

    // Appliquer l'abonnement au Client.
    $database = getPDO();
    $subDelayApply = $_SESSION['subConfirm']['sub_delay_hours'];
    $updateSubscribe = $database->prepare("UPDATE users_vg SET subscribe=1, subscribe_delay = DATE_ADD(NOW(), INTERVAL " . $subDelayApply . " HOUR) WHERE id = ?");
    $updateSubscribe->execute([
        $_SESSION['userID']
    ]);
    $requestUser = $database->prepare("SELECT * FROM users_vg WHERE id = ?");
    $requestUser->execute(array($_SESSION['userID']));
    $userInfo = $requestUser->fetch();
    $_SESSION['userSubscribe'] = $userInfo['subscribe'];
    $_SESSION['userSubscribeDelay'] = $userInfo['subscribe_delay'];
    header('refresh:5;url=vip.php');
} else {
	header('Location:auth/');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>VG - Confirmation d'Achat</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="favicon.png" />
    </head>
    <body>
        <div class="container d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Victor Gousset</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <?php if (isConnected()) { ?>
                    <a class="p-2 text-dark" href="auth/logout.php">Se déconnecter</a>
                <?php } else { ?>
                    <a class="p-2 text-dark" href="auth/">Connexion</a>
                    <a class="p-2 text-dark" href="auth/register.php">Inscription</a>
                <?php } ?>
            </nav>
            <a class="btn btn-outline-primary" href="index.php">Accueil</a>
        </div>
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Confirmation d'Achat</h1>
            <p>Validatin du paiement en cours .... | Achat : <?= $_SESSION['subConfirm']['sub_name'] ?> | Prix : <?= $_SESSION['subConfirm']['sub_price'] ?>.00€<p>
            <!--- Système de Message d'Alerte! -->
            <div class="container">
                <?php if (isset($messageSucces)) { ?>
                    <div class="alert alert-success" style="border-radius: 0px;" role="alert"><?= $messageSucces ?></div>
                    <p style="color: #54a0ff; font-weight: 700;">Redirection vers l'Espace VIP en cours...</p>
                <?php } else if (isset($messageError)) { ?>
                    <div class="alert alert-danger" style="border-radius: 0px;" role="alert"><?= $messageError ?></div>
                <?php } ?>
            </div>
        </div>
        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md text-center">
                    <small class="d-block mb-3 text-muted">Copyright © 2019 Victor Gousset. Tous droits réservés. </small>
                </div>
            </div>
        </footer>
    </body>
</html>