<?

require_once('../include/Database.php');

class Tools extends Database{

	public $Has_One = array("brands"=>"brand","types"=>"type");

	function __construct($records = null){
		parent::__construct("tools",$records,true);
		
		//$this->tableRecord = null;

		
	}

}




?>
