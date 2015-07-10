<?php 

/**
 * This class models a bribe report.
 *
 * @author herson
 */
class Report {
    private $location;
    private $institution;
    private $event;
    private $description;
    private $amount;
    
    public function __construct($loc, $inst, $ev, $desc, $amount) {
        $this->location = $loc;
        $this->institution = $inst;
        $this->event = (int)$ev;
        $this->description = $desc;
        $this->amount = (float)$amount;
    }
    
    public function get_location() {
        return $this->location;
    }
    
    public function get_institution() {
        return $this->institution;
    }
    
    public function get_event() {
        return $this->event;
    }
    
    public function get_description() {
        return $this->description;
    }
    
    public function get_amount() {
        return $this->amount;
    }
}
