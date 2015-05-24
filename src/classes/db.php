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

    public function __construct() {
        mysql_connect($this->database_server, $this->database_user, $this->database_pass);
        mysql_select_db($this->database_name);
    }
    
    public function __destruct() {
        mysql_close();
    }

    private function get_levels() {
        $query = mysql_query("select max(level) from location");
        $levels = mysql_result($query, 0);
        return $levels;
    }

    private function get_name($id) {
        $query = mysql_query("select * from location where id=$id");
        return mysql_fetch_array($query);
    }

    private function get_all_names($id, $final_string) {
        $generic_place = $this->get_name($id);
        if ($generic_place["parent"] == 0) {
            return "\"" . $final_string . $generic_place["name"] . "\", ";
        } else {
            $final_string = $final_string . $generic_place["name"] . ", ";
            return $this->get_all_names($generic_place["parent"], $final_string);
        }
    }

    public function get_concatenated_city_names() {
        $levels = $this->get_levels();
        $query = mysql_query("select * from location where level=$levels");
        $result = "";
        while ($row = mysql_fetch_array($query))
            $result = $result . $this->get_all_names($row["id"], "");
        return $result;
    }
    
    public function get_concatenated_institution_names() {
        $query = mysql_query("select name from institution");
        $result = "";
        while ($row = mysql_fetch_array($query))
            $result = $result . "\"" . $row["name"] . "\", ";
        return $result;
    }
}

?>