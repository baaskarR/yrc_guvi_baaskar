<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include_once 'configs/mysql_db.php';
include_once 'configs/redis.php';
include_once 'models/users.php';
include_once 'configs/mongodb.php';



$database = new Database();
$mongoDB = new MongoDB();
$db = $database->getConnection();
$nosqldb = $mongoDB->getConnection();
$user = new User($db, $nosqldb);


$redis = new RedisCache();
$redisCache = $redis->getConnection();

$data = json_decode(file_get_contents("php://input"));


$email = $redisCache->get($data->session);

$data = $user->getProfile($email);

if($data["email"] != NULL){
    echo json_encode($data);
} else {
    header("HTTP/1.1 401 Unauthorized");
}
?>