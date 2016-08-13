<div class="col-xs-6"></div>
<div class="col-xs-6">
<div id = "show_form_errors"></div>
	<h3>כלי חדש</h3>

	<? 
		$widgets = $this->Generate_Form("new");
		include("../views/shared/_form.php");
	?>
</div>
