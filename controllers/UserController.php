<?php

class UserController {

    function loginAction() {
        echo __FILE__ . ': ' . __CLASS__.'/'.__METHOD__;
    }

    function createAction() {
        $user = new User();
        $obdd = new DbController();

        $userPost = array (
            'login' => FILTER_SANITIZE_EMAIL,
            'password' => FILTER_SANITIZE_ENCODED
        );

        $userTab = filter_input_array(INPUT_POST, $userPost);
        $userTab['password'] = password_hash($userTab['password'], PASSWORD_BCRYPT);

        // var_dump($userTab);

        $id = $obdd->newRecordAction($user, $userTab);


        if($id === 0) {
            $_SESSION['msgStyle'] = 'danger';
            $_SESSION['msgTxt'] = 'Erreur lors de la création de l\'utilisateur';
            return 0;
        }
        $_SESSION['msgStyle'] = 'success';
        $_SESSION['msgTxt'] = 'Compte correctement créé';
        return $id;


    }

    function listAction() {
        $user = new User();
        $obdd = new DbController();

        $userCollection = $obdd->findAll($user);

        return array('view'=>'listUser', 'users'=>$userCollection);

    }
}