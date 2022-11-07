<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include_once 'configs/mysql_db.php';
include_once 'configs/redis.php';
include_once 'models/users.php';



$database = new Database();
$db = $database->getConnection();
$nosqldb = "";
$user = new User($db, $nosqldb);

$redis = new RedisCache();
$redisCache = $redis->getConnection();

$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;
$user->password = $data->password;

if($user->checkLogin()){
    $email = $user->getLogin();
    $token = bin2hex(random_bytes(64));
    $redisCache->set($token, $email);
    $res = ['message' => 'Login successful', 'session' => "$token"];
    echo json_encode($res);
}else{
    // header("HTTP/1.1 401 Unauthorized");
    $res = ['error' => 'Invalid username or password!'];
    echo json_encode($res);
}
?>