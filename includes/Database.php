<?php
/**
 * Created by PhpStorm.
 * User: conta
 * Date: 15/09/2019
 * Time: 18:50
 */

/**
 * Connexion à la base de données.
 */
function getPDO() {
    try {
        $pdo = new PDO('mysql:dbname=helloproqzhellop;host=helloproqzhellop.mysql.db', 'helloproqzhellop', 'Rf2tb6x5');
        $pdo->exec("SET CHARACTER SET utf8");
        return $pdo;
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function countDatabaseValue($connexionBDD, $key, $value) {
    $request = "SELECT * FROM users_vg WHERE $key = ?";
    $rowCount = $connexionBDD->prepare($request);
    $rowCount->execute(array($value));
    return $rowCount->rowCount();
}