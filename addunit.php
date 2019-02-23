<?php
    include_once('includes/header.php');
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
                    <a class="nav-link" href="ownedunit.php"><span class="fa fa-user"></span> Jonel Dominic Tapang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><span class="fa fa-sign-out-alt"></span> Sign-out</a>
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
                        
                        <form action="#" name="registration">
                            <div class="form-group">
                                <label for="unitname">Unit Name</label>
                                <input type="text"  name="unitname" class="form-control" id="unitname" placeholder="Enter Unit Name">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text"  name="location" class="form-control" id="location" placeholder="Enter Unit Location">
                            </div>
                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" id="capacity"  class="form-control" min="1" max="100" value="1">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" class="form-control" >
                                        <option selected>Male</option>
                                        <option>Female</option>
                                        <option>Male/Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="accomodation">Accomodation</label>
                                <select id="accomodation" class="form-control" >
                                        <option selected>Bed Spacer</option>
                                        <option>Room</option>
                                        <option>Apartment</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="monthlyrate">Rate (Monthly)</label>
                                <input type="number" name="monthlyrate" class="form-control" id="monthlyrate" min="0.01" step="0.01" value="500.00">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="description" id="description" rows="5"  placeholder="Enter Unit Description/Features" cols="40" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image(s):</label>
                                <input type="file" name="image" class="image" id="image">
                              
                            </div>



                            <div class="col-md-12 text-center mb-3">
                                <button type="submit" class=" btn btn-block btn-primary tx-tfm" id="btnAddUnit">Save Unit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>   



<?php
    include_once('includes/footer.php');
?>