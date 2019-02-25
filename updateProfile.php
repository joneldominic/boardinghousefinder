<?php
    session_start();

    if (!isset($_SESSION['isloggedin']) || !isset($_GET['ownerID'])) {
        Header('Location: login.php'); 
    }
    
    include_once('includes/header.php');
    include_once('includes/navbar/navbar(withuser).php');
    include_once('controller/OwnerProfileController.php');

    $ownerProfControl = new OwnerProfileController;
    $ownerInfo = $ownerProfControl->getOwnerInformation($_SESSION["ownerID"]);
    // print_r($ownerInfo);

    // check if there are POSTS from the form
    if (isset($_POST['btnUpdateProfile'])) {
        $data = array(  'ownerID' => $_POST["ownerID"],
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                        'homeAddress' => $_POST['homeAddress'],
                        'contactNumber' => $_POST['contactNumber'],
                    );

        $res = $ownerProfControl->updateOwnerProfile($data);
        if($res === FALSE) {
            echo "  <div class='alert alert-danger'>
                        <strong>Error!</strong> Account not found.
                    </div>
            ";
        }
    }
?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="form ">
                    <div class="mb-3">
                        <div class="col-md-12 text-center">
                            <h1 >Update Profile</h1>
                        </div>
                    </div>
                    
                    <form method="POST" name="registration">
                        <input type="hidden" name="ownerID" value="<?php echo $_SESSION['ownerID'] ?>">

                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text"  name="firstname" class="form-control" id="firstname" placeholder="Enter Firstname" value="<?php echo $ownerInfo['firstName'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text"  name="lastname" class="form-control" id="lastname" placeholder="Enter Lastname" value="<?php echo $ownerInfo['lastName'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="homeAddress">Address</label>
                            <input type="text" name="homeAddress" id="homeAddress"  class="form-control" placeholder="Enter Address" value="<?php echo $ownerInfo['address'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Phone Number</label>
                            <input type="text" name="contactNumber" id="contactNumber"  class="form-control" placeholder="Enter Phone Number" value="<?php echo $ownerInfo['phoneNumber'] ?>" required>
                        </div>
                                              

                        <div class="col-md-12 text-center mb-3">
                            <button type="submit" class=" btn btn-block btn-primary tx-tfm" name="btnUpdateProfile" id="btnUpdateProfile">Save Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>   

<?php
    include_once('includes/footer.php');
?>