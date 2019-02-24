<?php 
require_once('./config.php');


class UnitController {

    public function __construct()
    {
        // check if connected to database
        $db = new config;
        $db->dbconnect();
    }


    public function addUnit($data)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection


        $ownerID = $data['ownerID'];
        $unitname = $data['unitname'];
        $location = $data['location'];
        $capacity = $data['capacity'];
        $gender = $data['gender'];
        $accomodation = $data['accomodation'];
        $monthlyrate = $data['monthlyrate'];
        $description = $data['description'];
        $status = $data['status'];
        $dateUpdated = date("F j, Y");      


        $qry_add_unit = "INSERT INTO `tbl_unit`(`tbl_owner_ownerID`, `unitName`, `location`, `capacity`, `gender`, `accomodation`, `monthlyRate`, `description`, `status`, `dateUpdated`) 
                                        VALUES ($ownerID, '$unitname', '$location', $capacity, $gender, $accomodation, $monthlyrate, '$description', $status, '$dateUpdated')"; 


        // check the connection if successful
        if ($conn->query($qry_add_unit) === true) {

            // Update Image






            return true;
        }

        $conn->close(); // close the connection
    }

    public function addImage($data)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        

        $unitID = 1;//$data['unitID'];
        $description = $data['unitname'];
        $image = $data['location'];
       
        $qry_add_image = "";

        // check the connection if successful
        if ($conn->query($qry_add_image) === true) {
            return true;
        }

        $conn->close(); // close the connection
    }
    




}

?>