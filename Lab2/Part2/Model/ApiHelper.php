<?php

class ApiHelper
{
    private $method = "get"; //default type
    private $resource;
    private $resource_id;
    private $body_resource;
    private $url;

    public function __construct()
    {
        $this->method = $this->get_method();
        $this->read_resource();

        if ($this->resource === "" || $this->resource_id === -1) {

            $this->output(array("error" => "Resource or Resource does not exist"), 405); //**** */
        }
    }

    //200: default value
    public function output($data, $response_code = 200)
    {
        http_response_code($response_code);
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }

    public function get_method()
    {
        $allowed = array("get", "post", "put", "delete");

        if (in_array(strtolower($_SERVER["REQUEST_METHOD"]), $allowed)) {
            return strtolower($_SERVER["REQUEST_METHOD"]);
        } else {
            $this->output(array("error" => "not supported method"), 405);
        }
    }

    private function read_resource()
    {
        /*  http://localhost/iti/Web_Services/WebServices_Labs/Lab2/Part2/index.php   */

        $this->url = $_SERVER["REQUEST_URI"];
        $pieces = explode("/", $this->url);
        $allowed = array("items", "users", "employees");
        $this->resource = in_array($pieces[7], $allowed) ? $pieces[7] : " ";

        if (isset($pieces[8])) {
            $this->resource_id = is_numeric($pieces[8]) ? $pieces[8] : -1;
        }
    }

    public function get($data)
    {
        $this->output(array("data" => $data), 200);
    }
}