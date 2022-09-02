<?php
session_start();
if ($_SERVER['PHP_SELF'] === '/POO_PHP/Netflix_POO/index.php') {
    $pref = "./";
} else {
    $pref = "../";
}
require_once($pref . "Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getController("FilmController"));
if(isset($_GET["id_movie"]) && !empty($_GET["id_movie"])){
    $film = FilmController::getFilmById(strip_tags($_GET["id_movie"]));
} else {
    header("Location: ".$routeController->getRoute("index"));
}

$url = $routeController->getRoute("singleFilm");
$xhrUrl = $routeController->getRoute("addPref");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix</title>
    <!-- LIEN BOOTSWATCH  -->
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <!-- LIEN FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $routeController->getAssets() ?>css/singleCard.css">
    <script>
        const films = <?= $film ?>;
        const dCard = false;
        const url = "<?= $url ?>";
        const xhrUrl = "<?= $xhrUrl ?>";
    </script>
    <!-- SCRIPT REACT -->
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <!-- SCRIPT JS -->
    <script src="<?= $routeController->getAssets() ?>js/card.js" type="text/babel" defer></script>
    <!--  BABEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <header>
        <?php
        include_once($routeController->getInc("menu"));
        ?>
    </header>
    <main>
        <section id="cardsFilms"></section>
    </main>
</body>