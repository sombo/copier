<?
require_once('../models/Pools.php');
require_once('../models/Tools.php');
require_once('../models/Brands.php');
require_once('../models/Users.php');
require_once('../include/Controller.php');

// /**
// * 
// */
class pools_controller extends Controller
{
	
	public $obj ;
	
	function __construct($hasModel){
		$this->Page_Title = "Welcome";

		$this->obj = new Pools();

		parent::__construct($hasModel);

	}
	
	function create(){
		$this->lead = "Create new machine_poll";
		$this->render("new");
	}

	function index(){
		$this->lead = "All machine_poll";
		$this->render("index");
		
	}

	function show(){
		$this->obj =  new Pools($this->d->Find_By($_GET["id"]));
		$this->render("show");
	}

	function edit(){
		$this->lead = "Edit machine_poll";
		$this->obj =  new Pools($this->d->Find_By($_GET["edit"]));
		$this->render("edit");
	}
	function delete(){
		$this->obj = new Pools($this->d->Find_By($_POST["delete"]));
		if($this->obj->Delete())
			$this->ajax("ok");

		else
			 $this->ajax($_SESSION["errors"]);
	}


	function GetBrandForMachineModel($tool_id,$machine_model){
		$Tools_Db = new Database("tools",null,true);
		$tool = new Tools($Tools_Db->Find_By($tool_id));
		$Tools_Db = null;

		$brand_id = $tool->object_Records["brand_id"];
		
		$Brands_Db = new Database("brands",null,true);
		$brand = new Brands($Brands_Db->Find_By($brand_id));
		$Brands_Db = null;

		$brand_name = $brand->object_Records["brand"];
		
		$tool =null;
		$brand = null;
		// die(print_r($tool->object_Records));
		return $brand_name."_".$machine_model;
	}
}

	$a = new Pools_controller(true);
?>
