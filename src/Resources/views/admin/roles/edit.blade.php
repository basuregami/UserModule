@extends('backend.layouts.master')
@section('content')
    <div class="border-bottom white-bg dashboard-header">
        <div class="row">
            <div class="col-lg-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal ng-pristine ng-valid" method="POST" action="{{ route('roles.update')}}">
                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{ Crypt::encrypt($role->id) }}">
                    <input type="hidden" name="name" value="{{$role->name}}">

                    <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                        <label for="display_name" class="col-md-4 control-label">Display Name</label>

                        <div class="col-md-6">
                            <input id="display_name" type="text" class="form-control" name="display_name" value="{{ $role->display_name }}">

                            @if ($errors->has('display_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">Description</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" value="{{ $role->description }}" required autofocus>

                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
    
                    @include('usermodule::admin.roles.includes.permission_role_edit')

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update Role
                            </button>
                        </div>
                    </div>

                </form>

            

            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    <script type="text/javascript">

        console.log($('#permission_role_update input:checkbox:checked'));
        var checkedCheckboxes = $('#permission_role_update input:checkbox:checked');
        checkedCheckboxes.each(function(key,checkedCheckbox){
            var checkedCheckbox = $(checkedCheckbox);
            var mainCheckboxOfThisCheckedboxGroup =  checkedCheckbox.parent().parent().parent().siblings().children("input[type='checkbox']")
            mainCheckboxOfThisCheckedboxGroup.prop('checked', true);
            checkedCheckbox.prev().prop('disabled', true);
        });

        $('#permission_role_update input:checkbox').change(
        function(){
            if ($(this).is(':checked')) {
                var mainCheckbox = $(this).parent().parent().parent().siblings().children("input[type='checkbox']");
                mainCheckbox.prop('checked', true);
               // alert('checked');
               $(this).prev().prop('disabled', true);
                console.log($(this).val());

            }else{
                var mainCheckbox = $(this).parent().parent().parent().siblings().children("input[type='checkbox']");
               $(this).prev().prop('disabled', false);
                console.log($(this).val());

                var inputs = $(this).parent().siblings().children("input[type='checkbox']");

                console.log(inputs);
            inputs.each(function(key,value){
            if ($(value).is(':checked')) {

                mainCheckbox.prop('checked', true);
                return false;
            }else{

                mainCheckbox.prop('checked', false);

            }

            });
        }
                //$(this).value = 0;
        });

       $(".main-checkbox").on("click", function(){

            var inputs = $(this).parent().siblings().children().children().children("input[type='checkbox']");
            //console.log(inputs);
            if ($(this).is(':checked')) {
            inputs.each(function(key,value){

                $(value).prop('checked', true);
                $(value).prev().prop('disabled', true);
            });
        }else{
            inputs.each(function(key,value){

                $(value).prop('checked', false);
                $(value).prev().prop('disabled', false);
            });
        }

       });
    </script>
@endsection