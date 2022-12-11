<?php

spl_autoload_register(function($className){
    $className = str_replace('App/', '', $className);
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className) .".php";

    if(file_exists($className)){
    require_once($className);
    }
});

?>