<?php
session_start();
if ($_SERVER['PHP_SELF'] === '/POO_PHP/Netflix_POO/index.php'){
    $pref = "./";
} else {
    $pref = "../";
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getController("FilmController"));
$filmController = new FilmController;
$nbPage = FilmController::getNbPageFilm();
$url = $routeController->getRoute("singleFilm");
$url = $routeController->getRoute("addPref");
$currentPage = 1;
$activePrev = false;
$activeNext = false;
$activePage = 1;

if(isset($_GET['currentPage']) && !empty($_GET['currentPage'])){
    $repsonsePageManager = FilmController::pageManager($_GET['currentPage'], $nbPage, $activePrev, $activePage, $activeNext);
    $activePrev = $repsonsePageManager[1];
    $activePage = $repsonsePageManager[0];
    $activeNext = $repsonsePageManager[2];
    $currentPage = $repsonsePageManager[3];
    } else {
        $activePrev = true;
    }

$films = $filmController->films($currentPage, $nbPage);
$films = json_encode($films);
require_once($routeController->getController("UserController"));
//UserController::addPref("test",$_SESSION);
$xhrUrl = $routeController->getRoute("addPref");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <!-- LIEN BOOTSWATCH  -->
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <!--  SCRIPT BUNDLE JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!--  LIEN CSS -->
    <link rel="stylesheet" href="<?= $routeController->getAssets()?>css/style.css">
    <!-- LIEN FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- $films -->
    <script>
        const films = <?= $films ?>;
        const dCard = true;
        const url = "<?= $url ?>";
        const xhrUrl = "<?= $xhrUrl ?>"
        const id_user = <?= $_SESSION["user"]["id_user"] ?>;
    </script>
    <!-- SCRIPT REACT -->
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <!-- SCRIPT JS -->
    <script src="<?= $routeController->getAssets()?>js/card.js" type="text/babel" defer></script>
    <!--  BABEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <header>
        <?php include($routeController->getInc("menu")); ?>
    </header>

    <main>
        <section id="cardsFilms"></section>
        <br>
        <?php include($routeController->getInc("paginationFilm")); ?>
    </main>
</body>

</html>