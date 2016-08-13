<?php
require_once('../models/Machines.php');
require_once('../models/Users.php');
require_once('../models/Brands.php');

require_once('../include/Controller.php');

// /**
// * 
// */
class machines_controller extends Controller
{
	
	public $obj ;
	
	function __construct($hasModel){
		$this->Page_Title = "Welcome";

		$this->obj = new Machines();

		parent::__construct($hasModel);

	}
	
	function create(){
		$this->lead = "Create new machines";
		//$widgets = $this->Generate_Form("new");
		$this->render("new");// לשלוח מערך עם פרמטרים
	}

	function index(){
		$this->lead = "All machines";
		$this->render("index");
		
	}

	function show(){
		$this->obj =  new machines($this->d->Find_By($_GET["id"]));
		$this->render("show");
	}

	function edit(){
		$this->lead = "Edit machines";
		$this->obj =  new Machines($this->d->Find_By($_GET["edit"]));
		$this->obj->object_Records = $this->obj->tableRecord[$_GET["edit"]];
		$this->render("edit");
	}
	function delete(){
		$this->obj = new machines($this->d->Find_By($_POST["delete"]));
		if($this->obj->Delete())
			$this->ajax("ok");

		else
			 $this->ajax($_SESSION["errors"]);
	}
}

	$a = new machines_controller(true);
?>
