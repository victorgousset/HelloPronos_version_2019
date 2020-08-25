<?php
/**
 * Created by PhpStorm.
 * User: conta
 * Date: 18/09/2019
 * Time: 18:58
 */
function random_password($car) {
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxy123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ&([-_)]=+%#{}+";
    srand((double)microtime()*1000000);
    for ($i=0; $i<$car; $i++) {
        $string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
}