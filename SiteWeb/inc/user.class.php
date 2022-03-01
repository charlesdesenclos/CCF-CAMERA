<?php 

class User {

    // Init variables
    private $id;
    private $email;
    private $permissions;
    private $sql;

    public function __construct($_SQL) {
        $this->_sql = $_SQL;
    }

    /**
     * 
     * Creation of user in database
     * 
     * email : $_POST['email']
     * password : $_POST['password'] -> sha512
     * 
     * Permissions : 0 -> Spectator AND 1 -> Editor
     * 
     */
    public function register($email, $password) {

        $email = htmlspecialchars($email);
        $password = hash("sha512", $password);

        if(!empty($email) AND !empty($password)) {
            $req = $this->_sql->prepare("INSERT INTO user SET email = :email, password = :password, permission = :permission");
            $req->execute(array(
                "email" => $email, 
                "password" => $password,
                "permission" => 0
            ));

            echo "Inscription réussie.";
        } else {
            echo "Veuillez compléter le champs email et mot de passe.";
        }
    }

    /**
     * 
     * Connection of user
     * 
     * email : $_POST['email']
     * password : $_POST['password'] -> sha512
     * 
     */
    public function login($email, $password) {

        $email = htmlspecialchars($email);
        $password = hash("sha512", $password);

        if(!empty($email) AND !empty($password)) {
            $req = $this->_sql->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
            $req->execute(array($email, $password));

            if($req->rowCount() > 0) {
                $_userinfo = $req->fetch();

                $_SESSION["id"] = $_userinfo["id"];
                $_SESSION["email"] = $_userinfo["email"];
                $_SESSION["permission"] = $_userinfo["permission"];

                header('Location: gestion.php');
            } else {
                echo "Veuillez entrer une adresse email valide.";
            }
        } else {
            echo "Veuillez compléter le champs email et mot de passe.";
        }
    }

    /**
     * 
     * Check if user is Editor
     * 
     */
    public function isEditor() {
        if($_SESSION["permission"] == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * Check if user is Spectator
     * 
     */
    public function isSpectator() {
        if($_SESSION["permission"] == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * Check if user is Connected
     * 
     */
    public function isConnected() {
        if(!empty($_SESSION["email"])) {
            header("Location: gestion.php");
        } else {
            header("Location: login.php");
        }
    }

    /**
     * 
     * Logout user
     * 
     */
    public function logout() {
        session_destroy();
        $_SESSION = array();

        header("Location: login.php");
    }

} 