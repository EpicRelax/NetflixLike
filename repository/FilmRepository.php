<?php
if ($_SERVER['PHP_SELF'] === '/POO_PHP/Netflix_POO/index.php'){
    $pref = "./";
} else {
    $pref = "../";
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getInc("ConnectDB"));

class FilmRepository
{
    public static function selectFilmById($id)
    {
        $pdo = new ConnectDB;
        $rq = "SELECT * FROM movies_full WHERE id_movie = :id";
        $requete = $pdo->connect()->prepare($rq);
        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetch();
        return $result;
    }

    public function insertFilm($index, $nbResult)
    {
        $pdo = new ConnectDB;
        $sql = "SELECT id_movie,title,year,genres,directors,cast,plot FROM movies_full ORDER BY RAND() LIMIT $index, $nbResult";
        $query = $pdo->connect()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function pageFilm(){
        $pdo = new ConnectDB;
        $sql = "SELECT * FROM movies_full";
        $query = $pdo->connect()->prepare($sql);
        $query->execute();
        return $query->rowCount();
    }

    public function selectGenres()
    {
        $pdo = new ConnectDB;
        $sql = "SELECT  
            substring_index(genres, ',', 1)
            AS genre
            FROM movies_full GROUP BY genre
            ";
        $query = $pdo->connect()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function selectFilmsByGenre($genre, $index, $nbResult){
        $pdo = new ConnectDB;
        $sql = "SELECT * FROM movies_full WHERE genres LIKE :genre LIMIT $index, $nbResult ";
        $query = $pdo->connect()->prepare($sql);
        $query->bindValue(":genre", '%'.$genre.'%', PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function pageByGenre($genre){
        $pdo = new ConnectDB;
        $sql = "SELECT * FROM movies_full WHERE genres LIKE :genre";
        $query = $pdo->connect()->prepare($sql);
        $query->bindValue(":genre", '%'.$genre.'%', PDO::PARAM_STR);
        $query->execute();
        return $query->rowCount();
    }

    public function selectSearch($search){
        $pdo = new ConnectDB;
        $sql = "SELECT * FROM movies_full WHERE cast LIKE :search OR title LIKE :search OR directors LIKE :search LIMIT 0,20";
        $query = $pdo->connect()->prepare($sql);
        $query->bindValue(":search", '%'.$search.'%', PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

}
