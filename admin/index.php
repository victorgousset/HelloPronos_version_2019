<?php
/**
 * Created by PhpStorm.
 * User: conta
 * Date: 02/10/2019
 * Time: 18:15
 */
$code = $_GET['code'];

if ($code == 753258) {
    echo "hey";?>

    <a href="prono.php?code=753258">Gestionnaire de pronos</a>

    <?php
} else {
    header('Location: https://hellopronos.com');
}
?>