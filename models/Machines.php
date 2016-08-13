<?php

require_once('../include/Database.php');

class Machines extends Database{
	
	public $Has_One = array("brands"=>"brand");
		
	public $Belongs_To = array("users"=>"user_name");

		function __construct($records = null){
		parent::__construct("machines",$records,true);
		
		//$this->tableRecord = null;

		
	}

}




?>
