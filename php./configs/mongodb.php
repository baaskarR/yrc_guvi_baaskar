<?php
require_once '../vendor/autoload.php';
 class MongoDB{

    private $uri;
    private $client;


    // $connection = new Mongo\Client("mongodb://localhost:27017/guvi_proj");
    // $db = $connection->guvi_proj;
    public function getConnection(){
        // $this->uri = "mongodb://localhost:27017/guvi_proj";
        $this->uri = "mongodb://localhost:27017";
        $this->client = new MongoDB\Client($this->uri);
        return $this->client->guvi_proj;
    }
 }

?>
