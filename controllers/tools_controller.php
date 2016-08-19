<?
require_once('../models/Tools.php');
require_once('../models/Brands.php');
require_once('../models/Types.php');
require_once('../include/Controller.php');

// /**
// * 
// */
class tools_controller extends Controller
{
	
	public $obj ;
	
	function __construct($hasModel){
		$this->Page_Title = "Welcome";

		$this->obj = new Tools();

		parent::__construct($hasModel);

	}
	
	function create(){
		$this->lead = "Create new Tools";
		$this->render("new");
	}

	function index(){
		$this->lead = "All Tools";
		$this->render("index");
		
	}

	function show(){
		$this->obj =  new Tools($this->d->Find_By($_GET["id"]));
		$this->render("show");
	}

	function edit(){
		$this->lead = "Edit Tools";
		$this->obj =  new Tools($this->d->Find_By($_GET["edit"]));
		$this->render("edit");
	}
	function delete(){
		$this->obj = new Tools($this->d->Find_By($_POST["delete"]));
		if($this->obj->Delete())
			$this->ajax("ok");

		else
			 $this->ajax($_SESSION["errors"]);
	}
}

	$a = new Tools_controller(true);
?>
