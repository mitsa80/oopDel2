<?php
//Nodebite black box
include_once("../nodebite-swiss-army-oop.php");
//create a new instance of the DBObjectSaver class 
//and store it in the $ds variable
	$ds = new DBObjectSaver(array(
	  "host" => "127.0.0.1",
	  "dbname" => "character_db",
	  "username" => "root",
	  "password" => "mysql",
	  "prefix" => "DBOB"
	));
	