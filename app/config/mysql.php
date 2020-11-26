<?php
//var_dump($_SERVER["SERVER_NAME"]);
if ($_SERVER["SERVER_NAME"] == "localhost") {
    /**
   * Base de datos local
   * **/
  $mysqlHost = "localhost";
  $mysqlBase = "file_manager";
  $mysqlUser = "root";
  $mysqlPass = '';
} else {
  /**
   * Base de datos de producción
   * **/
  $mysqlHost = "";
  $mysqlBase = "";
  $mysqlUser = "";
  $mysqlPass = "";
 
}
define("MYSQLHOST", $mysqlHost);
define("MYSQLBASE", $mysqlBase);
define("MYSQLUSER", $mysqlUser);
define("MYSQLPASS", $mysqlPass);
