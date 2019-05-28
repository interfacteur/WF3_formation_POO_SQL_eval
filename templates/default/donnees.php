<section class="container data">
    <header>
        <h1 class="text-center display-5 m-5">Données diverses</h1>
    </header>

    <?php
    foreach (array_slice($parameters, 0, 3) as $value) :
        echo '<h2>o ' . $value[0] . '</h2>';
    echo '<strong>' . $value[1]['nb'] . '</strong>';
    endforeach;

    echo '<h2>o ' . $parameters[3][0] . '</h2>';
    foreach($parameters[3][1] as $value)
    {
           echo '<strong>' . implode(',', $value) . '</strong><br>';
    }

    ?>
</section>


<!---->
<!--<h2>o Afficher le nombre de vehicule.</h2>-->
<!--<h2>o Afficher le nombre d'association.</h2>-->
<!--<h2>o Afficher les vehicules n’ayant pas de conducteur</h2>-->
<!--<h2>o Afficher les conducteurs n’ayant pas de vehicule</h2>-->
<!--<h2>o Afficher les vehicules conduit par « Philippe Pandre »</h2>-->
<!--<h2>o Afficher tous les conducteurs (meme ceux qui n'ont pas de correspondance) ainsi que les vehicules</h2>-->
<!--<h2>o Afficher les conducteurs et tous les vehicules (meme ceux qui n'ont pas de correspondance)</h2>-->
<!--<h2>o Afficher tous les conducteurs et tous les vehicules, peut importe les correspondances.</h2>-->
<!---->
<!---->
