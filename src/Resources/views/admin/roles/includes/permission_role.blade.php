<div class="row">
	<div class="col-md-8 col-md-offset-4" id="permission_role">
		@foreach ($permissions as $permission)
			<div class="row">
				<div class="col-md-4">
					<input type="checkbox" class="custom-control-input main-checkbox" >
	  				<label class="custom-control-label" for="customCheck1">
	  					<h5><strong>{{$permission->display_name}}</strong></h5>
	  				</label>
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-2">
							<input type="hidden" name="crud[{{$permission->id}}][]" value="off">
				  			<input type="checkbox" class="custom-control-input" name="crud[{{$permission->id}}][]" id="customCheck1">
				  			<label class="custom-control-label" for="customCheck1">create</label>
						</div>

						<div class="col-md-2">
				  			<input type="hidden" name="crud[{{$permission->id}}][]" value="off">
				  			<input type="checkbox" class="custom-control-input" name="crud[{{$permission->id}}][]" id="customCheck1">
				  			<label class="custom-control-label" for="customCheck1">Read</label>
						</div>

						<div class="col-md-2">
							<input type="hidden" name="crud[{{$permission->id}}][]" value="off">
				  			<input type="checkbox" class="custom-control-input" name="crud[{{$permission->id}}][]" id="customCheck1">
				  			<label class="custom-control-label" for="customCheck1">Update</label>
						</div>

						<div class="col-md-2">
							<input type="hidden" name="crud[{{$permission->id}}][]" value="off">
				  			<input type="checkbox" class="custom-control-input" name="crud[{{$permission->id}}][]" id="customCheck1">
				  			<label class="custom-control-label" for="customCheck1">Delete</label>
						</div>
					</div>
					
				</div>
			</div>	
			<div class="clearfix"></div>
	@endforeach
	
	</div>
</div>