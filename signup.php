<?php
    include_once('controller/AuthController.php');

    $authControl = new AuthController;

    if(isset($_POST['btnSignup'])) {
        $data = array( 'username' => $_POST['username'],
                        'password' => $_POST['password'],
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                        'homeAddress' => $_POST['homeAddress'],
                        'contactNumber' => $_POST['contactNumber']
                );
    
        $signup_res = $authControl->signup($data);

        if($signup_res === FALSE) {
            
            // Display Error
            echo "  <div class='alert alert-danger'>
                        <strong>Error!</strong>
                    </div>
                ";
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Boardinghouse Finder (VSU)</title>
        <link rel="icon" href="images/bhouse.jpeg">

        <!-- Bootstrap core CSS -->
        <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- User-defined Stylesheet -->
        <link href="./assets/user-defined/style.css" rel="stylesheet">

        <!-- Font-awesome -->
        <link rel="stylesheet" href="./assets/font-awesome/css/all.css">
    </head>

    <body>
       
        <div class="container">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="form ">
                        <div class="mb-3">
                            <div class="col-md-12 text-center">
                                <h1 >Signup</h1>
                            </div>
                        </div>
                        
                        <form method="POST" name="registration">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text"  name="firstname" class="form-control" id="firstname" placeholder="Enter Firstname" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text"  name="lastname" class="form-control" id="lastname" placeholder="Enter Lastname" required>
                            </div>
                            <div class="form-group">
                                <label for="homeAddress">Address</label>
                                <input type="text" name="homeAddress" id="homeAddress"  class="form-control" placeholder="Enter Address" required>
                            </div>
                            <div class="form-group">
                                <label for="contactNumber">Phone Number</label>
                                <input type="text" name="contactNumber" id="contactNumber"  class="form-control" placeholder="Enter Phone Number" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username"  class="form-control" id="username" placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"  class="form-control" placeholder="Enter Password" required>
                            </div>


                            <div class="col-md-12 text-center mb-3">
                                <button type="submit" class=" btn btn-block btn-primary tx-tfm" name="btnSignup" id="btnSignup">Sign Up</button>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <p class="text-center"><a href="login.php" id="signin">Already have an account?</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
            

        <!-- Bootstrap core JavaScript -->
        <script src="./assets/jquery/jquery.min.js"></script>
        <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- User-defined JScript -->
        <script src="./assets/user-defined/script.js"></script>
    </body>
</html>
