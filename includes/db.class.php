<?php 
// --  Data Layer
class db {

  var $db_host                     = 'localhost';
  var $db_name                     = 'barchart';
  var $db_user                     = 'barchart';
  var $db_pass                     = 'Barchart1';

  function __construct() {
    $this->dbConnect();
  }

  function dbConnect() {
    // Connect to the Database
    mysql_connect($this->db_host, $this->db_user, $this->db_pass);
    mysql_select_db($this->db_name);
    unset($this->db_pass);
    return true;
  }

  function dbQuery($query) {
    $queried = mysql_query($query);
    if(mysql_error()){
      echo mysql_error();
    }
    return $queried;
  }

}
?>