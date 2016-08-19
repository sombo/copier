<?
require_once('../models/problems.php');
require_once('../include/Controller.php');

// /**
// * 
// */
class problems_controller extends Controller
{
	
	public $obj ;
	
	function __construct($hasModel){
		$this->Page_Title = "Welcome";

		$this->obj = new problems();

		parent::__construct($hasModel);

	}
	
	function create(){
		$this->lead = "Create new problems";
		$this->render("new");
	}

	function index(){
		$this->lead = "All problems";
		$this->render("index");
		
	}

	function show(){
		$this->obj =  new problems($this->d->Find_By($_GET["id"]));
		$this->render("show");
	}

	function edit(){
		$this->lead = "Edit problems";
		$this->obj =  new problems($this->d->Find_By($_GET["edit"]));
		$this->render("edit");
	}
	function delete(){
		$this->obj = new problems($this->d->Find_By($_POST["delete"]));
		if($this->obj->Delete())
			$this->ajax("ok");

		else
			 $this->ajax($_SESSION["errors"]);
	}
}

	$a = new problems_controller(true);
?>
