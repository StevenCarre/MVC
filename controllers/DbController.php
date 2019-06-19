<?php

class DbController extends ConfigController {

    private $bddserver = '127.0.0.1';
    private $bddname = '';
    private $bdduser = 'root';
    private $bddpassword = '';
    private $bdddriver = '';
    private $bddlink;

    function __construct() {
        parent::__construct();
        $config = parent::getConfigParameter('dbConfig');
        // var_dump($config);

        foreach($config as $key=>$value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                // echo($method.'<br>');
                $this->$method($value);
                // var_dump($this);

            }
        }

        // construction de la chaîne de connexion à mySQL:
        // $dsn = 'mysql:dbname=testdb;host=127.0.0.1';

        $dsn = $this->bdddriver.':dbname='.$this->bddname.';host='.$this->bddserver;        
        // var_dump($dsn);

        try {
            $this->bddlink = new PDO($dsn, $this->bdduser, $this->bddpassword);
            $this->bddlink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    function newRecordAction(Object $object, array $data=array()) {
        try {
            if(empty($data)) {
                throw new Exception(__METHOD__.' '.__LINE__.'Data ne peut être vide');
            }

        $table = strtolower(get_class($object));
        
        $rowColumns = "`".implode("`,`", array_keys($data))."`";
        $rowValues = ':'.implode(',:', array_keys($data));

        // echo $rowColumns."<br>";
        // echo $rowValues."<br>";

        $reqNewRecord = 'INSERT INTO '.$table.' ('.$rowColumns.') VALUES ('.$rowValues.')';
        
        // echo $reqNewRecord; die;

        $record = $this->bddlink->prepare($reqNewRecord);
        $record->execute($data);
        return $this->bddlink->lastInsertId();
        }
        catch(Exception $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    function findAll(object $object) {
        try {
            $table = strtolower(get_class($object));
            $query = "SELECT * FROM ".$table;

            $request = $this->bddlink->prepare($query);
            $request->execute();

            $result = $request->fetchAll(PDO::FETCH_CLASS, $table);

            return $result;

        } catch(Exception $e) {
            echo $e->getMessage();
            return 0;
        } 
    }

}