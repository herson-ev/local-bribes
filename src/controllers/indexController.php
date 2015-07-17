<?php
include_once("src/classes/db.php");


/**
 * Description of indexController
 *
 * @author herson
 */
class indexController {
    private $db;
    
    public function __construct() {
         $this->db = new Db();
    }
    
    public function get_locations() {
        $full_locations_array = array();
        $levels = $this->db->get_location_depth();

        //This is an array of tuples from the database
        $locations_by_level = $this->db->get_locations_by_level($levels);

        foreach($locations_by_level as $location) {
            array_push($full_locations_array, 
                    $this->get_full_location_by_id($location["id"]));
        }

        return $full_locations_array;
    }
    
    public function get_full_location_by_id($id) {
        return $this->get_complete_name($id, "");
    }
    
    private function get_complete_name($id, $final_string) {
        $generic_place = $this->db->get_location_by_id($id);
        if ($generic_place["parent"] == 0) {
            return $final_string . $generic_place["name"];
        } else {
            $final_string = $final_string . $generic_place["name"] . ", ";
            return $this->get_complete_name($generic_place["parent"], 
                                            $final_string);
        }
    }

    /**
     *
     * @param type $id (integer) of the location we are looking for.
     * @return type (id, parent, name) location or null if not found.
     */
    public function get_location_by_id($id) {
        return $this->db->get_location_by_id($id);
    }
    
    
    
    
    /**
     * 
     * @return array of strings used to populate the autocomplete textfield
     * options.
     */
    public function get_institution_names() {
        return $this->db->get_institution_names();
    }
    
    public function get_latest_reports() {
        $number = 6;        // How many reports do I want to show in index.php?
        return $this->db->get_latest_reports($number);
    }
    
    /**
     *
     * @param type $id (integer) of the institution we are looking for.
     * @return type (string) institution name or null if not found.
     */
    public function get_institution_by_id($id) {
        return $this->db->get_institution_by_id($id);
    }
}
