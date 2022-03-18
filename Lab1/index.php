<?php

session_start();
require_once("vendor/autoload.php");

ini_set('memory_limit', '-1');

//read cities from file not db
$string = file_get_contents('Resources/city.list.json');
$json_cities = json_decode($string, true);

if (isset($_POST["submit"])) {

    //opposite id to the selected city
    $id = $_POST["city"];

    try {
        //- Example of API call:api.openweathermap.org/data/2.5/weather?q=London,uk&APPID=0ae372e67e58fa79fc73e48b297d3ef8
        //try and catch for any coming problems with the webservice url or connection
        $endpoint_url = api_url . $id . "&APPID=" . api_key;

    } catch (\PDOEXCEPTION$th) {
        //send a message to client
        echo $th->getMessage("Sorry, there is a problem with this webservice");
    } 

   //initialize connection and return handler "default: GET Method"
    $ch = curl_init($endpoint_url);

    //set option >> option : value >>> one of the options in curl help 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

    //execute and return json 
    $result = curl_exec($ch);

    //close connection
    curl_close($ch);

    //convert json to php array and true
    $data = json_decode($result, true);

    //recommended method 
    highlight_string('<?php ' . var_export($data, true) . ';?>');

    //to select specified required data
    // print_r(var_export($data, true) );

    //not to reload weather selection again
    die();
}
?>
<html>
<head>
    <title>Weather Service</title>
</head>
<body>
    <h2>Weather Forecast</h2>
    <form method="post">
        <select name="city" id="city">
            <option value="360995">EG>>Al Jizah</option>
            <option value="361546">EG>>Al Arish</option>
            <option value="362485">EG>>Abu Kabir</option>
            <option value="419435">EG>>Az Zarqa</option>
            <option value="354775">EG>>Kafr ad Dawwar</option>
            <option value="354981">EG>>Juhaynah</option>
            <option value="360526">EG>>Al Qusiyah</option>
            <option value="349340">EG>>Sharm ash Shaykh</option>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Get Weather">
    </form>
</body>
</html>