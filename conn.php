<?php

try{
    $db = new PDO("mysql:host=localhost;dbname=category;charset=utf8","root","");
}
catch (PDOException $ex){
    echo $ex->getMessage();
}