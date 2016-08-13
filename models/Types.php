<?

require_once('../include/Database.php');

class Types extends Database{

	function __construct($records = null){
		parent::__construct("types",$records,true);
		
		//$this->tableRecord = null;

		
	}

}




?>
