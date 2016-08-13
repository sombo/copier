<div class="col-lg-6">
<table border=0 id=tblForm class='table table-hover'>
	<tbody>
		<form id = "new_<?php echo Inflect::singularize($this->model)?>" action="<?php echo $root_path.'controllers/'.$this->model.'_controller.php'?>" method="POST" enctype="multipart/form-data;charset=UTF-8">
			<input type=hidden id="<?php echo $action;?>" name="<?php echo $action;?>" />
			<?php
				foreach($widgets as $widget) { 
					
					if($widget->type === "select"){

			?>

					<tr>   
						<td>
							<label for=<?php echo $widget->name;?> >
								<?php echo $this->Translate($widget->name);?> :
							</label>
						</td>
						<td>
							<select id=<?php echo $widget->name;?>
									name=<?php echo $widget->name;?> 
									class="fields">

								<?php 	foreach ($widget->data as $id => $value) { 
											if($id!=0){ ?>
												<option value=<?php echo $id;?> >
													<?php echo $value;?>
												</option>
								<?php 	} 	} ?>  
							</select>
						</td>
					</tr>
			<?php
					}else{
			?>		
					
					<tr>  
						<td>
							<label for=<?php echo $widget->name;?> >
								<?php echo $this->Translate($widget->name);?> :
							</label>
						</td>

						<td>
							<input type=<?php echo $widget->type;?> name=<?php echo $widget->name;?> 
																	id=<?php echo $widget->name;?> 
																	class=fields 
																	value=<?php echo $this->obj->object_Records[$widget->name];?>
																	<?php echo $is_disabled;?>  ></input> 
						</td>
			<?php } ?>
					</tr>
			<?php } ?>
					
			

			<tr><!-- Buttons Panel -->
				
				<th colspan=2 class=form-actions>
					<div class=controls>
						<input type = submit value = שמור class=btn />  
						<input type = reset  value = אפס class=btn />
					</div>
				</th>
			</tr>
		</form>
	</tbody>
</table>
</div>