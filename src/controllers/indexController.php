<?php
include_once("classes/db.php");


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
            array_push($full_locations_array, $this->get_all_names($location["id"], ""));
        }

        return $full_locations_array;
    }
    
    private function get_all_names($id, $final_string) {
        $generic_place = $this->db->get_location_by_id($id);
        if ($generic_place["parent"] == 0) {
            return $final_string . $generic_place["name"];
        } else {
            $final_string = $final_string . $generic_place["name"] . ", ";
            return $this->get_all_names($generic_place["parent"], 
                                            $final_string);
        }
    }
    
    public function get_institution_names() {
        return $this->db->get_institution_names();
    }
}
