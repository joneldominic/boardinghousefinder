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
        $rating = $data['stars'];
        $reviewCount = $data['review'];
        $binaryImg = addslashes(file_get_contents($data['featureImgTempPath']));

        $qry_add_unit = "INSERT INTO `tbl_unit`(`tbl_owner_ownerID`, `unitName`, `location`, `capacity`, `gender`, `accomodation`, `monthlyRate`, `description`, `status`, `dateUpdated`,`rating`,`reviewCount`, `featuredImg`) 
                                        VALUES ($ownerID, '$unitname', '$location', $capacity, $gender, $accomodation, $monthlyrate, '$description', $status, '$dateUpdated', '$rating', '$reviewCount', '$binaryImg')"; 

        // check the connection if successful
        if ($conn->query($qry_add_unit) === true) {
                       
            $latestUnitID = $conn->insert_id;
            $image_array = $data['additionalImg_array'];

            if($image_array[0]['size'] > 0) {
               
                for($i=0; $i<count($image_array); $i++){
                   
                    $binaryImg = addslashes(file_get_contents($image_array[$i]["tmp_name"]));
            
                   
                           
                    $sql_query_insert = "INSERT INTO `tbl_unitImage` (`tbl_unit_unitID`, `image`) VALUES ('$latestUnitID', '$binaryImg')";
                            
                    if ($conn->query($sql_query_insert) === true) {
                        // Saved Succesfully
                    } else {
                        echo "Error";
                    }
                    
                }
                
            }
            return true;
        }


        $conn->close(); // close the connection
    }

    // Helper Functions
    function reArrayFiles($file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
    
        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
    
        return $file_ary;
    }


    function getUnitsView($query_condition) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qry = "SELECT `unitID`, `tbl_owner_ownerID`, `unitName`, `location`, `gender`, `accomodation`, `monthlyRate`, `rating`, `reviewCount`, `featuredImg` FROM `tbl_unit` WHERE $query_condition ORDER BY `unitName` ASC";
        $res = $conn->query($qry);

        $units = array();

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                // print_r($row['location']);
                array_push($units, $row);
            }

            $conn->close();
            return $units;
        } else {
            $conn->close();
            return null;
        }

    }

    function getUnitsDetail($unitID) {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $qryDetails = "SELECT 
                        o.tbl_owner_ownerID, 
                        o.firstName AS ownerFName, 
                        o.lastName AS ownerLName, 
                        o.address AS ownerAddress, 
                        o.phoneNumber, 
                        u.unitName, 
                        u.location AS unitLocation, 
                        u.capacity, 
                        u.gender, 
                        u.accomodation, 
                        u.monthlyRate,
                        u.description, 
                        u.status, 
                        u.dateUpdated, 
                        u.rating, 
                        u.reviewCount,
                        u.featuredImg
                        FROM tbl_ownerInfo as o 
                        INNER JOIN tbl_unit as u 
                        ON o.tbl_owner_ownerID = u.tbl_owner_ownerID 
                        WHERE u.unitID = $unitID";

        $qryImages = "SELECT image FROM tbl_unitImage WHERE tbl_unit_unitID = $unitID";

        $resDetails = $conn->query($qryDetails);
        $resImages = $conn->query($qryImages);

        $unitDetails = array();
        $unitImages = array();


        // Min Max Unit ID
        $qryMaxUnit = "SELECT MAX(unitID) AS maxID FROM tbl_unit";
        $qryMinUnit = "SELECT MIN(unitID) AS minID FROM tbl_unit";
        $resMax = $conn->query($qryMaxUnit);
        $resMin = $conn->query($qryMinUnit);
        $unitMaxID = array();  
        $unitMinID = array();
        
      

        if ($resDetails->num_rows > 0) {
            while ($row = $resDetails->fetch_assoc()) {
                array_push($unitDetails, $row);
            }

            while ($row = $resImages->fetch_assoc()) {
                array_push($unitImages, $row);
            }

            while ($rowMax = $resMax->fetch_assoc()) {
                array_push($unitMaxID, $rowMax);
            }

            while ($rowMin = $resMin->fetch_assoc()) {
                array_push($unitMinID, $rowMin);
            }


            $conn->close();
            return array($unitDetails, $unitImages, $unitMaxID, $unitMinID);
        } else {
            $conn->close();
            return null;
        }
    }

    public function updateUnit($data)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection


        $unitID = $data['unitID'];
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


        $edit_unit_qry = "UPDATE 
                            `tbl_unit` SET 
                            `unitName`= '$unitname',
                            `location`= '$location',
                            `capacity`= $capacity,
                            `gender`= $gender,
                            `accomodation`= $accomodation,
                            `monthlyRate`= $monthlyrate,
                            `description`= '$description',
                            `status`= $status,
                            `dateUpdated`= '$dateUpdated'
                            WHERE `unitID` = $unitID
                            AND `tbl_owner_ownerID` = $ownerID";

        if ($conn->query($edit_unit_qry) === false) {
            echo "Failed to Update Unit";
            return false;
        } else {
            return true;
        }
    }

    public function deleteUnit($data) {

        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $unitID = $data['unitID'];
        $ownerID = $data['ownerID'];
       

        $delete_unit_qry1 = "DELETE FROM `tbl_unitImage` WHERE `tbl_unit_unitID` = $unitID";
        $delete_unit_qry2 = " DELETE FROM `tbl_unit` WHERE `unitID` = $unitID AND `tbl_owner_ownerID` = $ownerID";
        
       
        if ($conn->query($delete_unit_qry1) === true) {
            if($conn->query($delete_unit_qry2) === true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

}

?>