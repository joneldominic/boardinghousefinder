<?php
    include_once('includes/header.php');
    // if wala pay user
    // include_once('includes/navbar/navbar(nouser).php');
    // else pag naa nay user
    include_once('includes/navbar/navbar(withuser).php');
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
                    <img src="images/sample-unit.jpeg" alt="Los Angeles">
                    <div class="carousel-caption">
                        <p>Front View</p>
                    </div>   
                </div>
                <div class="carousel-item text-center">
                    <img src="images/sample-unit.jpeg" alt="Chicago">
                    <div class="carousel-caption">
                        <p>Kitchen</p>
                    </div>   
                </div>
                <div class="carousel-item text-center">
                    <img src="images/sample-unit.jpeg" alt="New York">
                    <div class="carousel-caption">
                        <p>Confort Room</p>
                    </div>   
                </div>
            </div>

            <a class="carousel-control-prev" href="#bhouse" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#bhouse" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <hr />

        <h3 class="text-center">Tapang's Boardinghouse</h3>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <img class="img-circle img-responsive owner-profile" src="images/temp-profile.jpeg" alt="Owner's Profile">
                <ul class="owner-det">
                    <li><span class="fa fa-user"></span> Jonel Dominic Tapang</li>
                    <li><span class="fa fa-location-arrow"></span> Brgy. Pangasugan, Baybay City, Leyte </li>
                    <li><span class="fa fa-mobile"></span> 09087863725</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="bhouse-det">
                    <li>Accomodation: Bedspacer</li>
                    <li>Gender: Male</li>
                    <li>Monthly Rate: &#8369; 500.00</li>
                    <li>Status: Available</li>
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
                    <li>Details: Free water, Free electricity...</li>
                </ul>
            </div>
        </div>

        <hr />
        
        <div class="row my-pager">
            <div class="col">
                <span class="float-left ">
                    <a href="#">❮ Previous House</a>
                </span>
            </div>
            <div class="col">
                <span class="float-right">
                    <a href="#">Next House ❯</a>
                </span>
            </div>
        </div>

       
    </div>

<?php 
    include 'includes/footer.php'; 
?>
