<?php
/* $Id$ */

@set_time_limit(10000);


require("grab_globals.inc.php3");

require("lib.inc.php3");


// set up default values
$sql_query     = isset($sql_query)    ? $sql_query    : "";
$sql_file      = isset($sql_file)     ? $sql_file     : "none";
 

if($sql_file != "none") {
  // do file upload
  if(ereg("^php[0-9A-Za-z_.-]+$", basename($sql_file))) {
    $sql_query = fread(fopen($sql_file, "r"), filesize($sql_file));
    if (get_magic_quotes_runtime() == 1) $sql_query = stripslashes($sql_query);
  }
}
else {
  if(get_magic_quotes_gpc() != 0 && get_magic_quotes_runtime() != 0) $sql_query = stripslashes($sql_query);
  if(get_magic_quotes_gpc() == 1 && get_magic_quotes_runtime() == 0) $sql_query = stripslashes($sql_query);
}

$sql_query = trim($sql_query);
$sql_query_cpy = $sql_query; // copy the query, used for display purposes only

if($sql_query != "") {
  $sql_query = remove_remarks($sql_query);
  $pieces    = split_sql_file($sql_query,";");

  if (count($pieces) == 1 && !empty($pieces[0]) && $view_bookmark == 0) {
    $sql_query = addslashes(trim($pieces[0]));
    if (eregi('^CREATE TABLE (.+)', $sql_query))  $reload = "true";
    include ("sql.php3");
    exit;
  }
 
  include("header.inc.php3");
  if(mysql_select_db($db)) {
    // run multiple queries
    for ($i=0; $i<count($pieces); $i++) {
      $sql = trim($pieces[$i]);
      if(!empty($sql) and $sql[0] != "#") $result = mysql_query($sql) or mysql_die2($sql);
      if (!isset($reload) && eregi('^CREATE TABLE (.+)', $pieces[$i])) $reload = "true";
    }
  }
}

// copy the original query back for display purposes
$sql_query = $sql_query_cpy;
$message = $strSuccess;
require("db_details.php3");
?>
