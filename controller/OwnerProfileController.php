<?php
require_once('./config.php');

class OwnerProfileController {

    public function __construct()
    {
        // check if connected to database
        $db = new config;
        $db->dbconnect();
    }


    public function getOwnerInformation($ownerID)
    {
        $db = new config;
        $dbcon = $db->dbconnect();

        $qry_get_owner_info = "SELECT * FROM tbl_owner as O INNER JOIN tbl_ownerInfo as OI ON O.ownerID = OI.tbl_owner_ownerID WHERE OI.tbl_owner_ownerID = $ownerID";
        $res = $dbcon->query($qry_get_owner_info); 

        return $res->fetch_assoc();
    }

    public function updateOwnerProfile($data)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection


        $ownerID = $data['ownerID'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $homeAddress = $data['homeAddress'];
        $contactNumber = $data['contactNumber'];


        $update_qry = "UPDATE `tbl_ownerInfo` SET 
                        `firstName`='$firstname',
                        `lastName`='$lastname',
                        `address`='$homeAddress',
                        `phoneNumber`='$contactNumber' WHERE `tbl_owner_ownerID` = $ownerID";


        if ($conn->query($update_qry) === false) {
            echo "Failed to Update";
            return false;
        } else {
            Header('Location: updateProfile.php'); // redirect to login.php page
        }
    }

    
}

?>