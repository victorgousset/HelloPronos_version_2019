<?php
/**
 * Created by PhpStorm.
 * User: conta
 * Date: 02/10/2019
 * Time: 18:15
 */
error_reporting(E_ALL);
ini_set("display_errors","On");

require '../includes/Database.php';



$code = $_GET['code'];

if ($code == 753258) {

    /* Modif du missile */
    if (isset($_POST['submit_missile'])) {
        $m_date = htmlspecialchars($_POST['missile_date']);
        $m_sport = htmlspecialchars($_POST['missile_sport']);
        $m_match = htmlspecialchars($_POST['missile_match']);
        $m_prono = htmlspecialchars($_POST['missile_prono']);
        $m_cote = htmlspecialchars($_POST['missile_cote']);

        if ((!empty($m_date)) && (!empty($m_sport)) && (!empty($m_match)) && (!empty($m_prono)) && (!empty($m_cote))) {
            $database = getPDO();
            $maj_m = $database->prepare("UPDATE pronostic SET missile_date = '. $m_date .', 
                                                                       missile_sport = '. $m_sport .',
                                                                       missile_match = '. $m_match .',
                                                                       missile_prono = '. $m_prono .',
                                                                       missile_cote = '. $m_cote .' WHERE id = 1");
            $maj_m->execute();
            echo "Les changements ont été effectuer";
            $maj_m->closeCursor();
        } else {
            echo "Tous les champs ne sont pas rempli";
        }
    }


    ?>


            <h1>Modification espace VIP</h1><br /><br /><br />

            <h2>Missile</h2>
            <form name="missile">
                <td>
                    <input name="missile_date" type="text" placeholder="Date">
                    <input name="missile_sport" type="text" placeholder="Sport + championnat">
                    <input name="missile_match" type="text" placeholder="Match">
                    <input name="missile_prono" type="text" placeholder="Prono">
                    <input name="missile_cote" type="text" placeholder="Cote / Fiab">
                    <button name="submit_missile" type="submit">Mettre à jour le missile</button>
                </td>
            </form>



<?php } else {
    header('Location: https://hellopronos.com');
}


