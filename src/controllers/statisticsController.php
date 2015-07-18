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
        return $this->db->get_top_institution_by_event(1, 10);
    }
    public function get_top_not_bribes_by_institution() {
        return $this->db->get_top_institution_by_event(2, 10);
    }
    public function get_top_honest_by_institution() {
        return $this->db->get_top_institution_by_event(3, 10);
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
