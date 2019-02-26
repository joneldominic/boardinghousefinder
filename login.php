<?php
    // check if there is an account login in session
    if (isset($_SESSION['isloggedin'])) {
        header('Location: index.php'); // redirect to index.php page
    }

    include_once('controller/AuthController.php');

    $authControl = new AuthController;

    // check if there are POSTS from the form
    if (isset($_POST['btnLogin'])) {
        $data = array( 'username' => $_POST['username'],
                      'password' => $_POST['password']
                    );


        $login = $authControl->login($data); 

        if ($login === false) {
            
            // Display Error
            echo "  <div class='alert alert-danger'>
                        <strong>Error!</strong> Account not found.
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

        <title>Boardinghouse Finder</title>
        <link rel="icon" href="images/logo.png">

        <!-- Bootstrap core CSS -->
        <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- User-defined Stylesheet -->
        <link href="./assets/user-defined/style.css" rel="stylesheet">

        <!-- Font-awesome -->
        <link rel="stylesheet" href="./assets/font-awesome/css/all.css">
    </head>

    <body>

            


        <div class="container log-in-page">

            <div class="row">
                <div class="col-12">
                    <a href="index.php">
                        <img class="mx-auto d-block logo" src="images/logo-A.png" width="300">  
                    </a>
                </div>
            </div>

            <div class="row">
			    <div class="col-md-5 mx-auto">
                    <div class="form ">
                        
                        <form method="POST" name="login">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username"  class="form-control" id="username" placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
                            </div>
                            <div class="col-md-12 text-center ">
                                <button type="submit" class=" btn btn-block btn-primary tx-tfm" name="btnLogin" id="btnLogin">Login</button>
                            </div>
                            <div class="form-group">
                                <p class="text-center">Don't have account? <a href="signup.php" id="btnSignup">Sign up here</a></p>
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
        <script src="./assets/user-defined/signup-register.js"></script>
    </body>
</html>
