<?php
if ($_SERVER['PHP_SELF'] === '/POO_PHP/Netflix_POO/index.php') {
    $pref = "./";
} else {
    $pref = "../";
}
require_once($pref . "Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getModel("Film"));
require_once($routeController->getRepository("FilmRepository"));

class FilmController
{
    public function films($currentPage) // afficher les films sur la page film
    {
        $routeController = new RouteController($_SERVER);
        $urlPoster = $routeController->getAssets() . "img/posters/";
        $ext = ".jpg";
        $filmRepository = new FilmRepository;
        
        $nbResult = 20;

        if (is_numeric($currentPage)) {
            $index = ($currentPage - 1) * $nbResult; // recharger les pages de la pagination
        } else {
            $tmpCurrentPage = explode(",", $currentPage);
            $currentPage = intval($tmpCurrentPage[1]);
            $tmpCurrentPage[0] === "prev" ? $currentPage-- : $currentPage++;
            $index = ($currentPage - 1) * $nbResult;
        }
        $films = $filmRepository->insertFilm($index, $nbResult);
        foreach ($films as $key => $value) {
            if (file_exists($urlPoster . $value['id_movie'] . $ext)) {
                $films[$key]['urlFilm'] = $urlPoster . $value['id_movie'] . $ext;
            } else {
                $films[$key]['urlFilm'] = $urlPoster . "default.jpeg";
            }
        }

        return $films;
    }

    public static function getNbPageFilm()
    { // gérer la pagination
        $filmRepository = new FilmRepository;
        $count = $filmRepository->pageFilm();
        return ceil($count / 20);
    }

    public static function menuGenre()
    { // afficher les genres
        $filmRepository = new FilmRepository;
        return $filmRepository->selectGenres();
    }

    public static function getFilmsByGenre($genre, $currentPage)
    { // afficher les films par genre
        $filmRepository = new FilmRepository;
        $routeController = new RouteController($_SERVER);
        $urlPoster = $routeController->getAssets() . "img/posters/";
        $ext = ".jpg";
        $nbResult = 20;

        if (is_numeric($currentPage)) {
            $index = ($currentPage - 1) * $nbResult; // recharger les pages de la pagination
        } else {
            $tmpCurrentPage = explode(",", $currentPage);
            $currentPage = intval($tmpCurrentPage[1]);
            $tmpCurrentPage[0] === "prev" ? $currentPage-- : $currentPage++;
            $index = ($currentPage - 1) * $nbResult;
        }

        $films = $filmRepository->selectFilmsByGenre($genre, $index, $nbResult);
        foreach ($films as $key => $value) {
            if (file_exists($urlPoster . $value['id_movie'] . $ext)) {
                $films[$key]['urlFilm'] = $urlPoster . $value['id_movie'] . $ext;
            } else {
                $films[$key]['urlFilm'] = $urlPoster . "default.jpeg";
            }
        }
        return $films;
    }

    public static function getNbPage($genre)
    { // gérer la pagination
        $filmRepository = new FilmRepository;
        $count = $filmRepository->pageByGenre($genre);
        return ceil($count / 20);
    }

    public static function pageManager($currentPage, $nbPage, $activePrev, $activePage ,$activeNext)
    {
        $currentPage = strip_tags($currentPage);
        if (!strpos($currentPage, ",")) {
            $currentPage = intval($currentPage);
        }
        if (!is_numeric($currentPage)) {
            $tmpCurrentPage = explode(",", $currentPage);
            if ($tmpCurrentPage[0] === "next") {
                $currentPage = intval($tmpCurrentPage[1]) + 1;
                $activePage = $currentPage;
                if ($currentPage == $nbPage ) {
                    $activeNext = true;
                } 
            } else {
                if ($tmpCurrentPage[1] == 2) {
                    $activePrev = true;
                    $activePage = $currentPage;
                } else {
                    $currentPage = intval($tmpCurrentPage[1]) - 1;
                    $activePage = $currentPage;
                }
            }
        } else {
            $activePage = $currentPage;
        }
        return [ $activePage, $activePrev, $activeNext, $currentPage];
    }

    public static function getSearch($search){
        $filmRepository = new FilmRepository;
        return $filmRepository->selectSearch($search);
    }

    public static function getFilmById($id_movie){
        $filmRepository = new FilmRepository;
        $routeController = new RouteController($_SERVER);
        $urlPoster = $routeController->getAssets() . "img/posters/";
        $ext = ".jpg";
        $result = $filmRepository->selectFilmById($id_movie);
        $film = new Film(
            intval($result['id_movie']),
            $result['title'],
            intval($result['year']),
            $result['genres'],
            $result['plot'],
            $result['directors'],
            $result['cast']
        );
        if (file_exists($urlPoster . $id_movie . $ext)) {
            $film->urlFilm = $urlPoster . $id_movie . $ext;
        } else {
            $film->urlFilm = $urlPoster . "default.jpeg";
        }
        $reactFilm = [
            "title"=>$film->getTitle(),
            "urlFilm"=>$film->urlFilm,
            "year"=>$film->getYear(),
            "plot"=>$film->getPlot(),
            "cast"=>$film->getCast(),
            "genre"=>$film->getGenres(),
            "directors"=>$film->getDirectors()
        ];
        $reactFilm = (object) $reactFilm;
        return json_encode([$reactFilm]);
    }
}
