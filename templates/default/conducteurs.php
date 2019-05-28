<?php
//récupératon des paramètres
$conducteurs = $parameters['conducteurs'];
$errors = $parameters['errors'];
$confirm = $parameters['confirmation'];
$modif = $parameters['modification'];

$form = ["inscription","Inscrire un conducteur"];


//vue des conducteurs : préparation
    //TO DO : marquer via les CSS dans le tableau la ligne du conducteur à modifier
$content = [];

if (empty($modif)) : //à mieux articuler ?

    foreach ($conducteurs as $value) :
        $content[] = '<tr><th scope="row">' . $value['id_conducteur'] . '</th>';
        foreach (array_slice($value, 1) as $v) :
            $content[] = '<td>' . $v . '</td>';
        endforeach;
        $content[] = '<td><a href="' . PUBLIC_URL . 'default/conducteur?edit=' . $value['id_conducteur'] . '">🖊️</a></td>';
        $content[] = '<td><a href="' . PUBLIC_URL . 'default/conducteur?remove=' . $value['id_conducteur'] . '">✘</a></td>';
        $content[] = '</tr>';
    endforeach;
    $content = implode('', $content);

else :
    $form = ['modification','Modifier le conducteur ' . $modif['id_conducteur']];
endif;
?>

<section class="container">
    <header>
        <h1 class="text-center display-5 m-5">Les conducteurs</h1>
    </header>

<!--suppression d'un conducteur-->
    <?php
    if (!empty($confirm))
    {
        echo '<div class="alert-danger p-2 text-center">Désirez-vous supprimer le conducteur ';
        echo $confirm[0] . ' ?<br>';
        echo '<a href="' . PUBLIC_URL . 'default/conducteurs?remove=' . $confirm[0] . '&amp;confirm=true">Oui</a></div>';
    }

    if (empty($modif)) :
    ?>

<!--vue des conducteurs-->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id_conducteur</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Modification</th>
                <th scope="col">Suppression</th>
            </tr>
        </thead>
        <tbody>
        <?= $content; ?>
        </tbody>
    </table>

    <?php endif; ?>

<!--ajout ou modification d'un conducteur-->
    <form class="mt-4" method="post" action="<?= PUBLIC_URL . 'default/conducteurs'; ?>">
        <div class="form-group">
            <input type="text"
                    name="prenom"
                    class="form-control <?= isset($errors['prenom']) ? 'is-invalid' : '' ?>"
                    placeholder="Saisissez un prénom"
                    value="<?= $modif['prenom'] ?? null; ?>">
            <div class="invalid-feedback">
                <?= isset($errors['prenom']) ? $errors['prenom'] : '' ?>
            </div>
        </div>
        <div class="form-group">
            <input type="text"
                    name="nom"
                    class="form-control <?= isset($errors['nom']) ? 'is-invalid' : '' ?>"
                    placeholder="Saisissez un nom"
                    value="<?= $modif['nom'] ?? null; ?>">
            <div class="invalid-feedback">
                <?= isset($errors['nom']) ? $errors['nom'] : '' ?>
            </div>
        </div>
        <div class="form-group">
            <?= !empty($modif['id_conducteur']) ? '<input type="hidden" name="id" value="' . $modif['id_conducteur'] . '">' : null; ?>
            <button class="btn btn-block btn-primary" name="valider" value="<?= $form[0]; ?>">
                <?= $form[1]; ?>
            </button>
        </div>
    </form>
</section>
