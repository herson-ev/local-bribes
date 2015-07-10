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
     * @param type $id (integer) of the institution we are looking for.
     * @return type (string) institution name or null if not found.
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

    public function get_locations_by_level($level) {
        $result_array = array();
        $query_txt = "SELECT id, parent, name FROM location WHERE level=?";
        
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

    public function save_report($id_loc, $id_ins, $ev_code, $detail, $amount) {
        $query_txt = "INSERT INTO report (location, institution, event,"
                . " detail, amount) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->mysqli->stmt_init();
        if ($stmt->prepare($query_txt)) {
            $stmt->bind_param("iiisd", $id_loc, $id_ins, $ev_code, $detail, 
                    $amount);
            $stmt->execute();
            $stmt->close();
        }
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
}
