<?php

define('ROOT','/~kfircohen/MyFrame');
	/**
	*
	*/
class ActiveRoutes {

	public $root ;
	public $resources = array();
	public $uri ;
	public $matches = array();

	function __construct(){
		session_start();
		$this->uri =  explode("/",$_SERVER['REQUEST_URI']);
		
		//$this->root ;
		require_once '../routes.php';
		$_POST['site_name'] = $this->project_Name;

		$this->Genrate_Route();

	}

	public function Genrate_Route(){
		// die(print_r($this->matches));
		$_POST["resources"] = $this->resources;
		$_POST["matches"] = $this->matches;
		$_POST["root"] = $this->root;
		
	/* A Method that parse the URI and find out the controllerr and Method needed.
		uri[3] holds the model name ,
		uri[4] holds the object ID ,
		and uri[5] holds REST Method */

		if(isset($this->resources[$this->uri[3]])){ 
			
			if($_SERVER['REQUEST_METHOD']=="GET"  ) {
				
				if ($this->uri[4]== 'new')
					$_GET["new"] = true ;
				else{
					$_GET[$this->uri[5]] = $this->uri[4]; 
					if(is_numeric($this->uri[4]) && $this->uri[4] != '')
						$_GET["id"] = $this->uri[4];
					elseif($this->uri[4]!='')
						$_POST["action"] = $this->uri[5];
				}
				if($_GET["errors"] != null)
					$_GET["id"] = null;
				
				require_once ("../controllers/".$this->uri[3]."_controller.php");
			}

			 else if($_SERVER['REQUEST_METHOD']=="POST"  ) {
			 	// die("POST");
			 	// print_r($this->uri);
			 	$_POST["delete"] = $this->uri[4];
			 }
		}
		else if(isset($this->matches[$this->uri[3]])) {
			$arr =  explode("/", $this->matches[$this->uri[3]]);
			die(print_r($arr)." Need Fixing ActiveRoutes.php line 58");
			if($arr[1]!="id" || $arr[1] != "edit"){
				if(is_numeric($arr[1]))
					$_GET["id"] = $arr[1];
				else
					$_GET[$arr[1]] = true;

			}
			else
				$_POST["action"] = $arr[1];

			require_once ("../controllers/".$arr[0]."_controller.php");
		}
		else{  // go to root //
			echo "OOpppsss !!! :( Page Not Found (Maybe u forget to include it in routes.php)!<br/>".$this->matches[2];
		}
	}
	
	public function Resources($resource, $show_in_nav = true) {
			$this->resources[$resource] = $show_in_nav;
	}
	public function Root($path){
		$this->root = $path;
		$_SESSION["root"] = $this->root;
	}
	public function Match($url,$path){
		$this->matches[$url] = $path;
	}

}

	$r = new ActiveRoutes();
?>