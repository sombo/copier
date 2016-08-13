<div class="col-xs-6"></div>
<div class="col-xs-6">
<div id = "show_form_errors"></div>
	<h3><u>עדכון פרטי לקוח : </u></h3><br/>
	<!-- <hr> -->

	<?php
		$widgets = $this->Generate_Form("edit");
		include("../views/shared/_form.php");
	?>
</div>
