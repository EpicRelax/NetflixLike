<?php
if ($_SERVER['PHP_SELF'] === '/POO_PHP/Netflix_POO/index.php'){
    $pref = "./";
} else {
    $pref = "../";
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getController("SessionController"));
$activeSession = SessionController::activeSession();
require_once($routeController->getController("FilmController"));
$genres = FilmController::menuGenre();
?>
<script src="<?= $routeController->getAssets()?>js/search.js" defer></script>
<link rel="stylesheet" href="<?= $routeController->getAssets()?>css/menu.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $routeController->getRoute("index"); ?>">NETFLIX <i class="fa-solid fa-video"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if ($activeSession) { ?>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= $routeController->getRoute("index"); ?>">Accueil
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $routeController->getRoute("film"); ?>">Films</a>
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Sélectionner un genre</a>
                    <div class="dropdown-menu">
                    <?php foreach ($genres as $key => $value) { ?>
                        <a class="dropdown-item" href="<?= $routeController->getRoute("categories"); ?>?genre=<?= $value['genre'] ?>"><?= $value['genre'] ?></a>
                        <?php } ?>
                        </div>
                    <?php   //else ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ma liste</a>
                </li>
                <div class="d-flex" id="formAuto">
                    <div id="textSearch" data-xhrurl="<?= $routeController->getInc("search") ?>"></div>
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" id="searchBtn" data-xhrurl="<?= $routeController->getRoute("singleFilm") ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                <?php }?>
            </ul>
            <ul class="navbar-nav d-flex">
                <?php if ($activeSession) { ?>
                    <li class="nav-item">
                        <p class="nav-link active">Bonjour <?= $_SESSION['user']['login'] ?></p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= $routeController->getRoute("logout"); ?>"><i class="fa-solid fa-user"></i> Deconnexion</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $routeController->getRoute("registration"); ?>"><i class="fa-solid fa-user-plus"></i> Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $routeController->getRoute("login"); ?>"><i class="fa-solid fa-user"></i> Connexion</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>