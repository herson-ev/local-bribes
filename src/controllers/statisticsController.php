<?php
include_once("src/classes/db.php");

/**
 * Description of submitController
 *
 * @author herson
 */
class statisticsController {
    private $db;
    
    public function __construct() {
         $this->db = new Db();
    }
    
    public function get_total_reports() {
        return $this->db->get_total_reports();
    }
    
    public function get_total_cities() {
        return $this->db->get_total_cities();
    }
    
    public function get_total_institutions() {
        return $this->db->get_total_institutions();
    }
    
    public function get_total_amount() {
        return $this->db->get_total_amount();
    }
    
    public function get_total_bribes() {
        return $this->db->get_total_bribes();
    }
    
    public function get_total_not_bribes() {
        return $this->db->get_total_not_bribes();
    }
    
    public function get_total_honest() {
        return $this->db->get_total_honest();
    }
    
    public function get_top_bribes_by_institution() {
        return $this->db->get_top_institutions_by_event(1, 10);
    }
    public function get_top_not_bribes_by_institution() {
        return $this->db->get_top_institutions_by_event(2, 10);
    }
    public function get_top_honest_by_institution() {
        return $this->db->get_top_institutions_by_event(3, 10);
    }
    
    public function get_top_bribes_by_location() {
        return $this->db->get_top_locations_by_event(1, 10);
    }
    public function get_top_not_bribes_by_location() {
        return $this->db->get_top_locations_by_event(2, 10);
    }
    public function get_top_honest_by_location() {
        return $this->db->get_top_locations_by_event(3, 10);
    }
    
    /**
     *
     * @param type $id (integer) of the institution we are looking for.
     * @return type (string) institution name or null if not found.
     */
    public function get_institution_by_id($id) {
        return $this->db->get_institution_by_id($id);
    }
    
    /**
     *
     * @param type $id (integer) of the location we are looking for.
     * @return type (id, parent, name) location or null if not found.
     */
    public function get_location_by_id($id) {
        return $this->db->get_location_by_id($id);
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
    
}
