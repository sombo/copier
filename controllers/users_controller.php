<?
require_once('../models/Users.php');
require_once('../include/Controller.php');

// /**
// * 
// */
class users_controller extends Controller
{
	
	public $obj ;
	
	function __construct($hasModel){
		$this->Page_Title = "Welcome";

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
		$this->render("show");
	}

	function edit(){
		$this->lead = "Edit Users";
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
}

	$a = new users_controller(true);
?>
