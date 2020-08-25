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
    header('Location: https://hellopronos.com/index.php?error=NoSuscribe');
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
            <h5 class="my-0 mr-md-auto font-weight-normal text-white">Espace VIP</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <?php if (isConnected()) { ?>
                    <a class="p-2 text-white" href="auth/logout.php">Se déconnecter</a>
                <?php } else { ?>
                    <a class="p-2 text-white" href="auth/">Connexion</a>
                    <a class="p-2 text-white" href="auth/register.php">Inscription</a>
                <?php } ?>
            </nav>
            <a class="btn btn-outline-warning" href="index.php">Accueil</a>
            <a class="btn btn-outline-warning" href="profil.php">Profil</a>
        </div>
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
             <h1 style="color: black;">Espace</h1><h1 style="color: #F59F0A;">VIP</h1>
            <?php if (isSubscribe()) { ?>
                <p class="lead">Bonjour <?= $_SESSION['userFirstname'] ?>, vous possédez un abonnement jusqu'au : <b style="color: #487eb0"><?= $_SESSION['userSubscribeDelay'] ?></b></p>
            <?php } else { ?>
                <p class="lead" style="color: #e84118">Vous ne possédez pas d'abonnement, retour à l'accueil...</p>
            <?php } ?>
        </div>
        <br>
        <br>

        <div class="card border-warning mb-3 w-80" style="margin-left: 5%; margin-right: 5%; position: relative;">
            <div class="card-body text-warning">
                <h5 class="card-title" style="color: black;"><u>Comment suivre nos paris ?</u></h5>
                <p class="card-text" style="color: black;"><strong>I)</strong>  Nos pronostics sont postés sous 3 formes différentes:<br>
                    - Les Missiles (Ces paris sont des très grosses confiances,  3-4 dans le mois.)<br>
                    - Les Conseils (Ces paris sont les plus communs sur le VIP, nous vous conseillons de tous les suivre en suivant nos indications de mise.)<br>
                    - Le Funs (Ces paris sont là pour s'amuser, des grosses cotes à jouer avec des petites mises de votre bénéfice.)<br><br>
                    <strong>II)</strong>  Pour comprendre nos pronostics il vous suffit de lire <a href="#pronos">les cartes présentent ci-dessous</a> de la manière suivante:<br>
                    - Sur la gauche, vous pouvez voir quel est le type de pronostic(Missile, Conseil ou Fun), la date, le sport, le championnat jouer ainsi que le nom de match en question.<br>
                    - Au centre, notre pronostic<br>
                    - Sur la droite, vous pouvez voir la cote du pari ainsi que <a href="gestion"> l'indication de mise</a>.<br><br>
                    <strong>III)</strong>  Si vous jouez en bureau de tabac il vous suffit de vous présenter et de demander un pari sportif avec le nom du match et le pronostic.<br>
                    Cependant nous vous recommandons de jouer en ligne chez nos <a href="#partenaires">partenaires</a> ce qui apportera beaucoup d'avantages:<br>
                    - Premier pari remboursé jusqu'à 100€ chez chacun de nos <a href="#partenaires">partenaires</a>.<br>
                    - Jouer à tout moment depuis votre téléphone, tablette ou ordinateur.<br>
                    - Profiter de nos pronostics en direct pendant les matchs.<br>
                </p>
            </div>
        </div>

            <!--<div class="col-sm">
                <iframe scrolling='no' frameBorder='0' style='padding:0px; margin:0px; border:0px;border-style:none;border-style:none;' width='160' height='600' src="https://wlbetclicfr.adsrv.eacdn.com/I.ashx?btag=a_3944b_872c_&affid=2962&siteid=3944&adid=872&c=" ></iframe>
            </div>-->


        <br>

        <!-- MISSILE -->
        <?php
        $missile = $database->query('SELECT * FROM pronostic WHERE id = 1');
        while ($donnees_missile = $missile->fetch()) { ?>

        <section class="awards p-50" id="pronos">
            <div class="container">
                <div class="row no-gutters shadow mb-4">
                    <div class="col-md-4">
                        <div class="conseil">
                            <div class="conseilDu">
                                <h1 class="m-0">MISSILE - <?= $donnees_missile['missile_date'] ?></h1>
                            </div>
                            <div class="cote">
                                <h2><?= $donnees_missile['missile_sport'] ?><br><?= $donnees_missile['missile_match'] ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="conseil">
                            <div class="conseilDu notre">
                                <h1 class="m-0">NOTRE PRONOSTIC</h1>
                            </div>
                            <div class="cote pl-50">
                                <h2> <img src="images/trophy.png" alt=""><?= $donnees_missile['missile_prono'] ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-center">
                        <div class="conseil">
                            <div class="conseilDu notre">
                                <h1 class="m-0 pl-0">COTE TOTALE ET FIABILITÉ</h1>
                            </div>
                            <div class="cote tableBtn">
                                <a href="https://wlbetclicfr.adsrv.eacdn.com/C.ashx?btag=a_3944b_597c_&affid=2962&siteid=3944&adid=597&c="><?= $donnees_missile['missile_cote'] ?></a>
                            </div>
                        </div>
                    </div>
            </div>
                <?php  } $missile->closeCursor();   ?>

                <!-- CONSEIL -->
                <?php
                $conseil = $database->query('SELECT * FROM pronostic WHERE id = 2');
                while ($donnees_conseil = $conseil->fetch()) { ?>
                <div class="container">
                        <div class="row no-gutters shadow mb-4">
                            <div class="col-md-4">
                                <div class="conseil">
                                    <div class="conseilDu">
                                        <h1 class="m-0">CONSEIL - <?= $donnees_conseil['conseil_date'] ?></h1>
                                    </div>
                                    <div class="cote">
                                        <h2><?= $donnees_conseil['conseil_match'] ?></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="conseil">
                                    <div class="conseilDu notre">
                                        <h1 class="m-0">NOTRE PRONOSTIC</h1>
                                    </div>
                                    <div class="cote pl-50">
                                        <h2> <img src="images/trophy.png" alt=""> <?= $donnees_conseil['conseil_prono'] ?> </h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 text-center">
                                <div class="conseil">
                                    <div class="conseilDu notre">
                                        <h1 class="m-0 pl-0">COTE TOTALE ET FIABILITÉ</h1>
                                    </div>
                                    <div class="cote tableBtn">
                                        <a href="https://wlbetclicfr.adsrv.eacdn.com/C.ashx?btag=a_3944b_597c_&affid=2962&siteid=3944&adid=597&c="><?= $donnees_conseil['conseil_cote'] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  } $conseil->closeCursor();   ?>

                    <!-- FUN -->
                    <?php
                    $fun = $database->query('SELECT * FROM pronostic WHERE id = 3');
                    while ($donnees_fun = $fun->fetch()) { ?>
                    <div class="container">
                        <div class="row no-gutters shadow mb-4">
                            <div class="col-md-4">
                                <div class="conseil">
                                    <div class="conseilDu">
                                        <h1 class="m-0">FUN - <?= $donnees_fun['fun_date'] ?></h1>
                                    </div>
                                    <div class="cote">
                                        <h2><?= $donnees_fun['fun_match'] ?></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="conseil">
                                    <div class="conseilDu notre">
                                        <h1 class="m-0">NOTRE PRONOSTIC</h1>
                                    </div>
                                    <div class="cote pl-50">
                                        <h2> <img src="images/trophy.png" alt=""> <?= $donnees_fun['fun_prono'] ?></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 text-center">
                                <div class="conseil">
                                    <div class="conseilDu notre">
                                        <h1 class="m-0 pl-0">COTE TOTALE ET FIABILITÉ</h1>
                                    </div>
                                    <div class="cote tableBtn">
                                        <a href="https://wlbetclicfr.adsrv.eacdn.com/C.ashx?btag=a_3944b_597c_&affid=2962&siteid=3944&adid=597&c="><?= $donnees_fun['fun_cote'] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  } $fun->closeCursor();   ?>

        </section>


        <br>
        <div class="card border-warning mb-3 w-80" style="margin-left: 5%; margin-right: 5%; position: relative;" id="partenaires">
            <div class="card-body text-danger">
                <h5 class="card-title" style="color: black;"><u>Nos partenaires pour parier en ligne</u></h5>
                <p class="card-text" style="color: black;">
                    Pour parier en ligne il faut s'inscrire chez un "Bookmaker", nous sommes en partenariat avec plusieurs bookmaker pour vous permettre de <strong>jouer 100€ sur votre premier pari, s'il est perdant, vous êtes remboursé !</strong><br>
                    En vous inscrivant chez tous nos partenaires vous bénéficiez donc d'un total de <strong>400€ de pari offerts.</strong><br>
                        Pour vous inscrire il suffit de suivre les instructions suivantes:<br><br>
                    <strong>I)</strong>  Pour commencer sélectionner l'un des sites ci-dessous en cliquant sur leur logo. (<a href="#bk"> Betclic</a>, <a href="#"> France-Pari</a>, <a href="#">Unibet</a>, <a href="#">ZeBet</a>)<br><br>
                        <strong>II) </strong>  Vous allez rediriger sur leur site, pour vous inscrire remplissez le formulaire et munissez-vous d'une photo recto-verso d'un justificatif d'identité (passeport, carte d'identité, permis de conduire) ainsi que votre RIB (pour créditer votre compte et recevoir vos gains sur votre compte bancaire).<br><br>
                        <strong>III) </strong>  Une fois votre inscription terminée, vous pourrez placer votre premier pari en suivant nos pronostics.<br>
                </p>
            </div>
        </div>

        <br>
        <div class="text-center row" id="bk">
            <div class="col"><a href="https://wlbetclicfr.adsrv.eacdn.com/C.ashx?btag=a_3944b_597c_&affid=2962&siteid=3944&adid=597&c=" ><img src="images/logo-betclic.png" class="rounded mx-auto d-block" alt="Betclic-logo" style="max-width: 200px;" /></a><p>100€ offerts</p></div>
            <div class="col"><a href="http://wlfrancepari.adsrv.eacdn.com/C.ashx?btag=a_2185b_549c_&affid=1908&siteid=2185&adid=549&c=&MediaID=549&IsAd=1&IAref=" ><img src="images/logo-francepari.jpg" class="rounded mx-auto d-block" alt="FrancePari-logo" style="max-width: 200px;" /></a><p>50€ offerts</p></div>
        </div>
        <br>

        <div class="card border-warning mb-3 w-80" style="margin-left: 5%; margin-right: 5%; position: relative;" id="#gestion">
            <div class="card-body text-danger">
                <h5 class="card-title" style="color: black;"><u>Comment gérer sa Bankroll ?</u></h5>
                <p class="card-text" style="color: black;">
                    La bankroll est votre argent consacré aux paris sportifs. Nous vous conseillons de démarrer avec 100€ en profitant de l'offre de nos <a href="#partenaires">partenaires</a>.<br>

                    <strong>I)  </strong>Pour suivre nos indications de mises en fonction de votre bankroll c'est très simple. Notre indication est en % c'est le pourcentage de votre bankroll que vous devez miser.<br>
                    <strong><u>Exemple:</u></strong>  Si l'indication de mise est de 3% et que votre bankroll est de 100€, il faut miser 3€.
                </p>
            </div>
        </div>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md text-center">
                    <small class="d-block mb-3 text-muted">Copyright © 2019 HelloPronos. Tous droits réservés. </small>
                </div>
            </div>
        </footer>
    </body>
</html>