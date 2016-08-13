
<div class="form-group">
<form id = "new_<?php echo Inflect::singularize($this->model)?>" action="<?php echo '../controllers/'.$this->model.'_controller.php'?>" method="POST" enctype="multipart/form-data;charset=UTF-8">
<input type=hidden id="<?php echo $action;?>" name="<?php echo $action;?>" value="1" />
<table border=0 id=tblForm class='table table-hover'>
	<tbody>
		
			<?php
				foreach($widgets as $widget) { 
					
					if($widget->type === "select"){

			?>

					<tr>   
						<td>
							<label for="<?php echo $widget->name;?>" >
								<?php echo $this->Translate($widget->name);?> :
							</label>
						</td>
						<td class="input">
							<?php $temp = (isset($widget->forigen_key)) ? $widget->forigen_key : $widget->name;?>
							<select id="<?php echo $temp;?>" 
									name="<?php echo $temp;?>" 
									class="fields form-control">

								<?php 	foreach ($widget->data as $id => $value) { 
											if ($widget->name == "model")
												$value = $this->GetBrandForMachineModel($id,$value);
											if($id!=0){ 
												if($widget->selected_id == $id)
													echo "<option value=$id selected>$value</option>";
												else
													echo "<option value=$id>$value</option>";
													
											} 	
										} 
								?>  
							</select>
						</td>
					</tr>
			<?php
					}else{
			?>		
					
					<tr>  
						<td>
							<label for="<?php echo $widget->name;?>" >
								<?php echo $this->Translate($widget->name);?> :
							</label>
						</td>

						<td class="input">
							<input type="<?php echo $widget->type;?>" name="<?php echo $widget->name ;?>" 
																	id="<?php echo $widget->name ;?>" 
																	class="fields form-control" 
																	value="<?php echo $this->obj->object_Records[$widget->name] ; ?>"
																	"<?php echo $is_disabled;?>" ></input> 
						</td>
			<?php } ?>
					</tr>
			<?php } ?>
					
			

			<tr><!-- Buttons Panel -->
				
				<th colspan="2" class="form-actions">
					<div class="controls">
						<input type="button" id = "btn_save_form" value = "שמור" class="btn btn-default" /> 
						<button type = "reset"  value = "אפס" class="btn btn-default" >אפס</button>
					</div>
				</th>
			</tr>
		
	</tbody>
</table>
</form>
</div>