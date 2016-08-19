<?

require_once('../include/Database.php');

class Problems extends Database{

	function __construct($records = null){
		parent::__construct("problems",$records,true);
		
		//$this->tableRecord = null;

		
	}

}




?>
