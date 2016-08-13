<div class="col-lg-6">
	
	<form id = "new_<?php echo Inflect::singularize($this->model);?>" action="<?php echo $root_path.'controllers/'.$this->model.'_controller.php'?>" method="POST" enctype="multipart/form-data;charset=UTF-8">
		<input type=hidden id="<?php echo $action;?>" name="<?php echo $action;?>" />
		<table border=0 id=tblForm class='table table-hover'>
			<tbody>
				<tr>
					<td><label for="<?php echo $label; ?>" ><?php echo $lab;?> :</label> </td>
					<td>
						<select id="<?php echo $label; ?>" name="<?php echo $label;?>" class=fields>
						<?php
							foreach ($this->forgien_keys_widget[$label] as $id => $value) {
								if($id == $this->obj->object_Records[$label])
						?>
									<option value="<?php $id; ?>" selected='selected' ><?php echo $value;?></option>
						<?php
								else
						?>			
									<option value="<?php $id; ?>" ><?php echo $value;?></option>

						<?php
							}
						?>
						</select>
					</td>
				</tr>
					

	</form>
</div>