<?php
/**
 * Created by PhpStorm.
 * User: conta
 * Date: 15/09/2019
 * Time: 18:47
 */
session_start();
require '../includes/Database.php';
include '../includes/UsersInfos.php';

/**
 * Vérifier si le client est en ligne!
 */
if (isConnected()) {
    header('Location:../');
}

/**
 * Validation du Formulaire.
 */
$code = htmlspecialchars($_GET['code']);
if (isset($_POST['submit'])) {

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);
    $password_confirm = sha1($_POST['password_confirm']);
    $country = htmlspecialchars($_POST['country']);
    $city = htmlspecialchars($_POST['city']);
    $postalcode = htmlspecialchars($_POST['postalcode']);
    $tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
    $cgu = htmlspecialchars($_POST['cgu']);
    date_default_timezone_set('Europe/Paris');
    $date = date('d/m/Y à H:i:s');
    $parrain = htmlspecialchars($_POST['parrain']);

    if ((!empty($pseudo)) && (!empty($firstname)) && (!empty($lastname)) && (!empty($email)) && (!empty($password)) && (!empty($password_confirm)) && (!empty($country))
        && (!empty($city)) && (!empty($postalcode)) && (!empty($cgu))) {
        if (strlen($pseudo) <= 16) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($password == $password_confirm) {
                    $database = getPDO();
                    $rowEmail = countDatabaseValue($database, 'email', $email);
                    if ($rowEmail == 0) {
                        $rowPseudo = countDatabaseValue($database, 'pseudo', $pseudo);
                        if ($rowPseudo == 0) {

                            $insertMember = $database->prepare("INSERT INTO users_vg(pseudo, email, user_password, firstname, lastname, country, city, postalcode, phone, subscribe, register_date, parrain) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $insertMember->execute([
                                $pseudo,
                                $email,
                                $password,
                                $firstname,
                                $lastname,
                                $country,
                                $city,
                                $postalcode,
                                $tel,
                                0,
                                $date,
                                $parrain
                            ]);
                            $messageSucces = "Félicitations, votre compte est maintenant créé !";
                            header('refresh:3;url=../auth/');

                        } else {
                            $messageError = 'Ce pseudo est déjà utilisé...';
                        }
                    } else {
                        $messageError = 'Cette email est déjà utilisée...';
                    }
                } else {
                    $messageError = 'Les mots de passes ne correspondent pas...';
                }
            } else {
                $messageError = "L'Adresse email n'est pas valide...";
            }
        } else  {
            $messageError = 'Le pseudo est trop long, incorrect...';
        }
    } else {
        $messageError = 'Vous devez compléter tous les champs...';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
</head>
<body class="text-center">
<form class="form-signin" method="post" action="">
    <img class="mb-4" src="../images/logo.png" alt="" width="135" height="135">
    <h1 class="h3 mb-3 font-weight-normal">Inscription</h1>

    <!--- Système de Message d'Alerte! -->
    <?php if (isset($messageSucces)) { ?>
        <div class="alert alert-success" style="border-radius: 0px;" role="alert"><?= $messageSucces ?></div>
    <?php } else if (isset($messageError)) { ?>
        <div class="alert alert-danger" style="border-radius: 0px;" role="alert"><?= $messageError ?></div>
    <?php } ?>

    <input type="text" class="form-control" name="pseudo" placeholder="Pseudo" autofocus><br>
    <input type="text" class="form-control" name="firstname" placeholder="Prénom"><br>
    <input type="text" class="form-control" name="lastname" placeholder="Nom"><br>
    <input type="email" class="form-control" name="email" placeholder="Adresse Email"><br>
    <input type="password" class="form-control" name="password" placeholder="Mot de passe"><br>
    <input type="password" class="form-control" name="password_confirm" placeholder="Confirmation Mot de passe"><br>
    <input type="text" class="form-control" name="country" placeholder="Pays"><br>
    <input type="text" class="form-control" name="city" placeholder="Ville"><br>
    <input type="number" class="form-control" name="postalcode" placeholder="Code Postal"><br>
    <input type="tel" class="form-control" name="tel" placeholder="Téléphone (Optionnel)"><br>
    <input type="text" class="form-control" name="parrain" placeholder="Code de parrainage " value="<?php if(isset($_GET['code'])){echo $code;} ?>"><br>
    <input type="checkbox" class="form-control" name="cgu">En cochant cette case vous acceptez les conditions générales d'utilisations.
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">S'Inscrire</button>
    <p class="mt-5 mb-3 text-muted"><a href="../">Accueil</a> - <a href="../auth/">Se Connecter</a></p>
</form>
</body>
</html>