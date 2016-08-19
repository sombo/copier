<?
require_once('../models/service_calls.php');
require_once('../include/Controller.php');

// /**
// * 
// */
class service_calls_controller extends Controller
{
	
	public $obj ;
	public $brands;
	public $tools;
	
	function __construct($hasModel){
		// $this->Page_Title = "Welcome";

		// $this->obj = new service_calls();

		parent::__construct(false);

	}
	
	function create(){
		$this->lead = "Create new service_calls";
		$this->render("new");
	}

	function index(){
		$this->lead = "All service_calls";
		
		/* Get All Models Needed */
		$tools_Db = new Database("tools",null,true);
		$this->tools = $tools_Db->tableRecord;
		$tools_Db = null;


		$brands_Db = new Database("brands",null,true);
		$this->brands = $brands_Db->tableRecord;
		$brands_Db = null;

		
		// print_r($tools);
		  

		$this->render("index");
		
	}

	function show(){
		$this->obj =  new service_calls($this->d->Find_By($_GET["id"]));
		$this->render("show");
	}

	function edit(){
		$this->lead = "Edit service_calls";
		$this->obj =  new service_calls($this->d->Find_By($_GET["edit"]));
		$this->render("edit");
	}
	function delete(){
		$this->obj = new service_calls($this->d->Find_By($_POST["delete"]));
		if($this->obj->Delete())
			$this->ajax("ok");

		else
			 $this->ajax($_SESSION["errors"]);
	}
}

	$a = new service_calls_controller(true);
?>
