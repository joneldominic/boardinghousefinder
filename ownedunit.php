<?php
    session_start();

    if (!isset($_SESSION['isloggedin']) || !isset($_GET['ownerID'])) {
        Header('Location: login.php'); 
    }

    include_once('includes/header.php');


    include_once('controller/UnitController.php');
    include_once('controller/codedDataHandler.php');


    $unitControl = new UnitController;
    $cdHandler = new codedDataHandler;

    $units = $unitControl->getUnitsView("tbl_owner_ownerID=".$_GET['ownerID']);



?>
    <!-- Navigation Bar -->
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
                    <a class="nav-link" href="addunit.php"><span class="fa fa-plus"></span> Add Unit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="updateProfile.php"><span class="fa fa-user"></span> Update Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="controller/logout.php"><span class="fa fa-sign-out-alt"></span> Sign-out</a>
                </li>  
            </ul>
        </div>
    </nav>

     <!-- List of units -->
    
     <?php if (is_array($units)) {?>

        <div class="units-card container">

            <?php $i=0; ?>
            <?php foreach ($units as $unit)  {?>
            <?php   if (!fmod($i,2)){ ?>
                        <div class="row">
            <?php   }?>

                                <div class="col-md-6">
                                    <div class="card bhouse-cntr">

            <?php                       $imageHolder = 'data:image/jpeg;base64,'.base64_encode($unit['featuredImg']); ?>

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
                                                            <span class="fa fa-eye"></span>
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






















     <!--
     <div class="units-card container">
        <div class="row">
            <div class="col-md-6">
                <div class="card bhouse-cntr">
                    <img class="card-img-top" src="images/sample-unit.jpeg" alt="Card image cap">
                    <div class="card-block">
                        <ul class="bhouse-det">
                            <h5 class="card-title">Gemma's Boardinghouse</h5>
                            <li>Accomodation: Bedspacer</li>
                            <li>Gender: Male</li>
                            <li>Monthly Rate: &#8369; 500.00</li>
                            <li class="ratings">
                                <span>Experience:
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a> 
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a> 
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>  
                                        <span class="num-of-rev">(136 Reviews)</span>                                     
                                    </span>
                            </li>   
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="col">
                            <span class="float-left ">
                                <a href="#">
                                    <span class="fa fa-trash"></span>
                                    Delete Unit
                                </a>
                            </span>
                        </div>
                        <div class="col">
                            <span class="float-right">
                                <a href="editunit.php">
                                    <span class="fa fa-edit"></span>
                                    Edit Unit
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="col-md-6">
                <div class="card bhouse-cntr">
                    <img class="card-img-top" src="images/sample-unit.jpeg" alt="Card image cap">
                    <div class="card-block">
                        <ul class="bhouse-det">
                            <h5 class="card-title">Gemma's Boardinghouse</h5>
                            <li>Accomodation: Bedspacer</li>
                            <li>Gender: Male</li>
                            <li>Monthly Rate: &#8369; 500.00</li>
                            <li class="ratings">
                                <span>Experience:
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <span class="num-of-rev">(12 Reviews)</span>                                     
                                    </span>
                            </li>   
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="col">
                            <span class="float-left ">
                                <a href="#">
                                    <span class="fa fa-trash"></span>
                                    Delete Unit
                                </a>
                            </span>
                        </div>
                        <div class="col">
                            <span class="float-right">
                                <a href="editunit.php">
                                    <span class="fa fa-edit"></span>
                                    Edit Unit
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card bhouse-cntr">
                    <img class="card-img-top" src="images/sample-unit.jpeg" alt="Card image cap">
                    <div class="card-block">
                        <ul class="bhouse-det">
                            <h5 class="card-title">Gemma's Boardinghouse</h5>
                            <li>Accomodation: Bedspacer</li>
                            <li>Gender: Male</li>
                            <li>Monthly Rate: &#8369; 500.00</li>
                            <li class="ratings">
                                <span>Experience:
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a> 
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a> 
                                        <span class="num-of-rev">(76 Reviews)</span>                                     
                                    </span>
                            </li>   
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="col">
                            <span class="float-left ">
                                <a href="#">
                                    <span class="fa fa-trash"></span>
                                    Delete Unit
                                </a>
                            </span>
                        </div>
                        <div class="col">
                            <span class="float-right">
                                <a href="editunit.php">
                                    <span class="fa fa-edit"></span>
                                    Edit Unit
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="col-md-6">
                <div class="card bhouse-cntr">
                    <img class="card-img-top" src="images/sample-unit.jpeg" alt="Card image cap">
                    <div class="card-block">
                        <ul class="bhouse-det">
                            <h5 class="card-title">Gemma's Boardinghouse</h5>
                            <li>Accomodation: Bedspacer</li>
                            <li>Gender: Male</li>
                            <li>Monthly Rate: &#8369; 500.00</li>
                            <li class="ratings">
                                <span>Experience:
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a> 
                                        <span class="num-of-rev">(26 Reviews)</span>                                     
                                    </span>
                            </li>   
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="col">
                            <span class="float-left ">
                                <a href="#">
                                    <span class="fa fa-trash"></span>
                                    Delete Unit
                                </a>
                            </span>
                        </div>
                        <div class="col">
                            <span class="float-right">
                                <a href="editunit.php">
                                    <span class="fa fa-edit"></span>
                                    Edit Unit
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->




<?php
    include_once('includes/footer.php');
?>