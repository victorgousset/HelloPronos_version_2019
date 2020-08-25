<?php

session_start();
require 'includes/Database.php';
include 'includes/UsersInfos.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap / Style CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Devenir VIP</title>
    <style>
        .table11 {
            background-image: url("images/659137.jpg");
            background-size:cover;
            background-repeat: no-repeat;

        }

        .FAQ {
            width: 80%;
            margin-left: 10%;
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>


<div class="table11">
    <br>
    <img src="images/logo-sans-fond.png" style="display: block; margin-left: auto; margin-right: auto; width: 300px; " />
    <br>
<section class="pricingTable p-50">
    <div class="container">

        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="tableInner">
                    <div class="grayTable text-center">
                        <a href="#" class="recommended">1 MOIS</a>
                        <p>0.83€ par jour</p>
                        <p>Un pronostic par jour</p>
                        <p>Gestion de mise</p>
                        <p>Contenu et concours exclusif</p>
                        <div class="price">
                            24.99€
                        </div>

                        <!--<div class="buyNow">
                            <a href="#">BUY NOW</a>
                        </div>-->
                        <a href="stripe/index.php?abo=1"><button type="button" class="btn btn-lg btn-block btn-primary" style="	border-radius: 30px; background-color: rgb(255, 255, 255); font-size: 14px; color: rgb(25, 22, 15); font-weight: 900; padding: 8px 20px; display: inline-block; line-height: 14px; width: 114px; height:45px; " <?php if (isSubscribe()) { ?>disabled<?php } ?>>Devenir VIP</button></a>


                    </div>
                    <!--  -->

                    <div class="middleTable text-center">
                        <a href="#" class="recommended">3 MOIS</a>
                        <p>0.61€ par jour</p>
                        <p>Un pronostic par jour</p>
                        <p>Gestion de mise</p>
                        <p>Contenu et concours exclusif</p>
                        <div class="price">
                            54.99€
                        </div>

                        <!--<div class="buyNow">
                            <a href="#">BUY NOW</a>
                        </div> -->
                        <button onclick="window.location.href='paid-2'" type="button" class="btn btn-lg btn-block btn-primary" style="	border-radius: 30px; background-color: rgb(255, 255, 255); font-size: 14px; color: rgb(25, 22, 15); font-weight: 900; padding: 8px 20px; display: inline-block; line-height: 14px; width: 114px; height:45px; " <?php if (isSubscribe()) { ?>disabled<?php } ?>>Devenir VIP</button>

                    </div>
                    <!--  -->

                    <div class="grayTable grayTableBg text-center">
                        <a href="#" class="recommended">6 MOIS</a>
                        <p>0.47€ par jour</p>
                        <p>Un pronostic par jour</p>
                        <p>Gestion de mise</p>
                        <p>Contenu et concours exclusif</p>
                        <div class="price">
                            84.99€
                        </div>

                        <!--<div class="buyNow">
                            <a href="#">BUY NOW</a>
                        </div> -->
                        <button onclick="window.location.href='paid-3'" type="button" class="btn btn-lg btn-block btn-primary" style="	border-radius: 30px; background-color: rgb(255, 255, 255); font-size: 14px; color: rgb(25, 22, 15); font-weight: 900; padding: 8px 20px; display: inline-block; line-height: 14px; width: 114px; height:45px; " <?php if (isSubscribe()) { ?>disabled<?php } ?>>Devenir VIP</button>


                    </div>
                    <!--  -->

                </div>
            </div>
        </div>
        <!--  -->
    </div>
</section>
</div>

<footer>
    <div class="siteTitle">
        <h1 style="color: white; margin-left: 10%;">Questions <span>Fréquentes</span> </h1>
    </div>
    <section class="FAQ">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Comment devenir VIP ?
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        Pour devenir VIP, il suffit de choisir le forfait qui vous convient le mieux ci-dessus. Vous serez ensuite redirigé vers notre plateforme de paiement sécrurisé. Une fois vos informations de paiements validés vous aurez directement accès à l'espace VIP.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Je n'y connais rien et je n'ai aucune connaissance dans ce domaine, est-ce pour moi ?
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        HelloPronos s'adresse à toutes les personnes de plus de 18 ans, notre abonnement VIP comprend un panel de vidéo explicative pour savoir comment parier. De plus chacun de nos pronostics est accompagné d'indications détaillées sur ce dernier pour que vous puissiez gagner de l'argent.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Qui sommes-nous ?
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        HelloPronos comporte une équipe de plusieurs pronostiqueurs professionnels. Nous partageons nos compétences à travers ce site internet.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Une bankroll ? C'est quoi ?
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        Une bankroll c'est l'argent que vous consacrer aux paris sportifs. Par exemple si vous démarrez avec 100€, votre bankroll sera de 100€ et l'argent que vous gagnerez en plus sera du gain.
                        Pas de panique ! HelloPronos fournit des indications de mise précises en fonction de votre budget afin que vous n'ayer pas à vous préoccuper de la gestion de la bankroll.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Il y a combien de pronostic par mois ? Et à quelle heure sont-ils postés ?
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        Notre équipe poste au MINIMUM 20 analyses par mois, notre équipe est là pour vous faire GAGNER de l'argent, elle préfère donc ne pas vous proposez de pronostic plutôt que de prendre des risques.
                        Généralement les pronostics sont postés 10h à 20h avant le match pour bénéficier des meilleures cotes et de ne négliger aucun détail.
                        Il peut aussi arriver que nous postions des pronostics en live pendant les matchs mais cela reste très rare, si vous renseignez votre numéro de téléphone lors de l'inscription vous serez nottifier par SMS.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Il y a des pronostics gratuits ?
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        Oui il y a 2 à 3 pronostics gratuits par mois sur nos réseaux sociaux. Cependant cela reste très rare l'intérêt est de priviliger les abonnés à notre espace VIP.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            À part les pronostics, le VIP  a-t-il d'autres avantages ?
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        Oui ! Nos abonnés bénéficient de concours exclusif plusieurs fois par mois afin de gagner divers objets et autres...
                        Ils ont aussi la possibilité de se faire rembourser leurs premières mises chez nos partenaires jusqu'à 100€.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Comment annuler mon abonnement VIP ?
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        La résiliation d'un abonnement n'engage aucuns frais supplémentaires et se fait sur votre compte dans la rubrique "paramètres" puis "résilier mon abonnement".
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="footerlogo">
                    <img class="img-fluid" src="images/logo-footer.png" alt="">
                </div>
            </div>
            <!--  -->
            <div class="col-md-3">
                <div class="footerlist">
                    <h2>Navigation</h2>
                    <ul>
                        <li> <a href="#">A propos</a> </li>
                        <li> <a href="#">Contact</a> </li>
                        <li> <a href="#">Conditions d'utilisation</a> </li>
                        <li> <a href="#">Mentions légales</a> </li>
                    </ul>
                </div>
            </div>
            <!--  -->

            <div class="col-md-3">
                <div class="footerlist">
                    <h2>Membres VIP</h2>
                    <ul>
                        <li> <a href="#">Espace VIP</a> </li>
                        <li> <a href="#">Mot de passe perdu</a> </li>
                    </ul>
                </div>
            </div>
            <!--  -->

            <div class="col-md-3">
                <div class="footerlist">
                    <h2>Support</h2>
                    <p>contact@hellopronos.fr</p>
                </div>
            </div>
            <!--  -->

        </div>
    </div>

<br><br>
    <p style="text-align: center; margin: 25px; color: white;">Les jeux d’argent et de hasard sont interdits aux mineurs. Ne prenez pas le risque de tout perdre. Jouer comporte des risques : endettement, dépendance, isolement. Appelez au 09 74 75 13 13 (appel non surtaxé).</p>
    <p style="text-align: center; margin: 25px; color: white;">Les jeux d'argent en ligne sont strictement interdits aux mineurs. Jouez responsable et à votre limite : ne misez pas plus d'argent que vous pouvez vous le permettre, en fonction de vos moyens.</p>
    <p style="text-align: center; margin: 25px; color: white;">Toute personne souhaitant faire l'objet d'une interdiction de jeux doit le faire elle-même auprès du ministère de l'intérieur. Cette interdiction est valable dans les casinos, les cercles de jeux et sur les sites de jeux en ligne autorisés en vertu de la loi n° 2010-476 du 12 mai 2010. Elle est prononcée pour une durée de trois ans non réductible.</p>
    <p style="text-align: center; margin: 25px; text-decoration: underline; color: white;">HelloPronos est engagé contre le jeu excessif.</p>
</footer>
<!-- footer -->

<div class="copyRight">
    &copy; 2019 - HelloPronos | Tous droits réservés. Développé par HelloPronos
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</body>
</html>