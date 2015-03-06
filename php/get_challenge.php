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
	
	
	if(isset($_REQUEST["ch"])){
	
		$index=(rand(0,9));
		$ds->current_challenge[0] = &$ds->challenges[$index];
		echo(json_encode($ds->challenges[$index]));
	
	}
	
	if(isset($_REQUEST["ch_new"])){
		$ds->players[0]->success -=5;
		$index=(rand(0,9));
		$ds->current_challenge[0] = &$ds->challenges[$index];
		echo(json_encode($ds->challenges[$index]));
	
	}
