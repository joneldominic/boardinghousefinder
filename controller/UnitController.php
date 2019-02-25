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

        $qry = "SELECT `unitID`, `unitName`, `location`, `gender`, `accomodation`, `monthlyRate`, `rating`, `reviewCount`, `featuredImg` FROM `tbl_unit` WHERE $query_condition ORDER BY `unitName` ASC";
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


    // public function getPosts($query_condition) {
      
    //     // $qry = "SELECT * FROM posts WHERE user_id LIKE '$userID' AND privacy=1 OR privacy=2 ORDER BY date_posted DESC";
    //     $qry = "SELECT * FROM posts WHERE $query_condition ORDER BY date_posted DESC";
    //     $res = $conn->query($qry);

    //     $post_ID = array();
    //     $post_userID = array();
    //     $post_titles = array();
    //     $post_contents = array();
    //     $post_datePosted = array();
    //     $post_privacy = array();

    //     if ($res->num_rows > 0) {
    //         while ($row = $res->fetch_assoc()) {
    //             array_push($post_ID, $row['id']);
    //             array_push($post_userID, $row['user_id']);
    //             array_push($post_titles, $row['title']);
    //             array_push($post_contents, $row['content']);
    //             array_push($post_datePosted, $row['date_posted']);
    //             array_push($post_privacy, $row['privacy']);
    //         }

    //         $conn->close();
    //         return array($post_ID, $post_userID, $post_titles, $post_contents, $post_datePosted, $post_privacy);
    //     } else {
    //         $conn->close();
    //         return null;
    //     }
    // }

}

?>