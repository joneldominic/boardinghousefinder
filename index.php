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
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Male/Female</option>
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
                    
                            <div class="col-md-2 text-center">
                                <button type="button" class="btn btn-dark">
                                    <span class="fas fa-search h6"></span>    
                                    Search House
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- List of units -->
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
                        <p class="card-text text-right">
                            <a href="boardinghouse.php">
                                <span class="fa fa-eye"></span>
                                View Details
                            </a>
                        </p>
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
                        <p class="card-text text-right">
                            <a href="boardinghouse.php">
                                <span class="fa fa-eye"></span>
                                View Details
                            </a>
                        </p>
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
                        <p class="card-text text-right">
                            <a href="boardinghouse.php">
                                <span class="fa fa-eye"></span>
                                View Details
                            </a>
                        </p>
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
                        <p class="card-text text-right">
                            <a href="boardinghouse.php">
                                <span class="fa fa-eye"></span>
                                View Details
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    
    
    </div>


<?php 
    include 'includes/footer.php'; 
?>
