<?php
    session_start();
    include_once('includes/header.php');

    // check if there is an account login in session
    if (isset($_SESSION['isloggedin'])) {
        include('includes/navbar/navbar(withuser).php');
    } else {
        include('includes/navbar/navbar(nouser).php');
    }

    // print_r($_SESSION);

    include_once('controller/UnitController.php');
    include_once('controller/codedDataHandler.php');


    $unitControl = new UnitController;
    $cdHandler = new codedDataHandler;

    $units = $unitControl->getUnitsView(1);




    // if(isset($_GET['gender'])) {
    //     // echo "Yeah Boy"; 
    //     $units = $unitControl->getUnitsView("gender=".$_GET['gender']);
    // } else {
    //     $units = $unitControl->getUnitsView(1);
    // }
    



?>  
    <!-- Search Bar -->
    <div class="my-search-bar">
        <div class="row text-center pb-4">
            <div class="col-md-12">
                <h2>Find your ideal house for learning</h2>
            </div>
        </div>   
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select id="inputState" class="form-control" >
                                        <option selected>Location</option>
                                        <option>Brgy. Gabas</option>
                                        <option>Brgy. Guadalupe (Utod)</option>
                                        <option>Brgy. Marcus (Utod)</option>
                                        <option>Brgy. Pangasugan</option>
                                        <option>Brgy. Patag</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <select id="inputState" class="form-control" >
                                        <option selected>Gender</option>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                        <option value="2">Male/Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <select id="inputState" class="form-control" >
                                        <option selected>Rate (Monthly)</option>
                                        <option>Php 500-999</option>
                                        <option>Php 999-1499</option>
                                        <option>Php 1499 and Above</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <select id="inputState" class="form-control" >
                                        <option selected>Accomodation</option>
                                        <option>Bed Spacer</option>
                                        <option>Room</option>
                                        <option>Apartment</option>
                                    </select>
                                </div>
                            </div>
                    
                            <!-- <div class="col-md-2 text-center">
                                <button type="button" class="btn btn-dark">
                                    <span class="fas fa-search h6"></span>    
                                    Search House
                                </button>
                            </div> -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- List of units -->
    
    <?php if (is_array($units)) {?>

        <div class="units-card container">
        
            <?php $i=0; ?>
            <?php foreach ($units as $unit)  {?>
            <?php   if (!fmod($i,2)){ ?>
                        <div class="row">
            <?php   }?>
                           
            <?php           if(isset($_SESSION['ownerID']) && $_SESSION['ownerID'] == $unit['tbl_owner_ownerID']) {?>

                                <div class="col-md-6">
                                                <div class="card bhouse-cntr">

            <?php                                   $imageHolder = 'data:image/jpeg;base64,'.base64_encode($unit['featuredImg']); ?>

                                                    <img class="card-img-top" src="<?php echo $imageHolder ?>"  alt="Card image cap">
                                                    <div class="card-block">
                                                        <h5 class="card-title text-center mt-2"><?php echo $unit['unitName'] ?></h5>
                                                        <ul class="bhouse-det">
                                                            <li>Accomodation: <?php echo $cdHandler->getAccomodation($unit['accomodation']) ?></li>
                                                            <li>Gender: <?php echo $cdHandler->getGender($unit['gender']) ?></li>
                                                            <li>Monthly Rate: &#8369; <?php echo $unit['monthlyRate'] ?></li>
                                                            <li>Location: <?php echo $unit['location'] ?></li>
                                                        </ul>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="card-text text-center">
                                                           <div class="row">
                                                                <div class="col text-center">
                                                                    <a href="editunit.php?id=<?php echo $unit['unitID']; ?>">
                                                                        <span class="fa fa-edit"></span>
                                                                        Edit Unit
                                                                    </a>
                                                                </div>
                                                                
                                                                <div class="col text-center">
                                                                    <a href="boardinghouse.php?id=<?php echo $unit['unitID']; ?>">
                                                                        <span class="fa fa-eye"></span>
                                                                        View Details
                                                                    </a>
                                                                </div>
                                                           </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

            <?php           } else {?> 
                                            <div class="col-md-6">
                                                <div class="card bhouse-cntr">

            <?php                                   $imageHolder = 'data:image/jpeg;base64,'.base64_encode($unit['featuredImg']); ?>

                                                    <img class="card-img-top" src="<?php echo $imageHolder ?>"  alt="Card image cap">
                                                    <div class="card-block">
                                                        <h5 class="card-title text-center mt-2"><?php echo $unit['unitName'] ?></h5>
                                                        <ul class="bhouse-det">
                                                            <li>Accomodation: <?php echo $cdHandler->getAccomodation($unit['accomodation']) ?></li>
                                                            <li>Gender: <?php echo $cdHandler->getGender($unit['gender']) ?></li>
                                                            <li>Monthly Rate: &#8369; <?php echo $unit['monthlyRate'] ?></li>
                                                            <li>Location: <?php echo $unit['location'] ?></li>
                                                        </ul>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="card-text text-center">
                                                            <a href="boardinghouse.php?id=<?php echo $unit['unitID']; ?>">
                                                                <span class="fa fa-eye"></span>
                                                                View Details
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

            <?php           }?>
            
            <?php   if (fmod($i,2)){ ?>
                        </div>
            <?php   }?>
            <?php   $i++;?>
            <?php }?>

        </div>

    <?php } else {?>
        
        <div class="alert alert-warning text-center">
            <strong>Warning!</strong> No Data Available
        </div>

    <?php } ?>

<hr>

<?php 
    include 'includes/footer.php'; 
?>
