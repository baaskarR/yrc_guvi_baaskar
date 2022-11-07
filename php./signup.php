<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 include_once 'configs/mysql_db.php';
 include_once 'models/users.php';
 include_once 'configs/mongodb.php';

 $database = new Database();
 $mongoDB = new MongoDB();
 $db = $database->getConnection();
 $nosqldb = $mongoDB->getConnection();
 $user = new User($db, $nosqldb);
 $data = json_decode(file_get_contents("php://input"));

 $user->firstname = $data->firstname;
 $user->lastname = $data->lastname;
 $user->email = $data->email;
 $user->gender = $data->gender;
 $user->location = $data->location;
 $user->age = $data->age;
 $user->Fd = $data->Fd;
 $user->wd = $data->wd;
 $user->dis = $data->dis;


 if(!$user->checkEmailExist()){
   if($user->createLogin()){
      $user->createProfile();
      $res = ['message' => 'Signed up successfully!'];
      echo json_encode($res);
   } else {
     header('HTTP/1.1 500 Internal Server Error');
     $res = ['error' => 'Unable to Sign up!'];
     echo json_encode($res);
   }
 } else {
   header('HTTP/1.1 500 Internal Server Error');
   $res = ['error' => 'Email already exist'];
   echo json_encode($res);
 }

?>
