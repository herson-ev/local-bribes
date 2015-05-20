<?php

/**
 * Description of db
 *
 * @author herson
 */
$database_name = "";
$database_server = "localhost";
$database_user = "";
$database_pass = "";

mysql_connect($database_server, $database_user, $database_pass);
mysql_select_db($database_name);

function get_levels() {
    $query = mysql_query("select max(level) from location");
    $levels = mysql_result($query, 0);
    return $levels;
}

function get_concatenated_city_names() {
    $levels = get_levels();
    $query = mysql_query("select * from location where level=$levels");
    $result = "";
    while ($row = mysql_fetch_array($query))
        $result = $result . get_all_names ($row[id], "");
    return $result;
}

function get_name($id) {
    $query = mysql_query("select * from location where id=$id");
    return mysql_fetch_array($query);
}

function get_all_names($id, $final_string) {
    $generic_place = get_name($id);
    if ($generic_place["parent"] == 0) {
        return "\"" . $final_string . $generic_place["name"] . "\", ";
    }
    else {
        $final_string = $final_string . $generic_place["name"] . ", ";
        return get_all_names($generic_place["parent"], $final_string);
    }
}
?>