<?php

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

    public function __destruct() {
        mysql_close();
    }

    private function get_levels() {
        $query_txt = "select max(level) as max from location";
        if (!$result = $this->mysqli->query($query_txt)) {
            die("There was an error retrieving city levels.");
        }
        
        $row = $result->fetch_row();
        return $row[0];
    }

    private function get_name($id) {
        $query_txt = "select * from location where id=$id";
        if (!$result = $this->mysqli->query($query_txt)) {
            die("There was an error retrieving a city row.");
        }
        
        $row = $result->fetch_assoc();
        return $row;
    }

    private function get_all_names($id, $final_string) {
        $generic_place = $this->get_name($id);
        if ($generic_place["parent"] == 0) {
            return $final_string . $generic_place["name"];
        } else {
            $final_string = $final_string . $generic_place["name"] . ", ";
            return $this->get_all_names($generic_place["parent"], 
                                            $final_string);
        }
    }

    public function get_city_names() {
        $result_array = array();
        $levels = $this->get_levels();
        $query_txt = "select * from location where level=$levels";
        if (!$result = $this->mysqli->query($query_txt)) {
            die("There was an error retrieving cities.");
        }
        
        while ($row = $result->fetch_assoc())
            array_push($result_array, $this->get_all_names($row["id"], ""));
        return $result_array;
    }

    public function get_institution_names() {
        $result_array = array();
        $query_txt = "select name from institution";
        if (!$result = $this->mysqli->query($query_txt)) {
            die("There was an error retrieving institutions.");
        }
        
        while ($row = $result->fetch_assoc())
            array_push($result_array, $row["name"]);
        return $result_array;
    }

    public function save_report() {
        $stmt = "INSERT INTO report(location, institution, event, detail, amount) VALUES(?, ?, ?, ?, ? ?)";
    }

}

?>