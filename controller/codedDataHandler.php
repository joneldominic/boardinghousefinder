<?php 

class codedDataHandler {

    public function __construct()
    {
        // Constructor
    }

    public function getGender($i) {
        $arrGender = array('Male', 'Female', 'Male/Female');
        return $arrGender[$i];
    }

    public function getAccomodation($i) {
        $arrAcc = array('Bedspacer', 'Room', 'Apartment');
        return $arrAcc[$i];
    }

    public function getStatus($i) {
        $arrStatus = array('Unavailable', 'Available');
        return $arrStatus[$i];
    }

}
    

?>