<?php 
require_once('./config.php');

class AuthController {

    public function __construct()
    {
        //checking the connection
        $db = new config;
        $db->dbconnect();
    }

    public function signup($data) {

        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $uname = $data['username'];
        $pass = md5($data['password']); // md5 is 32 character hex number encrytion

        $qry_insert_owner = "INSERT INTO `tbl_owner`(`username`, `password`) VALUES ('$uname', '$pass')";

        // check the connection if successful
        if ($conn->query($qry_insert_owner) === true) {

            $owner_id = $conn->insert_id;
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $address = $data['homeAddress'];
            $phonenumber = $data['contactNumber'];

            $qry_insert_owner_info = "INSERT INTO `tbl_ownerInfo`(`tbl_owner_ownerID`, `firstName`, `lastName`, `address`, `phoneNumber`) VALUES ($owner_id, '$firstname', '$lastname', '$address', '$phonenumber')";


            // preparing rollback incase the insert user_infomation failed
            if ($conn->query($qry_insert_owner_info) === false) {
                $qry_rollback_del = "DELETE FROM `tbl_owner` WHERE `ownerID`=".$owner_id;
                $conn->query($qry_rollback_del);

                echo "Rollback...";

                return false;
            } else {
                Header('Location: login.php'); // redirect to login.php page
            }
        }

        $conn->close(); // close the connection
    }

    // defines the user sessions when logged in
    public function user_session($data)
    {
        session_start();
        $_SESSION["ownerID"] = $data['ownerID'];
        $_SESSION["username"]	= $data['username'];
        $_SESSION["isloggedin"] = true;

        // echo "Session variables are set.";
        
    }

    public function login($data)
    {
        $db = new config; // create config instance
        $conn = $db->dbconnect(); // getting the connection

        $uname = $data['username'];
        $pass = md5($data['password']);

        $qry_get_owner = "SELECT * FROM `tbl_owner` WHERE `username`='$uname' AND `password`='$pass'";
        $user_res = $conn->query($qry_get_owner);

        if ($user_res->num_rows > 0) {
            $user_info = $user_res->fetch_assoc(); // getting the array values from the query result
            $this->user_session($user_info); // calling user_session() in this class to to define sessions

            header('Location: index.php'); // redirects to index.php page

           
            print_r($_SESSION);
            
        } else {
            return false; // returning the fasle if error exist or no data result
        }

        $conn->close(); // close the connection
    }
}

