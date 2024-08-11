<?php
$serverName = "localhost";
$userName = "root";
$userSenha = "";
$dbName = "sistemalogin";

$conex = mysqli_connect($serverName, $userName, $userSenha, $dbName);

if(mysqli_connect_error()){
    echo "moió " .mysqli_connect_error();
}