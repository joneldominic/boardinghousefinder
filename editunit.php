<?php
    session_start();
    
    if (!isset($_SESSION['isloggedin']) || !isset($_GET['id'])) {
        Header('Location: login.php'); 
    }

    include_once('includes/header.php');
    include_once('controller/OwnerProfileController.php');
    include_once('controller/UnitController.php');
    include_once('controller/codedDataHandler.php');

    $ownerProfControl = new OwnerProfileController;
    $ownerInfo = $ownerProfControl->getOwnerInformation($_SESSION["ownerID"]);

    $unitControl = new UnitController;
    $cdHandler = new codedDataHandler;

    // For data population
    if(isset($_GET['id'])) {
        list($unitDetails, $unitImages) = $unitControl->getUnitsDetail($_GET['id']);
    } else {
        Header('Location: index.php');
    }
    
    // For updating units
    if(isset($_POST['btnUpdateUnit']) && isset($_GET['id'])) {
        
        $data = array( 'unitID' => $_POST['unitID'],
                        'ownerID' => $_POST['ownerID'],
                        'unitname' => $_POST['unitname'],
                        'location' => $_POST['location'],
                        'capacity' => $_POST['capacity'],
                        'gender' => $_POST['gender'],
                        'accomodation' => $_POST['accomodation'],
                        'monthlyrate' => $_POST['monthlyrate'],
                        'description' => $_POST['description'],
                        'status' => $_POST['status']
                        
                        
                        // 'featureImgTempPath' => $_FILES['imageFeatured']["tmp_name"],
                        // 'stars' => $_POST['stars'],
                        // 'review' => $_POST['review'],
                        // 'additionalImg_array' => $unitControl->reArrayFiles($_FILES['additionalImg']),
                );
    
        $updateUnit_res = $unitControl->updateUnit($data);


        if($updateUnit_res === TRUE) {

            Header("Location: editunit.php?id=$data[unitID]"); 

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


    // Deletion of selected unit
    if(isset($_POST['btnDelete']) && isset($_GET['id'])) {
        $data = array( 'unitID' => $_POST['unitID'],
                        'ownerID' => $_POST['ownerID']
                    );
        
        $deleteUnit_res = $unitControl->deleteUnit($data);

        if($deleteUnit_res === TRUE) {

            Header("Location: index.php"); 

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




?>
<!-- Navigation Bar -->
    <nav class="navbar navbar-light bg-light navbar-expand-lg">
        <a class="navbar-brand" href="index.php">
            <img src="images/bhouse.jpeg" width="30" height="30" class="d-inline-block align-top" alt="">
            Boardinghouse Finder <span class="vsu-navbar-label-a" style="font-size: 15px;">(Visayas State University)</span><span class="vsu-navbar-label-b">(VSU)</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="addunit.php"><span class="fa fa-plus"></span> Add Unit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ownedunit.php?ownerID=<?php echo $_SESSION['ownerID']?>"><span class="fa fa-user"></span> 
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


<!-- Edit unit part... -->
    <div class="container my-addunit-cntr p-md-5 ">
            <div class="row card">
                <div class="col-md-5 mx-auto">
                    <div class="form ">
                        <div class="mb-3">
                            <div class="col-md-12 text-center pt-md-4">
                                <h3 >Edit Unit</h3>
                            </div>
                        </div>
                        
                        <form method="POST" name="editunit_form">
                            
                            <input type="hidden" name="unitID" value="<?php echo $_GET['id'] ?>">
                            <input type="hidden" name="ownerID" value="<?php echo $_SESSION['ownerID'] ?>">


                            <div class="form-group">
                                <label for="unitname">Unit Name</label>
                                <input type="text"  name="unitname" class="form-control" id="unitname" placeholder="Enter Unit Name" value="<?php echo $unitDetails[0]['unitName']?>">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text"  name="location" class="form-control" id="location" placeholder="Enter Unit Location" value="<?php echo $unitDetails[0]['unitLocation']?>">
                            </div>
                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" id="capacity"  class="form-control" min="1" max="100" value="<?php echo $unitDetails[0]['capacity']?>">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" class="form-control" >
                                    <?php for ($i =0; $i<3; $i++){ ?>
                                        <?php if ($i ==  $unitDetails[0]['gender']) {?>
                                            <option value=<?php echo $i ?> selected><?php echo $cdHandler->getGender($i);?></option>
                                        <?php } else {?>
                                            <option value=<?php echo $i ?> ><?php echo $cdHandler->getGender($i);?></option>
                                        <?php }?>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="accomodation">Accomodation</label>
                                <select id="accomodation" name="accomodation" class="form-control" >
                                        <?php for ($i =0; $i<3; $i++){ ?>
                                            <?php if ($i ==  $unitDetails[0]['accomodation']) {?>
                                                <option value=<?php echo $i ?>  selected><?php echo $cdHandler->getAccomodation($i);?></option>
                                            <?php } else {?>
                                                <option value=<?php echo $i ?> ><?php echo $cdHandler->getAccomodation($i);?></option>
                                            <?php }?>
                                        <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="monthlyrate">Rate (Monthly)</label>
                                <input type="number" name="monthlyrate" class="form-control" id="monthlyrate" min="0.01" step="0.01" value="<?php echo $unitDetails[0]['monthlyRate']?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="description" id="description" rows="5"  placeholder="Enter Unit Description/Features" cols="40" rows="5"><?php echo $unitDetails[0]['description']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control" >
                                        <?php for ($i =0; $i<2; $i++){ ?>
                                            <?php if ($i ==  $unitDetails[0]['status']) {?>
                                                <option value=<?php echo $i ?>  selected><?php echo $cdHandler->getStatus($i);?></option>
                                            <?php } else {?>
                                                <option value=<?php echo $i ?> ><?php echo $cdHandler->getStatus($i);?></option>
                                            <?php }?>
                                        <?php }?>
                                </select>
                            </div>


                            <!-- <div class="form-group">
                                <label for="image">Image(s)</label>
                                <input type="file" name="image" class="image" id="image">
                            </div> -->



                            <div class="row">
                                <div class="col-md-6 text-center mb-3">
                                    <button type="submit" class=" btn btn-block btn-primary tx-tfm" name ="btnUpdateUnit" id="btnUpdateUnit"><span class="fa fa-edit"></span> Update Unit</button>
                                </div>
                                <div class="col-md-6 text-center mb-3">
                                    <button type="submit" class=" btn btn-block btn-primary tx-tfm" name ="btnDelete" id="btnDelete"><span class="fa fa-trash"></span> Delete Unit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>   



<?php
    include_once('includes/footer.php');
?>