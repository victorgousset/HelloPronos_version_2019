<?php
/**
 * Created by PhpStorm.
 * User: conta
 * Date: 15/09/2019
 * Time: 18:54
 */
/**
 * Vérifier si le Client est en ligne!
 */
function isConnected() {
    return isset($_SESSION['userEmail']);
}

/**
 * Vérifier si un Client est Abonnés!
 */
function isSubscribe() {
    if (isConnected()) {
        return $_SESSION['userSubscribe'] == 1;
    }
    return false;
}

/**
 * Nettoyer le Cache des abonnements.
 */
function checkSubscribe($pdo) {
    $request = $pdo->prepare("UPDATE users_vg SET subscribe_delay = ?, subscribe = 0 WHERE subscribe_delay <= NOW()");
    $request->execute([
        null
    ]);
    if (isConnected()) {
        $requestUser = $pdo->prepare("SELECT * FROM users_vg WHERE id = ?");
        $requestUser->execute(array($_SESSION['userID']));
        $userInfo = $requestUser->fetch();
        $_SESSION['userSubscribe'] = $userInfo['subscribe'];
        $_SESSION['userSubscribeDelay'] = $userInfo['subscribe_delay'];
    }
}