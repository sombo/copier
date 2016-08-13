<?php

require_once('../include/Database.php');

class Brands extends Database{
	
	// public $Has_One = array("props"=>"brand");
		
	// public $Belongs_To = array("users"=>"user_name");

		function __construct($records = null){
		parent::__construct("brands",$records,true);
		
		//$this->tableRecord = null;

		
	}

}




?>
