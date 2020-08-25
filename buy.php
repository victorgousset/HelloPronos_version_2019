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
    header('Location:vip.php');
}

// Détection de l'ID de l'abonnement.
$database = getPDO();
$id = null;
$SubData = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $requestSub = $database->prepare("SELECT * FROM subscribes_vg WHERE id = ?");
    $requestSub->execute(array($id));
    $SubCount = $requestSub->rowCount();
    if ($SubCount == 1) {
        $SubInfo = $requestSub->fetch();
        $subData = array(
            'sub_name' => $SubInfo['sub_name'],
            'sub_infos' => $SubInfo['sub_infos'],
            'sub_price' => $SubInfo['sub_price'],
            'sub_delay' => $SubInfo['sub_delay'],
            'sub_delay_hours' => $SubInfo['sub_delay_hours'],
        );
        $_SESSION['subConfirm'] = $subData;
    } else {
        header('Location:index.php');
    }
} else {
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Achat d'Abonnement</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <!--<nav class="navbar navbar-expand-lg navbar-light bg-light siteNAv">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto navColor">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <?php //if (isConnected()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Se déconnecter</a>
                    </li>
                    <?php //} else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Connexion</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Inscription</a>
                    </li>
                    <?php //} ?>
                </ul>
            </div>
        </div>
    </nav>-->
        <div class="container">
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="images/logo.png" alt="" width="72" height="72">
                <h2>Achat | Abonnement</h2>
                <p class="lead">Vous êtes sur le point d'acheter un abonnement, vos données de paiements sont <b style="color: #6ab04c;">100% sécurisés</b> via le module <b style="color: #4834d4;">Stripe</b>.</p>
                <!--- Système de Message d'Alerte! -->
                <?php if (isset($messageSucces)) { ?>
                    <div class="alert alert-success" style="border-radius: 0px;" role="alert"><?= $messageSucces ?></div>
                <?php } else if (isset($messageError)) { ?>
                    <div class="alert alert-danger" style="border-radius: 0px;" role="alert"><?= $messageError ?></div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Information d'Achat</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?= $subData['sub_name'] ?></h6>
                                <small class="text-muted"><?= $subData['sub_infos'] ?></small>
                            </div>
                            <span class="text-muted"><?= $subData['sub_price'] ?>.00 €</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (EUR)</span>
                            <strong><?= $subData['sub_price'] ?>.00 €</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Informations du Client</h4>
                    <form class="needs-validation" action="confirm.php" id="payment_form" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Prénom</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="<?= $_SESSION['userFirstname'] ?>" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Nom</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="<?= $_SESSION['userLastname'] ?>"  disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="username">Pseudo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="text" class="form-control" id="username" placeholder="Username" value="<?= $_SESSION['userPseudo'] ?>" disabled>

                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_email">Email <span class="text-muted"></span></label>
                            <input type="email" class="form-control" id="adresse_email" name="email" value="<?= $_SESSION['userEmail'] ?>" disabled>
                        </div>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Pays</label>
                                <select class="custom-select d-block w-100" id="country" disabled>
                                    <option value=""><?= $_SESSION['userCountry'] ?></option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">Ville</label>
                                <select class="custom-select d-block w-100" id="state" disabled>
                                    <option value=""><?= $_SESSION['userCity'] ?></option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Code Postal</label>
                                <input type="text" class="form-control" id="zip" placeholder="" value="<?= $_SESSION['userPostalcode'] ?>" disabled>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <h4 class="mb-3">Informations de Paiement</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Prénom & Nom</label>
                                <input type="text" class="form-control" id="cc-name" name="name" placeholder="<?= $_SESSION['userFirstname'] ?> <?= $_SESSION['userLastname'] ?>" required>
                                <small class="text-muted">Indiquez le nom complet du propriétaire de la carte bancaire.</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Numéro de Carte</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="XXXX XXXX XXXX XXXX" data-stripe="number" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label for="cc-expiration">Mois</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="Expiration" data-stripe="exp_month" required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="cc-expiration">Année</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="Expiration" data-stripe="exp_year" required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="XXX" data-stripe="cvc" required>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Effectuer le Paiement</button>
                    </form>
                </div>
            </div>

            <footer class="pt-4 my-md-5 pt-md-5 border-top">
                <div class="row">
                    <div class="col-12 col-md text-center">
                        <small class="d-block mb-3 text-muted">Copyright © 2019 HelloPronos. Tous droits réservés. </small>
                    </div>
                </div>
            </footer>
        </div>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <!--- Application du module de Stripe -->
        <script>
            Stripe.setPublishableKey('pk_live_sHkBvpV0IcFWgrYgHvb3Oj6k00xFhhoW7R');
            var $form = $('#payment_form');
            $form.submit(function (e) {
                e.preventDefault();
                $form.find('.button').attr('disabled', true);
                Stripe.card.createToken($form, function (status, response) {
                    if (response.error) {
                        $form.find('.message').remove();
                        $form.prepend('<div class="alert alert-danger" style="border-radius: 0px;" role="alert">' + response.error.message + '</div>');
                    } else {
                        var token = response.id;
                        $form.append($('<input type="hidden" name="stripeToken">').val(token));
                        $form.get(0).submit();
                    }
                })
            })
        </script>
    </body>
</html>