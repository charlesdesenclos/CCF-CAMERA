<?php 

class Cam {

    // Init variables
    private $id;
    private $localisation;
    private $ipAddress;
    private $port;

    public function __construct($_SQL) {
        $this->_sql = $_SQL;
    }

    /** 
     * 
     * Create camera in database
     * 
     * localisation : $_POST['localisation']
     * ipAddress : $_POST['ipAddress']
     * port : $_POST['port']
     * 
     */
    public function createCam($localisation, $ipAddress, $port) {
        $localisation = htmlspecialchars($localisation);
        $ipAddress = htmlspecialchars($ipAddress);
        $port = htmlspecialchars($port); 

        if(!empty($localisation) AND !empty($ipAddress) AND !empty($port)) {
            $req = $this->_sql->prepare("INSERT INTO cam SET localisation = :localisation, ipAddress = :ipAddress, port = :port");
            $req->execute(array(
                "localisation" => $localisation,
                "ipAddress" => $ipAddress,
                "port" => $port
            ));

            echo "Caméra ajoutée";
        } 
    }

    /** 
     * 
     * Edit camera in database
     * 
     * localisation : $_POST['localisation']
     * ipAddress : $_POST['ipAddress']
     * port : $_POST['port']
     * 
     */
    public function editCam($localisation, $ipAddress, $port) {

    }

    /** 
     * 
     * Delete camera in database 
     * 
     * id : $_POST['idCamera']
     * 
     */
    public function delCam($id) {
        $id = htmlspecialchars($id);

        $req = $this->_sql->prepare("DELETE FROM cam WHERE id = ?");
        $req->execute(array($id));

        echo "Caméra supprimée";
    }

} 