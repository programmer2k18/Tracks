<?php
require_once '../Tracks/Track.php';
session_start();
class Login
{
    private $username;
    private $password;

    public function login(){

        if (isset($_SESSION['username'])){
            (new Track())->download_track($_GET['url']);
        }
        elseif ($this->authRemotely()){

            $this->setCredentials();
            $this->saveToSession();
            header('Location:../../home.php');
        }

    }

    public function authRemotely(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://nilepromotion.com/pa-test/wp-json/test/v2/creds?username=leap13&password=leap13pass",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $err ? false: true;

    }

    public function setCredentials(){

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $this->setUsername( $this->checkInput( $_POST['username'] ) );
            $this->setPassword( $this->checkInput( $_POST['password'] ) );
        }

    }

    public function checkInput($data) {

        if ( !empty($data) && isset($data) ){
             $data = trim($data);
             $data = stripslashes($data);
             $data = htmlspecialchars($data);
             return $data;
        }
        header('Location:../../home.php');
    }

    public function saveToSession(){
        $_SESSION["username"] = $this->getUsername();
        $_SESSION["password"] = $this->getPassword()? hash("sha256",$this->getPassword()):null;
    }

    public function getUsername() { return $this->username; }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword() { return $this->password; }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}

$obj = new Login();
$obj->login();