<?php
    session_start();
    require_once("./storage.inc.php");
    require_once("./auth.inc.php");
    $userStorage = new Storage(new JsonIO("./data/users.json"));
    $auth = new Auth($userStorage);
    
    $auth->logout();
    header("Location: index.php");

?>