<?php

session_start();
require_once "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection([
    "driver" => Driver,
    "host" => Host,
    "database" => Database,
    "username" => Username,
    "password" => Password,
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$api = new ApiHelper();
if ($api->get_method() == "get") {

    //$data = Connect->data("items")->get();
    $data = $capsule::table("items")->get();
    $api->get($data);
}