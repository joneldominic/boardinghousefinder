<?php
    include_once('controller/OwnerProfileController.php');

    $ownerProfControl = new OwnerProfileController;
    $ownerInfo = $ownerProfControl->getOwnerInformation($_SESSION["ownerID"]);
    // print_r($ownerInfo);
?>

<nav class="navbar navbar-light bg-light navbar-expand-lg">
    <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" width="50" height="" class="d-inline-block align-top" alt="">
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

       