<?php
session_start();

require 'includes/Database.php';
include 'includes/UsersInfos.php';

$database = getPDO();
checkSubscribe($database);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Verification..</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="script" href="css/js/bootstrap.js">
        <link rel="script" href="css/js/bootstrap.min.js">
    </head>
    <body>

        <img src="images/logo.png" class="logo_confirm_php">

        <div class="loader"></div>

        <div style="text-align: center;">
        <?php
        if (!isSubscribe())
        {
            header('refresh:3;url=devenir_vip.php');
        } else {
            header('Refresh:2;url=vip.php');
        }
        ?>
        </div>
    </body>
</html>