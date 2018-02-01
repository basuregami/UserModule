<div class="row">
	<div class="col-md-8 col-md-offset-4" id="permission_role_update">
		@php
			$checked = 'checked';
			$operationName = [
				0 => "create",
				1 => "Read",
				2 => "Update",
				3 => "Delete",
			];
		@endphp
		
        @foreach ($operationPermissions as $operationPermission)
        	<div class="row">

        		<div class="col-md-4">
					<input type="checkbox" class="custom-control-input main-checkbox" id="customCheck1">
	  				<label class="custom-control-label" for="customCheck1">
	  					<h5><strong>{{$operationPermission->Permission->display_name}}</strong></h5>
	  				</label>
				</div>

				<div class="col-md-8">
					<div class="row">

					<?php 
						$operation = explode(",", $operationPermission->operation);
						
						foreach ($operation as $key => $value) {
							if ($value == "on") {
								$checked = 'checked';
							}else{
								$checked = "";
							}
					
				  			echo '
				  				<div class="col-md-2">
				  					<input type="hidden" name="crud['.$operationPermission->permission_id.'][]" value="off">
			  						<input type="checkbox" class="custom-control-input" name="crud['.$operationPermission->permission_id.'][]" id="customCheck1" '.$checked.'>
			  						<label class="custom-control-label" for="customCheck1">'.$operationName[$key].'</label>
				  				</div>
				  			';
				  		}
				  	?>
					</div>
				</div>

        	</div>	
		@endforeach

	
	</div>
</div>