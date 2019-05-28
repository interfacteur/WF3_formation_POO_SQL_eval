<?php

use Controller\DefaultController;

# Chargement de l'autoload des classes
require_once 'autoload.php';

# Chargement de la configuration
require_once 'config.php';

/*
 * Ici, notre fichier index.php représente
 * notre controleur frontal.
 * --------------------------
 * C'est donc lui qui se charge de rediriger
 * la requète de l'utilisateur vers le bon
 * controleur en s'aidant des paramètres dans l'URL !
 */

# Aperçu de $_GET
# echo '<pre>';
# print_r($_GET);
# echo '</pre>';

# Récupération des paramètres GET et affectation d'une valeur par défaut.
# https://www.php.net/manual/fr/language.operators.comparison.php#language.operators.comparison.coalesce
$controller = $_GET['controller'] ?? 'default';
$action     = $_GET['action'] ?? 'conducteurs';

# -- Section routage du front controller | Définir ici les règles de routage.
$defaultCtrl = new DefaultController();

if ($controller == 'default')
{
    switch ($action)
    {
        case 'conducteurs':
            $defaultCtrl->conducteurs();
            break;
        case 'association':
            $defaultCtrl->association();
            break;
        case 'vehicules':
            $defaultCtrl->vehicules();
            break;
        case 'donnees':
            $defaultCtrl->donnees();
            break;
        default:
            $defaultCtrl->conducteurs();
    }

}
