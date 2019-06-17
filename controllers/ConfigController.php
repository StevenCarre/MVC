<?php

abstract class ConfigController {
    var $config;

    public function __construct() {
        $this->config = yaml_parse_file(PATHROOT.DS.'conf'.DS.'parameters.yml');



    }

    function getConfigParameter($parameter){

        if(key_exists($parameter, $this->config)) {
            return $this->config[$parameter];
        }
    }
}