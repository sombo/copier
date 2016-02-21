<?

require_once('../include/Database.php');

class Users extends Database{
	public $validates = array(
			"name"=>array("empty","min(2)"),
			"phone"=>array("empty","min(9)","max(10)")
			);
	function __construct($records = null){
		parent::__construct("users",$records,true);
		

		//$this->tableRecord = null;

		
	}

}




?>
