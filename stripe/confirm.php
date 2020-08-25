<?php 




echo "FGHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH";
echo " ";

//token
//nbr de caractere definir
//verifier le token avec contenance precise dans la string (ex: 'AAA' a suivre)

function random_password($car) {
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxy123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ&([-_)]=+%#{}+";
    srand((double)microtime()*1000000);
    for ($i=0; $i<$car; $i++) {
        $string .= $chaine[rand()%strlen($chaine)];
    }
    echo $string;
}
random_password(50);

?>