<?php
//récupératon des paramètres

$association = $parameters['association'];

$content = [];

foreach ($association as $value) :
    $content[] = '<tr><th scope="row">' . $value['id_association'] . '</th>';
    $content[] = '<td>' . $value['prenom'] . ' ' . $value['nom'] . '<br>' . $value['id_conducteur'] . '</td>';
    $content[] = '<td>' . $value['marque'] . ' ' . $value['modele'] . '<br>' . $value['id_vehicule'] . '</td>';
    $content[] = '<td><a href="' . PUBLIC_URL . 'default/association?edit=' . $value['id_association'] . '">🖊️</a></td>';
    $content[] = '<td><a href="' . PUBLIC_URL . 'default/association?remove=' . $value['id_association'] . '">✘</a></td>';
    $content[] = '</tr>';
endforeach;
    $content = implode('', $content);

?>

<section class="container">
    <header>
        <h1 class="text-center display-5 m-5">Les associations</h1>
    </header>


    <!--vue des conducteurs-->
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id_association</th>
            <th scope="col">Conducteur</th>
            <th scope="col">Véhicule</th>
            <th scope="col">Modification</th>
            <th scope="col">Suppression</th>
        </tr>
        </thead>
        <tbody>
        <?= $content; ?>
        </tbody>
    </table>
