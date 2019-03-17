<?php
class DB extends PDO
{
	private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "lotus";
	function __construct(){
        parent::__construct("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUsername, $this->dbPassword);
    	$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $q = "SET NAMES utf8";
        $result = $this->prepare($q);
        $result->execute();
    }
    public function arabic()
    {
        $q = "SET NAMES utf8";
        $result = $this->prepare($q);
        $result->execute();
    }
}
