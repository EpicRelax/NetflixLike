<?php
class RouteController {
    public function __construct($server){
        $this->server = $server;
        if( $server['PHP_SELF'] === '/POO_PHP/Netflix_POO/index.php'){
            $this->workDir = ".";
        } else {$this->workDir = '..';}
    }
    private $server;
    private $workDir;
    private $viewDir = "/View/";
    private $controlDir = "/Controller/";
    private $modelDir = "/Model/";
    private $repositoryDir = "/repository/";
    private $incDir = "/inc/";
    private $ext = ".php";

    public function getRoute($route){
        if($route === "index"){
            return $this->workDir;
        } else {
            return $this->workDir.$this->viewDir.$route.$this->ext;
        }
    }
    public function getController($route){
        return $this->workDir.$this->controlDir.$route.$this->ext;
    }
    public function getModel($route){
        return $this->workDir.$this->modelDir.$route.$this->ext;
    }
    public function getRepository($route){
        return $this->workDir.$this->repositoryDir.$route.$this->ext;
    }
    public function getInc($route){
        return $this->workDir.$this->incDir.$route.$this->ext;
    }
    public function getAssets(){
        return $this->workDir.'/assets/';
    }
}