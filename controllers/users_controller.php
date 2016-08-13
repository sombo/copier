<?php
require_once('../models/Users.php');
require_once('../models/Tools.php');
require_once('../models/Types.php');
require_once('../models/Brands.php');
require_once('../models/Pools.php');
// require_once('../models/Machine_pool.php');
require_once('../include/Controller.php');

// /**
// * 
// */
class users_controller extends Controller
{
	
	public $obj ;
	public $pools;
	
	function __construct($hasModel){
		// $this->Page_Title = "Welcome";

		$this->obj = new Users();

		parent::__construct($hasModel);

	}
	
	function create(){
		$this->lead = "Create new Users";
		$this->render("new");
	}

	function index(){
		$this->lead = "All Users";
		$this->render("index");
		
	}

	function show(){
		$this->obj =  new Users($this->d->Find_By($_GET["id"]));
		if($this->obj->object_id != $_GET["id"])
			die("הלקוח אינו קיים");

		$this->Get_User_Pools();
		

		$this->render("show");
	}

	function edit(){
		$this->lead = "שינוי פרטי משתמש";
		$this->obj =  new Users($this->d->Find_By($_GET["edit"]));
		$this->render("edit");
	}
	function delete(){
		$this->obj = new Users($this->d->Find_By($_POST["delete"]));
		if($this->obj->Delete())
			$this->ajax("ok");

		else
			 $this->ajax($_SESSION["errors"]);
	}

	function Get_User_Pools(){
		$temp = new Pools();
		// die(print_r($temp));
		foreach ($temp->tableRecord as $primary_key => $values) {
			if ($values["user_id"] == $_GET["id"]){
				$this->pools[$primary_key] = $values;
			}
		}

		$Brands_Db = new Database("brands",null,true);
		$Tools_Db = new Database("tools",null,true);
		$Type_Db = new Database("types",null,true);
		foreach ($this->pools as $ind => $machine) {
			$tool = new Tools($Tools_Db->Find_By($machine['tool_id']));
			$this->pools[$ind]['model'] = $tool->object_Records['model'];

			$brand = new Brands($Brands_Db->Find_By($tool->object_Records['brand_id']));
			$this->pools[$ind]['brand'] = $brand->object_Records['brand'];

			$type = new Types($Type_Db->Find_By($tool->object_Records['type_id']));
			$this->pools[$ind]['type'] = $type->object_Records['type'];

		}


	}
}

	$a = new users_controller(true);
?>
