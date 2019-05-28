<?php

namespace Model\Form;

class Control
{

    private $nom;
    private $valeur;
    private $erreur;

    public function __construct($nom, &$erreur)
    {
        $this->nom = $nom;
        $this->valeur = $_POST[$nom];
        $this->erreur = &$erreur;
    }

    public function getValeur()
    {
        return $this->valeur;
    }

    public function validate($error)
    {
        if (empty($this->valeur)) {
            $this->erreur[$this->nom] = $error;
        }
    }


}