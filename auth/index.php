<?php
/**
 * Created by PhpStorm.
 * User: conta
 * Date: 15/09/2019
 * Time: 18:46
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
if (isset($_POST['submit'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);

    if ((!empty($email)) && (!empty($password))) {
        $database = getPDO();
        $requestUser = $database->prepare("SELECT * FROM users_vg WHERE email = ? AND user_password = ?");
        $requestUser->execute(array($email, $password));
        $userCount = $requestUser->rowCount();
        if ($userCount == 1) {

            $userInfo = $requestUser->fetch();
            $_SESSION['userID'] = $userInfo['id'];
            $_SESSION['userPseudo'] = $userInfo['pseudo'];
            $_SESSION['userEmail'] = $userInfo['email'];
            $_SESSION['userPassword'] = $userInfo['user_password'];
            $_SESSION['userFirstname'] = $userInfo['firstname'];
            $_SESSION['userLastname'] = $userInfo['lastname'];
            $_SESSION['userCountry'] = $userInfo['country'];
            $_SESSION['userCity'] = $userInfo['city'];
            $_SESSION['userPostalcode'] = $userInfo['postalcode'];
            $_SESSION['userPhone'] = $userInfo['phone'];
            $_SESSION['userSubscribe'] = $userInfo['subscribe'];
            $_SESSION['userSubscribeDelay'] = $userInfo['subscribe_delay'];
            $_SESSION['userRegisterDate'] = $userInfo['register_date'];
            $_SESSION['userAdmin'] = $userInfo['admin'];
            $_SESSION['userParrain'] = $userInfo['parrain'];

            checkSubscribe($database);
            $messageSucces = 'Bravo, vous êtes maintenant connecté !';
            header('refresh:3;url=../');

        } else {
            $messageError = 'Email ou mot de passe incorrect!';
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
    <title>Connexion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
</head>
<body class="text-center">
<form class="form-signin" method="post" action="">
    <img class="mb-4" src="../images/logo.png" alt="" width="130" height="130">
    <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>

    <!--- Système de Message d'Alerte! -->
    <?php if (isset($messageSucces)) { ?>
        <div class="alert alert-success" style="border-radius: 0px;" role="alert"><?= $messageSucces ?></div>
    <?php } else if (isset($messageError)) { ?>
        <div class="alert alert-danger" style="border-radius: 0px;" role="alert"><?= $messageError ?></div>
    <?php } ?>

    <input type="email" class="form-control" name="email" placeholder="Adresse Email" required autofocus><br>
    <input type="password" class="form-control" name="password" placeholder="Mot de passe" required><br>
    <INPUT type="checkbox" name="1" value="1">Rester connecté

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Se Connecter</button>
    <p class="mt-5 mb-3 text-muted"><a href="../">Accueil</a> - <a href="register.php">S'inscrire</a></p>
</form>
</body>
</html>