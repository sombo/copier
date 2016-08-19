<?

require_once('../include/Database.php');

class Service_calls extends Database{

	function __construct($records = null){
		parent::__construct("service_calls",$records,true);
		
		//$this->tableRecord = null;

		
	}

}




?>
