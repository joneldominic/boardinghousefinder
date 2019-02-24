<?php
    session_start();

    if (!isset($_SESSION['isloggedin'])) {
        Header('Location: login.php'); 
    }
    
    include_once('includes/header.php');
    include_once('controller/OwnerProfileController.php');
    include_once('controller/UnitController.php');


    $ownerProfControl = new OwnerProfileController;
    $unitControl = new UnitController;

    $ownerInfo = $ownerProfControl->getOwnerInformation($_SESSION["ownerID"]);

    // Add Unit
    if(isset($_POST['btnAddUnit'])) {
        $data = array( 'ownerID' => $_POST['ownerID'],
                        'unitname' => $_POST['unitname'],
                        'location' => $_POST['location'],
                        'capacity' => $_POST['capacity'],
                        'gender' => $_POST['gender'],
                        'accomodation' => $_POST['accomodation'],
                        'monthlyrate' => $_POST['monthlyrate'],
                        'description' => $_POST['description'],
                        'status' => $_POST['status']
                );
    
        $addunit_res = $unitControl->addUnit($data);

        if($addunit_res === TRUE) {

            //If true then add image... ??

            Header('Location: addunit.php');

            echo"  <div class='alert alert-success' role='alert'>
                        <strong>Unit Added Succesfully!</strong>
                    </div>
                ";
        } else {
            // Display Error
            echo"  <div class='alert alert-danger'>
                        <strong>Error!</strong>
                    </div>
                ";
        }
    }

    // print_r($ownerInfo);

?>

    <nav class="navbar navbar-light bg-light navbar-expand-lg">
        <a class="navbar-brand" href="index.php">
            <img src="images/bhouse.jpeg" width="30" height="30" class="d-inline-block align-top" alt="">
            Boardinghouse Finder
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="ownedunit.php"><span class="fa fa-user"></span> 
                        <?php
                            echo $ownerInfo["firstName"]. " ".$ownerInfo["lastName"];
                        ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="controller/logout.php"><span class="fa fa-sign-out-alt"></span> Sign-out</a>
                </li>   
            </ul>
        </div>
    </nav>

    <div class="container my-addunit-cntr p-md-5 ">
            <div class="row card">
                <div class="col-md-5 mx-auto">
                    <div class="form ">
                        <div class="mb-3">
                            <div class="col-md-12 text-center pt-md-4">
                                <h3 >Add Unit</h3>
                            </div>
                        </div>
                        
                        <form method="POST" name="registration">
                            <input type="hidden" name="ownerID" value="<?php echo $_SESSION['ownerID'] ?>">

                            <div class="form-group">
                                <label for="unitname">Unit Name</label>
                                <input type="text"  name="unitname" class="form-control" id="unitname" placeholder="Enter Unit Name" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text"  name="location" class="form-control" id="location" placeholder="Enter Unit Location" required>
                            </div>
                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" id="capacity"  class="form-control" min="1" max="100" value="1" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" class="form-control" >
                                        <option value=0 selected>Male</option>
                                        <option value=1>Female</option>
                                        <option value=2>Male/Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="accomodation">Accomodation</label>
                                <select id="accomodation" name="accomodation" class="form-control" >
                                        <option value=0 selected>Bed Spacer</option>
                                        <option value=1>Room</option>
                                        <option value=2>Apartment</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="monthlyrate">Rate (Monthly)</label>
                                <input type="number" name="monthlyrate" class="form-control" id="monthlyrate" min="0.01" step="0.01" value="500.00" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="description" id="description" rows="5"  placeholder="Enter Unit Description/Features" cols="40" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control" >
                                        <option value=1 selected>Available</option>
                                        <option value=2>Unavailable</option>
                                </select>
                            </div>
                            
                            
<!--                             
                            <div class="card form-group">
                                <div class="card-header">Featured Image</div>
                                <div class="card-body" id ="img-input-cntr">

                                    <input type="file" name="imageFeatured" class="form-control" id="inputImages" required>
                                    <input type="text"  name="imageDesc" class="form-control" id="imageDesc" placeholder="Enter Image Description" required>
                                    
                                </div>
                                <div class="card-footer">
                                    <span id="addImgFieldBtn" class=" btn btn-link tx-tfm"><span class="fa fa-plus"></span> Add Image</span>
                                </div>
                            </div> -->


                            <div class="col-md-12 text-center mb-3">
                                <button type="submit" class=" btn btn-block btn-primary tx-tfm" name="btnAddUnit" id="btnAddUnit">Save Unit</button>
                            </div>
                        </form>


    <!-- triallllll ssssssssssssssssssssssssss -->
                        <!-- <form method="POST" name="image_form">
                            <div class="card form-group">
                                <div class="card-header">Image(s)</div>
                                <div class="card-body" id ="img-input-cntr">

                                    <input type="file" name="image" class="form-control" id="image" required>
                                    <input type="text"  name="imageDesc" class="form-control" id="imageDesc" placeholder="Enter Image Description" required>
                                    
                                </div>
                                <div class="card-footer">
                                    <span id="addImgFieldBtn" class=" btn btn-link tx-tfm"><span class="fa fa-plus"></span> Add Image</span>
                                </div>
                            </div>
                        
                            <div class="col-md-12 text-center mb-3">
                                <button type="submit" class="btn btn-block btn-primary tx-tfm" name="btnUploadImage" id="btnUploadImage">Upload Image</button>
                            </div>
                        </form> -->

    <!-- triallllll ssssssssssssssssssssssssss -->



                    </div>
                </div>
            </div>
        </div>   



<?php
    include_once('includes/footer.php');
?>