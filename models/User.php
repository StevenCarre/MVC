<?php

class User {
    private $login;
    private $password;
    private $id;

    function getLogin(){
        return $this->login;
    }

    function getPassword(){
        return $this->password;
    }

    function getId(){
        return $this->id;
    }

    function setLogin($login){
        $this->login = $login;
        
    }

    function setPassword($password){
        $this->password = $password;

    }

    function setId($id){
        $this->id = $id;

    }
}