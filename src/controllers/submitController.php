<?php
include_once("src/classes/db.php");

/**
 * Description of submitController
 *
 * @author herson
 */
class submitController {
    private $db;
    
    public function __construct() {
         $this->db = new Db();
    }

    /*
     * Returns an array with error messages. If empty, everything fine.
     */
    public function save_report_object($report) {
        $errors_array = array();
        
        $valid_location = $this->validate_location($report->get_location());
        if (gettype($valid_location) == "string") {
            array_push($errors_array, $valid_location);
        }
        
        $valid_institution = 
                $this->validate_institution($report->get_institution());
        if (gettype($valid_institution) == "string") {
            array_push($errors_array, $valid_institution);
        }
        
        $valid_event = $this->validate_event($report->get_event());
        if (gettype($valid_event) == "string") {
            array_push($errors_array, $valid_event);
        }
        
        $valid_description = 
                $this->validate_description($report->get_description());
        if (gettype($valid_description) == "string") {
            array_push($errors_array, $valid_description);
        }
        
        $valid_amount = $this->validate_amount($report->get_amount());
        if (gettype($valid_amount) == "string") {
            array_push($errors_array, $valid_amount);
        }
        
        if(count($errors_array) == 0) {
            $this->db->save_report($valid_location, $valid_institution, 
                    $report->get_event(), $this->sanitize($report->get_description()),
                    $report->get_amount());
        }
        
        return $errors_array;
    }
    
    private function sanitize($text) {
        $return_str = str_replace(array('<', '>', "'", '"', ')', '('), 
                array('&lt;', '&gt;', '&apos;', '&#x22;', '&#x29;', '&#x28;'), 
                $text, $counter);
        return $return_str;
    }
    
    /*
     * If it is fine, returns the id of the highest level location.
     * If it is wrong, returns a string explaining the error.
     */
    private function validate_location($location_string) {
        $max_location_level = $this->db->get_location_depth();
        $location_parts = explode(",", $location_string);
        
        if(count($location_parts) != $max_location_level) {
            return "The location is invalid.";
        }
        //Id(s) of locations... hopefully one
        $nth_level_locs_same_name = $this->db->
            get_location_by_level_name($max_location_level,
                                        $location_parts[0]);
        return $nth_level_locs_same_name;
        //TODO: 2+ cantons with the same name on different provinces.
    }
    
    /*
     * If it is fine, returns the id of the institution.
     * If it is wrong, returns a string explaining the error.
     */
    private function validate_institution($institution_string) {
        if($id = $this->db->is_institution_in_db($institution_string))
            return $id;
        return "The institution is invalid.";
    }
    
    /*
     * If it is fine, returns true.
     * If it is wrong, returns a string explaining the error.
     */
    private function validate_event($event_code) {
        if(gettype($event_code) == "integer") {
            //Range of events [1,2,3] for ["paid", "not paid", "honest officer"]
            if ($event_code >= 1 && $event_code <= 3) {
                return True;
            }
        }
        return "The event is invalid.";
    }
    
    /*
     * If it is fine, returns True.
     * If it is wrong, returns a string explaining the error.
     */
    private function validate_description($description) {
        $error_msg = "The description is invalid.";
        $counter = 0;

        $return_str = str_ireplace(array(' ', ' '), '', $description, $foo);
        $return_str = str_ireplace('script', '', $return_str, $counter);
        if ($counter > 0) {
            return $error_msg;
        }

        return True;
    }
    
    /*
     * If it is fine, returns true.
     * If it is wrong, returns a string explaining the error.
     */
    private function validate_amount($amount) {
        if (gettype($amount) == "integer" || gettype($amount) == "double") {
            return True;
        }
        return "The amount is invalid.";
    }
}

