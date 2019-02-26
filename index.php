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


    if(isset($_GET['accomodation']) || isset($_GET['gender']) || isset($_GET['monthlyrate']) || isset($_GET['location'])  ) {
        
        // Accommodation
        if($_GET['accomodation'] == "all") {
            $accomodation = 'accomodation LIKE "%"';
        } else {
            $accomodation = 'accomodation = '. $_GET['accomodation'];
        }

        // Gender
        if($_GET['gender'] == "all") {
            $gender = ' AND gender LIKE "%"';
        } else {
            $gender = ' AND gender = '. $_GET['gender'];
        }

        // Monthly Rate
        if ($_GET['monthlyrate'] == "all") {
            $monthlyrate = ' AND monthlyRate LIKE "%"';
        } else if ($_GET['monthlyrate'] == "0") {
            $monthlyrate = ' AND monthlyRate BETWEEN 0.00 AND 499.00';
        } else if ($_GET['monthlyrate'] == "1") {
            $monthlyrate = ' AND monthlyRate BETWEEN 500.00 AND 999.00';
        } else if ($_GET['monthlyrate'] == "2") {
            $monthlyrate = ' AND monthlyRate BETWEEN 1000.00 AND 1499.00';
        }  else if ($_GET['monthlyrate'] == "3") {
            $monthlyrate = ' AND monthlyRate >= 1500.00';
        }

        // Location
        if($_GET['location'] == "all") {
            $location = ' AND location LIKE "%"';            
        } else {
            $loc = $_GET['location'];
            $location = ' AND location LIKE "%'.$loc.'%"';   
        }


        $units = $unitControl->getUnitsView($accomodation . $gender .  $monthlyrate . $location . "AND `status`=1");
    } else {
        $units = $unitControl->getUnitsView("`status`=1");
    }
    

?>  

    

 <!-- Search Bar -->
 <div class="my-filter-cntr">


        <div class="row text-center pb-4">
            <div class="col-md-12 catch-phrase">
                <h3>Find your <q>home away from home</q> the fastest and easiest way</h3>
            </div>
        </div>   

        <hr>
        <div class="row">
            <div class="col-md-12 filter-cntr-col">
                <div class="">
                    <div class="card-body">
                        <form method="GET" name="filter-form" class="row justify-content-center">

                        <!-- Accommodation -->
                            <div class="col-md-2">
                                <div class="form-group">
                                <h6>Accommodation</h6>
                                    <select id="accomodation" name="accomodation" class="form-control">
                                        
                                        <?php if(isset($_GET['accomodation']) && $_GET['accomodation'] != "all") {?>
                                            <option value="all">All</option>
                                            
                                            <option value="0" 
                                                <?php if($_GET['accomodation']==0) { echo "selected"; }?>
                                                >Bed Spacer</option>

                                            <option value="1" 
                                                <?php if($_GET['accomodation']==1) { echo "selected"; }?>
                                                >Room</option>

                                            <option value="2" 
                                                <?php if($_GET['accomodation']==2) { echo "selected"; }?>
                                                >Apartment</option>
                                        <?php } else {?>
                                            <option value="all" selected>All</option>
                                            <option value="0">Bed Spacer</option>
                                            <option value="1">Room</option>
                                            <option value="2">Apartment</option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            
                            <!-- Gender -->
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <h6>Gender</h6>
                                    <select id="gender" name="gender" class="form-control" >
                                        
                                        <?php if(isset($_GET['gender']) && $_GET['gender'] != "all") {?>
                                            <option value="all">All</option>
                                            
                                            <option value="0" 
                                                <?php if($_GET['gender']==0) { echo "selected"; }?>
                                                >Male</option>

                                            <option value="1" 
                                                <?php if($_GET['gender']==1) { echo "selected"; }?>
                                                >Female</option>

                                            <option value="2" 
                                                <?php if($_GET['gender']==2) { echo "selected"; }?>
                                                >Male/Female</option>
                                        <?php } else {?>
                                            <option value="all" selected>All</option>
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                            <option value="2">Male/Female</option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            
                            <!-- Location -->
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <h6>Location</h6>
                                    <select id="location" name="location" class="form-control" >

                                        <?php if(isset($_GET['location']) && $_GET['location'] != "all") {?>
                                            <option value="all">All</option>
                                            
                                            <option value="Gabas" 
                                                <?php if($_GET['location']=="Gabas") { echo "selected"; }?>
                                                >Brgy. Gabas</option>

                                            <option value="Utod" 
                                                <?php if($_GET['location']=="Utod") { echo "selected"; }?>
                                                >Brgy. Guadalupe (Utod)</option>

                                            <option value="Marcus" 
                                                <?php if($_GET['location']=="Marcus") { echo "selected"; }?>
                                                >Brgy. Marcus</option>

                                            <option value="Pangasugan" 
                                                <?php if($_GET['location']=="Pangasugan") { echo "selected"; }?>
                                                >Brgy. Pangasugan</option>

                                            <option value="Patag" 
                                                <?php if($_GET['location']=="Patag") { echo "selected"; }?>
                                                >Brgy. Patag</option>

                                        <?php } else {?>
                                            <option value="all" selected>All</option>
                                            <option value="Gabas">Brgy. Gabas</option>
                                            <option value="Utod">Brgy. Guadalupe (Utod)</option>
                                            <option value="Marcus">Brgy. Marcus</option>
                                            <option value="Pangasugan">Brgy. Pangasugan</option>
                                            <option value="Patag">Brgy. Patag</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Monthly Rate -->
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <h6>Monthly Rate</h6>
                                    <select id="monthlyrate" name="monthlyrate" class="form-control" >

                                        <?php if(isset($_GET['monthlyrate']) && $_GET['monthlyrate'] != "all") {?>
                                            <option value="all">All</option>
                                            
                                            <option value="0" 
                                                <?php if($_GET['monthlyrate']==0) { echo "selected"; }?>
                                                >Php 499 and Below</option>

                                            <option value="1" 
                                                <?php if($_GET['monthlyrate']==1) { echo "selected"; }?>
                                                >Php 500-999</option>

                                            <option value="2" 
                                                <?php if($_GET['monthlyrate']==2) { echo "selected"; }?>
                                                >Php 1000-1499</option>
                                            <option value="3" 
                                                <?php if($_GET['monthlyrate']==3) { echo "selected"; }?>
                                                >Php 1500 and Above</option>
                                        <?php } else {?>
                                            <option value="all" selected>All</option>
                                            <option value="0">Php 499 and Below</option>
                                            <option value="1">Php 500-999</option>
                                            <option value="2">Php 1000-1499</option>
                                            <option value="3">Php 1500 and Above</option>

                                        <?php } ?>
                                        
                                    </select>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="filter-btn col-md-2 text-center pt-md-4">
                                <button id="btnSearchUnit" type="submit" class="btn btn-default">
                                    <span class="fa fa-filter"></span>    
                                    Add Filter
                                </button>
                                <a id="btnSearchUnit" href="index.php" class="btn btn-default">
                                    <span class="fa fa-times h6"></span>    
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
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
