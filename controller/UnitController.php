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
        $binaryImg = addslashes(file_get_contents($data['featureImgTempPath']));


        $qry_add_unit = "INSERT INTO `tbl_unit`(`tbl_owner_ownerID`, `unitName`, `location`, `capacity`, `gender`, `accomodation`, `monthlyRate`, `description`, `status`, `dateUpdated`, `featuredImg`) 
                                        VALUES ($ownerID, '$unitname', '$location', $capacity, $gender, $accomodation, $monthlyrate, '$description', $status, '$dateUpdated', '$binaryImg')"; 


        // check the connection if successful
        if ($conn->query($qry_add_unit) === true) {
                       
            $latestUnitID = $conn->insert_id;
            $image_array = $data['additionalImg_array'];

            // print_r($image_array); 
            // echo $image_array[0]['size'];die;

            if($image_array[0]['size'] > 0) {
                // echo "Naa Additional Image". count($image_array); die;

                for($i=0; $i<count($image_array); $i++){
                   
                    // echo $image_array[$i]["tmp_name"]. "<hr/>"; 
            
                        
                    $binaryImg = addslashes(file_get_contents($image_array[$i]["tmp_name"]));
            
                    // echo $binaryImg;
                           
                    $sql_query_insert = "INSERT INTO `tbl_unitImage` (`tbl_unit_unitID`, `image`) VALUES ('$latestUnitID', '$binaryImg')";
                            
                    if ($conn->query($sql_query_insert) === true) {
                        // echo "Success"; die;
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


}

?>