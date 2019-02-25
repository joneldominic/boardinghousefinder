<?php
    session_start();
    include_once('includes/header.php');

    // check if there is an account login in session
    if (isset($_SESSION['isloggedin'])) {
        include('includes/navbar/navbar(withuser).php');
    } else {
        include('includes/navbar/navbar(nouser).php');
    }

    include_once('controller/UnitController.php');
    include_once('controller/codedDataHandler.php');


    $unitControl = new UnitController;
    $cdHandler = new codedDataHandler;



    if(isset($_GET['id'])) {
        
        list($unitDetails, $unitImages, $resMax, $resMin) = $unitControl->getUnitsDetail($_GET['id']);

    } else {
        Header('Location: index.php');
    }
    

?>      

    <!-- Boardinghouse unit Carousel -->
    <div class="container bhpage-cntr">

        <div id="bhouse" class="carousel slide my-carousel" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#bhouse" data-slide-to="0" class="active"></li>
                <li data-target="#bhouse" data-slide-to="1"></li>
                <li data-target="#bhouse" data-slide-to="2"></li>
            </ul>

            <div class="carousel-inner">
                <div class="carousel-item active text-center">
                    <img src=<?php echo 'data:image/jpeg;base64,'.base64_encode($unitDetails[0]['featuredImg']); ?> alt="Featured Image">
                </div>

                <?php if (count($unitImages)>0) { ?>
                    <?php foreach ($unitImages as $image) {?>
                        <div class="carousel-item text-center">
                            <img src=<?php echo 'data:image/jpeg;base64,'.base64_encode($image['image']); ?> alt="Featured Image">
                        </div>
                    <?php }?>
                <?php }?>
               
            </div>

            <?php if (count($unitImages)>0) { ?>
                <a class="carousel-control-prev" href="#bhouse" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#bhouse" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            <?php }?>

        </div>

        <hr />

        <h3 class="text-center"><?php echo $unitDetails[0]["unitName"]; ?></h3>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <img class="img-circle img-responsive owner-profile" src="images/temp-profile.jpeg" alt="Owner's Profile">
                <ul class="owner-det">
                    <li><span class="fa fa-user"></span><?php echo " " . $unitDetails[0]["ownerFName"] ." ". $unitDetails[0]["ownerLName"]; ?></li>
                    <li><span class="fa fa-location-arrow"></span> <?php echo " " .$unitDetails[0]["ownerAddress"]; ?> </li>
                    <li><span class="fa fa-mobile"></span> <?php echo " " . $unitDetails[0]["phoneNumber"]; ?></li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="bhouse-det">
                    <li>Status: <?php echo $cdHandler->getStatus($unitDetails[0]['status']) ?></li>
                    <li>Accomodation: <?php echo $cdHandler->getAccomodation($unitDetails[0]['accomodation']) ?></li>
                    <li>Capacity: <?php echo $unitDetails[0]["capacity"]; ?></li>
                    <li>Gender: <?php echo $cdHandler->getGender($unitDetails[0]['gender']) ?></li>
                    <li>Monthly Rate: &#8369; <?php echo $unitDetails[0]['monthlyRate'] ?></li>
                    <li>Location: <?php echo $unitDetails[0]['unitLocation'] ?></li>
                    <li class="ratings">
                            <span>Experience:

                                <? $star = $unitDetails[0]['rating']; ?>
                                    <?php for($i=0; $i<$star; $i++ ) {?>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                <?php } ?>

                                <span class="num-of-rev">(<?php echo $unitDetails[0]['reviewCount'] ?> Reviews)</span>                                     
                            </span>
                    </li>
                    <li>Details: <?php echo $unitDetails[0]['description'] ?> </li>
                </ul>
            </div>
        </div>

        <hr />

        <div class="row my-pager">
            <div class="col">
                <?php if($_GET['id']-1 >= $resMin[0]['minID']) {?>
                    <span class="float-left ">
                        <a href="boardinghouse.php?id=<?php echo $_GET['id']-1 ?>">❮ Previous Unit</a>
                    </span>
                <?php } else {?>
                    <span class="float-left ">
                        <a class="btn disabled" >❮ Previous Unit</a>
                    </span>
                <?php } ?>
            </div>
            <div class="col">
                <?php if($_GET['id']+1 <= $resMax[0]['maxID']) {?>
                    <span class="float-right ">
                        <a href="boardinghouse.php?id=<?php echo $_GET['id']+1 ?>">Next Unit ❯</a>
                    </span>
                <?php } else {?>
                    <span class="float-right ">
                        <a class="btn disabled" >Next Unit ❯</a>
                    </span>
                <?php } ?>
            </div>
        </div>

       
    </div>

<?php 
    include 'includes/footer.php'; 
?>
