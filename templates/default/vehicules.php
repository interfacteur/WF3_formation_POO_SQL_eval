<?php
//récupératon des paramètres
$vehicules = $parameters['vehicules'];
$errors = $parameters['errors'];
$confirm = $parameters['confirmation'];
$modif = $parameters['modification'];

$form = ["inscription","Inscrire un véhicule"];


//vue des véhicules : préparation
//TO DO : marquer via les CSS dans le tableau la ligne du véhicule à modifier
$content = [];

if (empty($modif)) : //à mieux articuler ?

    foreach ($vehicules as $value) :
        $content[] = '<tr><th scope="row">' . $value['id_vehicule'] . '</th>';
        foreach (array_slice($value, 1) as $v) :
            $content[] = '<td>' . $v . '</td>';
        endforeach;
        $content[] = '<td><a href="' . PUBLIC_URL . 'default/vehicules?edit=' . $value['id_vehicule'] . '">🖊️</a></td>';
        $content[] = '<td><a href="' . PUBLIC_URL . 'default/vehicules?remove=' . $value['id_vehicule'] . '">✘</a></td>';
        $content[] = '</tr>';
    endforeach;
    $content = implode('', $content);

else :
    $form = ['modification','Modifier le véhicule ' . $modif['id_vehicule']];
endif;
?>

<section class="container">
    <header>
        <h1 class="text-center display-5 m-5">Les véhicules</h1>
    </header>

    <!--suppression d'un conducteur-->
    <?php
    if (!empty($confirm))
    {
        echo '<div class="alert-danger p-2 text-center">Désirez-vous supprimer le véhicule ';
        echo $confirm[0] . ' ?<br>';
        echo '<a href="' . PUBLIC_URL . 'default/vehicules?remove=' . $confirm[0] . '&amp;confirm=true">Oui</a></div>';
    }

    if (empty($modif)) :
        ?>

        <!--vue des conducteurs-->
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id_vehicule</th>
                <th scope="col">Marque</th>
                <th scope="col">Modèle</th>
                <th scope="col">Couleur</th>
                <th scope="col">Immatriculation</th>
                <th scope="col">Modification</th>
                <th scope="col">Suppression</th>
            </tr>
            </thead>
            <tbody>
            <?= $content; ?>
            </tbody>
        </table>

    <?php endif; ?>

    <!--ajout ou modification d'un véhicule -->
    <form class="mt-4" method="post" action="<?= PUBLIC_URL . 'default/vehicules'; ?>">
        <div class="form-group">
            <input type="text"
                   name="marque"
                   class="form-control <?= isset($errors['marque']) ? 'is-invalid' : '' ?>"
                   placeholder="Saisissez une marque"
                   value="<?= $modif['marque'] ?? null; ?>">
            <div class="invalid-feedback">
                <?= isset($errors['marque']) ? $errors['marque'] : '' ?>
            </div>
        </div>

        <div class="form-group">
            <input type="text"
                   name="modele"
                   class="form-control <?= isset($errors['modele']) ? 'is-invalid' : '' ?>"
                   placeholder="Saisissez un modèle"
                   value="<?= $modif['modele'] ?? null; ?>">
            <div class="invalid-feedback">
                <?= isset($errors['modele']) ? $errors['modele'] : '' ?>
            </div>
        </div>
        <div class="form-group">
            <input type="text"
                   name="couleur"
                   class="form-control <?= isset($errors['couleur']) ? 'is-invalid' : '' ?>"
                   placeholder="Saisissez une couleur"
                   value="<?= $modif['couleur'] ?? null; ?>">
            <div class="invalid-feedback">
                <?= isset($errors['couleur']) ? $errors['couleur'] : '' ?>
            </div>
        </div>
        <div class="form-group">
            <input type="text"
                   name="immatriculation"
                   class="form-control <?= isset($errors['immatriculation']) ? 'is-invalid' : '' ?>"
                   placeholder="Saisissez une immatriculation"
                   value="<?= $modif['immatriculation'] ?? null; ?>">
            <div class="invalid-feedback">
                <?= isset($errors['immatriculation']) ? $errors['immatriculation'] : '' ?>
            </div>
        </div>
        <div class="form-group">
            <?= !empty($modif['id_vehicule']) ? '<input type="hidden" name="id" value="' . $modif['id_vehicule'] . '">' : null; ?>
            <button class="btn btn-block btn-primary" name="valider" value="<?= $form[0]; ?>">
                <?= $form[1]; ?>
            </button>
        </div>
    </form>
</section>
