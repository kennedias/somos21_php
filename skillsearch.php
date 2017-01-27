<?php

session_start();
include("includes/db_connector.php");
if(!$_SESSION["user"]){
  header("location:login.php");
  exit();
} else{
  $s_userid=$_SESSION["user"]["userid"];
}

//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    
    $sql = mysql_query("SELECT s_code, s_description FROM skills WHERE s_description LIKE '%{$query}%'");
	$array = array();
    while ($row = mysql_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['s_description'],
            'value' => $row['s_description'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}

?>