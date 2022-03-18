<?php

class ConnectToAPI
{
    public static function api_connect($id)
    {
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
        return $result;
    }
}