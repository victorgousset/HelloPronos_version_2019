<?php
/**
 * Created by PhpStorm.
 * User: conta
 * Date: 15/09/2019
 * Time: 18:47
 */
// Gestion de la deconnexion.
session_start();
session_destroy();
header('Location: ../auth/');
?>