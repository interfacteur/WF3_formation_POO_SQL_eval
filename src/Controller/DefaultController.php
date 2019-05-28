<?php

namespace Controller;


use Model\Db\DbFactory;
use Model\Form\Control;

/**
 * L'Objectif du DefaultController est de s'occuper
 * de la gestion des pages principales du site.
 * ----------------------------
 * En héritant de AbstractController, ma classe
 * DefaultController à maintenant accès à l'ensemble
 * des propriétés et méthodes de AbstractController.
 * NOTA BENE : Une classe ne peut hériter que d'une
 * et une seule autre classe.
 * ------------------------------
 */

// TO DO : factoriser conducteurs(), vehicules() sous forme de d'instances d'une classe

class DefaultController extends AbstractController
{

    /**
     * Page d'accueil du site
     */
    public function conducteurs()
    {
        // TO DO : factoriser /default/conducteurs

        $errors = [];
        $confirmation = [];
        $modification = [];

        $pdo = DbFactory::makePdo(); //TO DO : factoriser à toute la classe


        // traitement des données d'inscription
        if (!empty($_POST) && $_POST['valider'] == 'inscription')
        {
            $prenom = new Control('prenom', $errors);
            $prenom->validate('Veuillez saisir le prénom');

            $nom = new Control('nom', $errors);
            $nom->validate('Veuillez saisir le nom');

            if (empty($errors)) {
                $query = $pdo->prepare('
                        INSERT INTO conducteur(prenom, nom)
                          VALUES (:prenom, :nom)
                    ');
                $query->bindValue(':prenom', $prenom->getValeur(), \PDO::PARAM_STR);
                $query->bindValue(':nom', $nom->getValeur(), \PDO::PARAM_STR);
                $query->execute();
            }
        }

        // demande de suppression
        elseif (isset($_GET['remove']))
        {

            //confirmation de la demande
            if (!isset($_GET['confirm']))
            {
                $confirmation[] = $_GET['remove'];
            }
            // demande confirmée
            else
            {
                $query = $pdo->prepare('
                            DELETE FROM conducteur
                            WHERE id_conducteur = :id_conducteur
                        ');
                $query->bindValue(':id_conducteur', $_GET['remove'], \PDO::PARAM_INT);
                $query->execute();
                $this->redirection(
                    PUBLIC_URL . 'default/conducteurs'
                );
            }
        }


        // demande de modification
        elseif (isset($_GET['edit']))
        {
                // TO DO : à récupérer de extraction des données conducteur () cf. $query->fetchAll() ?
            $query = $pdo->query('
                SELECT *
                FROM conducteur
                WHERE id_conducteur = ' . $_GET['edit']);
            $modification = $query->fetch();
        }
        // traitement des données de modification
        elseif (!empty($_POST) && $_POST['valider'] == 'modification')
        {
            $prenom = new Control('prenom', $errors); // TO DO : factoriser
            $prenom->validate('Veuillez saisir le prénom');

            $nom = new Control('nom', $errors);
            $nom->validate('Veuillez saisir le nom');

            if (empty($errors)) {
                $query = $pdo->prepare('
                        UPDATE conducteur
                        SET prenom = :prenom, nom = :nom
                        WHERE id_conducteur = :id_conducteur
                    ');
                $query->bindValue(':id_conducteur', $_POST['id'], \PDO::PARAM_INT);
                $query->bindValue(':prenom', $prenom->getValeur(), \PDO::PARAM_STR);
                $query->bindValue(':nom', $nom->getValeur(), \PDO::PARAM_STR);
                $query->execute();
           }
        }





        //extraction des données conducteur
        $query = $pdo->query('
            SELECT * FROM conducteur
        ');

        $this->render('default/conducteurs',[
            'conducteurs'   => $query->fetchAll(),
            'errors'        => $errors,
            'confirmation'  => $confirmation,
            'modification'  => $modification
        ]);

    }














    public function association()
    {

//        $modification = [];

        $pdo = DbFactory::makePdo(); //TO DO : factoriser à toute la classe


        //extraction des données association
        $query = $pdo->query('
            SELECT *
                FROM conducteur AS cond
                RIGHT JOIN association_vehicule_conducteur AS assoc
                    ON cond.id_conducteur = assoc.id_conducteur
                LEFT JOIN vehicule AS veh
                    ON assoc.id_vehicule = veh.id_vehicule
        ');

        $this->render('default/association',[
            'association'   => $query->fetchAll()
//            ,
//            'errors'        => $errors,
//            'confirmation'  => $confirmation,
//            'modification'  => $modification
        ]);



    }











    public function vehicules()
    {

        $errors = [];
        $confirmation = [];
        $modification = [];

        $pdo = DbFactory::makePdo(); //TO DO : factoriser à toute la classe


        // traitement des données d'inscription
        if (!empty($_POST) && $_POST['valider'] == 'inscription')
        {
            $marque = new Control('marque', $errors);
            $marque->validate('Veuillez saisir la marque');

            $modele = new Control('modele', $errors);
            $modele->validate('Veuillez saisir le modèle');

            $couleur = new Control('couleur', $errors);
            $couleur->validate('Veuillez saisir la couleur');

           $immatriculation = new Control('immatriculation', $errors);
            $immatriculation->validate('Veuillez saisir l\'immatriculation');

            if (empty($errors)) {
                $query = $pdo->prepare('
                        INSERT INTO vehicule(marque, modele, couleur, immatriculation)
                          VALUES (:marque, :modele, :couleur, :immatriculation)
                    ');
                $query->bindValue(':marque', $marque->getValeur(), \PDO::PARAM_STR);
                $query->bindValue(':modele', $modele->getValeur(), \PDO::PARAM_STR);
                $query->bindValue(':couleur', $couleur->getValeur(), \PDO::PARAM_STR);
                $query->bindValue(':immatriculation', $immatriculation->getValeur(), \PDO::PARAM_STR);
                $query->execute();
            }
        }

        // demande de suppression
        if (isset($_GET['remove']))
        {

            //confirmation de la demande
            if (!isset($_GET['confirm']))
            {
                $confirmation[] = $_GET['remove'];
            }
            // demande confirmée
            else
            {
                $query = $pdo->prepare('
                            DELETE FROM vehiucle
                            WHERE id_vehicule = :id_vehicule
                        ');
                $query->bindValue(':id_vehicule', $_GET['remove'], \PDO::PARAM_INT);
                $query->execute();
                $this->redirection(
                    PUBLIC_URL . 'default/vehicules'
                );
            }
        }


        // demande de modification
        if (isset($_GET['edit']))
        {
            // TO DO : à récupérer de extraction des données conducteur () cf. $query->fetchAll() ?
            $query = $pdo->query('
                SELECT *
                FROM vehicule
                WHERE id_vehicule = ' . $_GET['edit']);
            $modification = $query->fetch();
        }
        // traitement des données de modification
        if (!empty($_POST) && $_POST['valider'] == 'modification')
        {
            $marque = new Control('marque', $errors);
            $marque->validate('Veuillez saisir la marque');

            $modele = new Control('modele', $errors);
            $modele->validate('Veuillez saisir le modèle');

            $couleur = new Control('couleur', $errors);
            $couleur->validate('Veuillez saisir la couleur');

            $immatriculation = new Control('immatriculation', $errors);
            $immatriculation->validate('Veuillez saisir l\'immatriculation');


            if (empty($errors)) {
                $query = $pdo->prepare('
                        UPDATE vehicule
                        SET marque = :marque, modele = :modele, couleur = :couleur, immatriculation = :immatriculation
                        WHERE id_vehicule = :id_vehicule
                    ');
                $query->bindValue(':id_vehicule', $_POST['id'], \PDO::PARAM_INT);
                $query->bindValue(':marque', $marque->getValeur(), \PDO::PARAM_STR);
                $query->bindValue(':modele', $modele->getValeur(), \PDO::PARAM_STR);
                $query->bindValue(':couleur', $couleur->getValeur(), \PDO::PARAM_STR);
                $query->bindValue(':immatriculation', $immatriculation->getValeur(), \PDO::PARAM_STR);
                $query->execute();
            }
        }



        //extraction des données conducteur
        $query = $pdo->query('
            SELECT * FROM vehicule
        ');

        $this->render('default/vehicules',[
            'vehicules'   => $query->fetchAll(),
            'errors'        => $errors,
            'confirmation'  => $confirmation,
            'modification'  => $modification
        ]);



























        $this->render('default/vehicules');
    }








    public function donnees()
    {
        $data = [];

        $pdo = DbFactory::makePdo(); //TO DO : factoriser à toute la classe

        //le nombre de conducteurs
        $query = $pdo->query('
                SELECT COUNT(*) AS nb
                FROM conducteur');
        $data[] = [
            'Afficher le nombre de conducteurs',
            $query->fetch()
        ];

        $query = $pdo->query('
                SELECT COUNT(*) AS nb
                FROM vehicule');
        $data[] = [
            'Afficher le nombre de véhicules',
            $query->fetch()
        ];

        $query = $pdo->query('
                SELECT COUNT(*) AS nb
                FROM association_vehicule_conducteur');
        $data[] = [
            'Afficher le nombre d\'associations',
            $query->fetch()
        ];

        $query = $pdo->query('
                SELECT marque, modele
                FROM vehicule
                WHERE id_vehicule NOT IN(
                    SELECT id_vehicule
                    FROM association_vehicule_conducteur
                )');
        $data[] = [
            'Afficher les vehicules n\'ayant pas de conducteur',
            $query->fetchAll()
        ];


        $this->render('default/donnees', $data);
    }




    /*


Afficher les conducteurs n'ayant pas de vehicule
Afficher les vehicules conduit par "Philippe Pandre"
Afficher tous les conducteurs (meme ceux qui n'ont pas de correspondance) ainsi que les vehicules
Afficher les conducteurs et tous les vehicules (meme ceux qui n'ont pas de correspondance)
Afficher tous les conducteurs et tous les vehicules, peu importent les correspondances
    */


}
