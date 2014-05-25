<?php

require 'vendor/autoload.php';
use \App\Payicam\Ginger\Config;
use \App\Payicam\Ginger\Users;
use \App\Payicam\Ginger\Applications;

require "config.php";
Config::initFromArray($_CONFIG);

// Initialisation de la connexion à la DataBase
require_once 'class/DB.php';
$DB = new DB(Config::get('sql_host'),Config::get('sql_user'),Config::get('sql_pass'),Config::get('sql_db'));

// Parse l'url
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$actions = explode('/', $path);

// On cherche index.php et on ne garde que ce qu'il y a après
$first = array_search("index.php", $actions) + 1;
$actions = array_slice($actions, $first);

if($actions[0] != "v1")
    die("Version non supportée");

// Authentification de l'application
if(empty($_GET["key"]) || !Applications::checkApp($_GET["key"]))
    die("Clé invalide");

if(empty($actions[1]))
    die("Pas d'action");

if($actions[1] == "find" || $actions[1] == "cotisations" || (!empty($actions[1]) && !empty($actions[2]) && $actions[2] == "cotisations"))
    die("Action non implémentée");

if($actions[1] == "badge" && !empty($actions[2]))
    $user = Users::getByBadge($actions[2]);
else if(!empty($actions[1]))
    $user = Users::getByLogin($actions[1]);

if($user != null)
    echo json_encode($user);        
else
    header("HTTP/1.0 404 Not Found");