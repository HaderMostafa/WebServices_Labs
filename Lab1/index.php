<?php

session_start();
require_once "vendor/autoload.php";
require_once "Views/selected_city_weather.php";

ini_set('memory_limit', '-1');

//read cities from file not db
$string = file_get_contents('Resources/city.list.json');
$json_cities = json_decode($string, true);
if (isset($_POST["submit"])) {

    //opposite id to the selected city
    $id = $_POST["city"];

    $result = ConnectToAPI::api_connect($id);

    //convert json to php array and true
    $data = json_decode($result, true);

    //recommended method
    highlight_string('<?php ' . var_export($data, true) . ';?>');

}