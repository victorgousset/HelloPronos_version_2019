<?php


class User_prePaiement
{

    private $code;
    private $value_abo;
    private $bdd;

    public function __construct($bdd, $code)
    {
        $this->bdd = $bdd;

        $this->code = $code;
        $this->value_abo = htmlspecialchars($_GET['abo']);
    }

    public function CountAbo()
    {
        $req = $this->bdd->prepare("SELECT * FROM subscribes_vg WHERE id = ?");
        $req->execute(array($this->value_abo));
        return $req->rowCount();
    }

    public function CountSale()
    {
        if($this->CountAbo() == 1)
        {
            $count = $this->bdd->prepare("SELECT * FROM parrain WHERE nom = ?");
            $count->execute(array($this->code));
            return $count->rowCount();
        } else {
            header('https://hellopronos.com/devenir_vip.php');
            var_dump("coucou");
        }
    }

    public function getSale()
    {
        if($this->CountSale() == 1)
        {
            $req = $this->bdd->prepare("SELECT * FROM parrain WHERE nom = ?");
            $req->execute(array($this->code));
            $result = $req->fetch();
            $nom = $result['nom'];

            header("Location: achat_".$this->value_abo."_code_30.php?p=".$nom);
        } else {
            header("Location: achat_".$this->value_abo."code_0.php");
        }
    }

}

//page pour chaque article sans reduc
//page pour chaque article avec reduc
