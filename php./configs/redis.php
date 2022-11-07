<?php
require_once '../vendor/autoload.php';

    class RedisCache{

        private $host = "127.0.0.1";
        private $port = "6379";
        private $redis;


        public function getConnection(){
            $this->redis = new Redis();
            $this->redis->connect($this->host, $this->port);
            // $this->redis->set('ping', 'pong');
            return $this->redis;

        }
    }

?>
