<?

require_once('../include/Database.php');

class Pools extends Database{

	public $Belongs_To = array("users"=>"user_name");
	public $Has_One = array("tools"=>"model");
	function __construct($records = null){
		parent::__construct("pools",$records,true);
		
		//$this->tableRecord = null;

		
	}

}




?>
