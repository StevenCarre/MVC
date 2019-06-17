<?php

class DbController extends ConfigController {

    private $bddServer = '127.0.0.1';
    private $bddName = '';
    private $bddUser = 'root';
    private $bddPassword = '';
    private $bddDriver = '';
    private $bddLink;

    function __construct() {
        parent::__construct();
        $config = parent::getConfigParameter('dbConfig');
        var_dump($config);

        foreach($config as $key=>$value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                echo($method.'<br>');
                $this->$method($value);
                var_dump($this);

            }
        }

        // construction de la chaîne de connexion à mySQL:
        // $dsn = 'mysql:dbname=testdb;host=127.0.0.1';

        $dsn = $this->bdddriver.':dbname='.$this->bddname.';host='.$this->bddserver;

        try {
            $this->bddlink = new PDO($dsn, $this->bdduser, $this->bddserver);
            $this->bddlink = setAttribute(PDO::ATTR_MODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            echo('Connection failed: ' . $e->getMessage());
        }
    }


    function setBddlink($bddlink) {
        $this->bddlink = $bddlink;
    }

        
    function setBdddriver($bdddriver) {
        $this->bdddriver = $bdddriver;
    }

    function setBddserver($bddserver) {
        $this->bddserver = $bddserver;
    }

    function setBddname($bddname) {
        $this->bddname = $bddname;
    }

    function setBdduser($bdduser) {
        $this->bdduser = $bdduser;
    }

    function setBddpassword($bddpassword) {
        $this->bddpassword = $bddpassword;
    }

}