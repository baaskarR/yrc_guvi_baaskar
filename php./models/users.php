<?php

class User{
    private $sqlCon;
    private $nosqlCon;
    private $sql_table = "login";
    private $nosql_table = "profile";


    public $firstname;
    public $lastname;
    public $email;
    public $gender;
    public $password;


    public function __construct($sql_db, $nosql_db){
        $this->sqlCon = $sql_db;
        $this->nosqlCon = $nosql_db;
    }


    public function checkEmailExist(){
        $query = "SELECT COUNT(id) AS total FROM " . $this->sql_table . " WHERE email = :email";

        $statement = $this->sqlCon->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));

        $statement->bindParam(":email", $this->email);

        $statement->execute();

        $countData = $statement->fetch(PDO::FETCH_ASSOC);

        if($countData['total'] == 0){
            return false;
        }else{
            return true;
        }
    }

    public function createLogin(){
        $query = "INSERT INTO " . $this->sql_table . " SET email = :email, password = :password";

        $statement = $this->sqlCon->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $statement->bindParam(":email", $this->email);
        $statement->bindParam(":password", $this->password);

        if($statement->execute()){
            return true;
        } else {
            error_log($statement.error);
        }

        return false;
    }

    public function createProfile(){
        $users = array (
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'gender' => $this->gender, 
            'location' => $this->location, 
            'age' => $this->age, 
            'Fd' => $this->Fd,
            'wd' => $this->Wd,
            'dis' => $this->dis,


            
        );
        $this->nosqlCon->Users->insertOne($users);
    }

    public function checkLogin(){
        $query = "SELECT COUNT(id) AS total FROM " . $this->sql_table . " WHERE email = :email AND password = :password";

        $statement = $this->sqlCon->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $statement->bindParam(":email", $this->email);
        $statement->bindParam(":password", $this->password);

        $statement->execute();

        $countData = $statement->fetch(PDO::FETCH_ASSOC);

        if($countData['total'] == 1){
            return true;
        }else{
            return false;
        }
    }

    public function getLogin(){
        $query = "SELECT email FROM " . $this->sql_table . " WHERE email = :email AND password = :password";

        $statement = $this->sqlCon->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $statement->bindParam(":email", $this->email);
        $statement->bindParam(":password", $this->password);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return $data['email'];
    }



    public function getProfile($email_req){
        $users = array (
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'gender' => $this->gender, 
            'location' => $this->location, 
            'age' => $this->age, 
            'Fd' => $this->Fd,
            'wd' => $this->Wd,
            'dis' => $this->dis,

        );
        $result = $this->nosqlCon->Users->findOne(array('email' => $email_req));
        
        $response = array(
            'firstname' => $result["firstname"],
            'lastname' => $result["lastname"],
            'email' => $result["email"],
            'gender' => $result["gender"],
            'location' => $result["location"],
            'age' => $result["age"],
            'Fd' => $result["Fd"],
            'wd' => $result["wd"],
            'dis' => $result["dis"],
            
        );

        return $response;


    }
}

?>
