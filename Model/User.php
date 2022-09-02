<?php
if ($_SERVER['PHP_SELF'] === '/POO_php/NETFLIX/index.php'){
    $pref = "./";
} else {
    $pref = "../";
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getRepository("UserRepository"));

class User extends UserRepository
{
    public function __construct($email, $login, $pwd, $pref, $role)
    {
        $this->setEmail($email);
        $this->setLogin($login);
        $this->setPwd($pwd);
        $this->setPref($pref);
        $this->setRole($role);
    }
    // propriètés de la class User
    private $id_user;
    private $email;
    private $login;
    private $pwd;
    private $pref;
    private $role;

    // méthodes (fonctions) de la class
    /**
     * fonction de vérification de valeurs transmises à mes setters
     *
     * @param [type] $valeur // valeur des propriètés de la class transmise à mon setter
     * @param [string] $champ // nom du champ (colonne) de la table de ma BDD 
     * @param [type] $type // type de la valeur acceptée : int, string, bool ou array
     * @param [type] $empty // true = la valeur ne peut être null 
     * @return void
     */
    public function controlSetter($valeur, $champ, $type, $empty)
    { // ce sont les paramètres de ma méthode (fonction)
        if ($empty && !empty($valeur) && $empty !== "") {
            if ($type === "int" && is_int($valeur)) {
                return $valeur;
            } else if ($type === "string" && is_string($valeur)) {
                return $valeur;
            } else if ($type === "bool" && is_bool($valeur)) {
                return $valeur;
            } else if ($type === "array" && is_array($valeur)) {
                return serialize($valeur);
            } else {
                throw new Exception("$champ doit être de type $type !");
            }
        } else {
            throw new Exception("$champ ne doit pas être vide !");
        }
    }
    public function getId_user()
    {
        return $this->id_user;
    }
    public function setId_user($id_user)
    {
        $this->controlSetter($id_user, "id_user", 'int', true);
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $this->controlSetter($email, "email", 'string', true);
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $this->controlSetter($login, "login", 'string', true);
    }
    public function getPwd()
    {
        return $this->pwd;
    }
    public function setPwd($pwd)
    {
        $this->pwd = $this->controlSetter($pwd, "pwd", 'string', true);
    }
    public function getPref()
    {
        return unserialize($this->pref);
    }
    public function setPref($pref)
    {
        $this->pref = $this->controlSetter($pref, "pref", 'array', true);
    }
    public function getRole()
    {
        $role = unserialize($this->role); 
        return $role;
    }
    public function setRole($role)
    {
        $this->role = $this->controlSetter($role, "role", 'array', true);
    }
}
