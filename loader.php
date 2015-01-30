<?php

function load($namespace) {
    
    if(class_exists($namespace))
    {
        var_dump($namespace . "  exists");
        return;
    }
    
    $projectRootPath = __DIR__ .  DIRECTORY_SEPARATOR;
    $file =  $projectRootPath . str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . ".php";
    
    if (file_exists($file))
        include $file;
    else{                
        error_log("Class not found: " . $file);        
        throw new \Exception("Class not found: " . $file);
        //mail('leovolpatto@gmail.com', 'Classe nao encontrada', "Nao foi encontrado: $file   nem   $file1");
    }
}

spl_autoload_register(__NAMESPACE__ . '\load');