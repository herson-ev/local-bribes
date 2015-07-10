<?php
include_once("report.php");

/**
 * Description of db
 *
 * @author herson
 */
class Db {
    private $database_name = "";
    private $database_server = "";
    private $database_user = "";
    private $database_pass = "";
    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli($this->database_server, $this->database_user,
                $this->database_pass, $this->database_name);
        if (mysqli_connect_errno()) {
            echo "DB Connection Failed: " . mysqli_connect_errno();
            exit();
        }
        /* change character set to utf8 */
        if (!$this->mysqli->set_charset("utf8")) {
            printf("Error loading character set utf8: %s\n", $mysqli->error);
            die("DB charset error.");
        }
    }


    /**
     * 
     * @return type (integer) max level is how "deep" locations are stored in
     * the DB. For example: district, canton, province is a level 3 location.
     */
    public function get_location_depth() {
        $query_txt = "SELECT max(level) FROM location";
        if (!$result = $this->mysqli->query($query_txt)) {
            die("There was an error retrieving city levels.");
        }
        
        $row = $result->fetch_row();
        return $row[0];
    }

    /**
     *
     * @param type $id (integer) of the location we are looking for.
     * @return type (string) location name or null if not found.
     */
    public function get_location_by_id($id) {
        $query_txt = "SELECT id, parent, name FROM location WHERE id = ?";
        
        $stmt = $this->mysqli->stmt_init();
        if ($stmt->prepare($query_txt)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();            
            $stmt->bind_result($id, $parent, $name);
            $stmt->fetch();            
            $stmt->close();
            
            return array("id" => $id, "parent" => $parent, "name" => $name);
        }
    }

    /**
     * 
     * @param type $level (int) of hierarchy from which we want all locations.
     * @return array of arrays containing id, parent and name of each tuple.
     */
    public function get_locations_by_level($level) {
        $result_array = array();
        $query_txt = "SELECT id, parent, name FROM location WHERE level = ?";
        
        $stmt = $this->mysqli->stmt_init();
        if ($stmt->prepare($query_txt)) {
            $stmt->bind_param("i", $level);
            $stmt->execute();
            
            $stmt->bind_result($id, $parent, $name);
            while($stmt->fetch()) {
                array_push($result_array, array("id" => $id,
                    "parent" => $parent, "name" => $name));
            }
             
            $stmt->close();
        }
        return $result_array;
    }
        
    /*
     * Returns an array of location ids fulfilling the requirements.
     */
    public function get_location_by_level_name($level, $name) {
        $result_array = array();
        $query_txt = "SELECT id FROM location WHERE level = ? AND name = ?";
        
        $stmt = $this->mysqli->stmt_init();
        if ($stmt->prepare($query_txt)) {
            $stmt->bind_param("is", $level, $name);
            $stmt->execute();
            
            $stmt->bind_result($result);
            while($stmt->fetch()) {
                array_push($result_array, $result);
            }

            $stmt->close();            
            return $result;
        }
        return $result_array;
    }

    /**
     * Used to populate the "autocomplete" text-field in index.php
     * @return array (os strings) with all the institution names available.
     */
    public function get_institution_names() {
        $result_array = array();
        $query_txt = "SELECT name FROM institution";
        if (!$result = $this->mysqli->query($query_txt)) {
            die("There was an error retrieving institutions.");
        }
        
        while ($row = $result->fetch_assoc())
            array_push($result_array, $row["name"]);
        return $result_array;
    }    
    
    /**
     * Precondition: Institution names are unique.
     * @param type $name (string) of the institution we are looking for.
     * @return type (integer) is the ID of the institution or null if not found.
     */
    public function is_institution_in_db($name) {
        $query_txt = "SELECT id FROM institution WHERE name = ?";
        
        $stmt = $this->mysqli->stmt_init();
        if ($stmt->prepare($query_txt)) {
            $stmt->bind_param("s", $name);
            $stmt->execute();
            
            $stmt->bind_result($result);
            $stmt->fetch();            
            $stmt->close();
            
            return $result;
        }
    }
    
    /**
     *
     * @param type $id (integer) of the institution we are looking for.
     * @return type (string) institution name or null if not found.
     */
    public function get_institution_by_id($id) {
        $query_txt = "SELECT name FROM institution WHERE id = ?";
        
        $stmt = $this->mysqli->stmt_init();
        if ($stmt->prepare($query_txt)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();            
            $stmt->bind_result($name);
            $stmt->fetch();            
            $stmt->close();
            
            return $name;
        }
    }

    /**
     * Usend in index.php to load the latest reports.
     * @param type $number (int) means how many (from latest to oldest) reports.
     */
    public function get_latest_reports($number) {
        $result_array = array();
        $query_txt = "SELECT location, institution, event, detail, amount, date"
                . " FROM report ORDER BY date DESC LIMIT ?";
        
        $stmt = $this->mysqli->stmt_init();
        if ($stmt->prepare($query_txt)) {
            $stmt->bind_param("i", $number);
            $stmt->execute();
            
            $stmt->bind_result($loc, $inst, $ev, $desc, $amount, $date);
            while($stmt->fetch()) {
                array_push($result_array, 
                        array("location" => $loc, "institution" => $inst,
                            "event" => $ev, "description" => $desc,
                            "amount" => $amount, "date" => $date));
            }

            $stmt->close();
        }
        return $result_array;
    }    

    /**
     * TODO: set limits to the description (words? characters?)
     * @param type $id_loc (int) location id
     * @param type $id_ins (int) institution id
     * @param type $ev_code (int) event code (1:paid, 2:not_paid, 3:honest)
     * @param type $detail (string) a brief description of the events.
     * @param type $amount
     */
    public function save_report($id_loc, $id_ins, $ev_code, $detail, $amount) {
        $query_txt = "INSERT INTO report (location, institution, event,"
                . " detail, amount) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->mysqli->stmt_init();
        if ($stmt->prepare($query_txt)) {
            $stmt->bind_param("iiisd", $id_loc, $id_ins, $ev_code, $detail, 
                    $amount);
            if(!$stmt->execute()) {
                echo "The report was not stored successfully.";
            }
            $stmt->close();
        }
    }
}
