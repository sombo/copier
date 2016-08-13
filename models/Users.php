<?php

require_once('../include/Database.php');

class Users extends Database{

	public $Has_Many = array("pools");
	
	public $validates = array("address"=>"empty");

	function __construct($records = null){
		parent::__construct("users",$records,true);
		
		//$this->tableRecord = null;

		
	}

}




?>
