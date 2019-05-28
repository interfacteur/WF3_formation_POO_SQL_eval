<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evaluation 28 mai 2019 : G. Langhade</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="<?= PUBLIC_URL , 'assets/css/style.css'; ?>">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">


<!--TO DO : rendre visible le menu actif-->

    <!--    et le responsive ??
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>-->

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="<?= PUBLIC_URL . 'default/conducteurs'; ?>">Conducteurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?= PUBLIC_URL . 'default/vehicules'; ?>">Véhicules</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?= PUBLIC_URL . 'default/association'; ?>">Association</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?= PUBLIC_URL . 'default/donnees'; ?>">Données diverses</a>
            </li>
        </ul>
    </div>
</nav>