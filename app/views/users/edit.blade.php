@extends('layouts.main')

@section('head')
   @parent
   {{ HTML::style('css/datatables/dataTables.bootstrap.css'); }}
@stop

@section('content-header')
Users
@stop

@section('content')

    <section class="content invoice">

        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">Update a User</h2>
            </div><!-- /.col -->
        </div>

        @if(Session::has('flash_error'))
        <div class="row">
            <div class="col-xs-12">
                <div class="callout callout-danger">
                    <h4>Error!</h4> <br/>                    
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
        </div>
        @endif

        {{ Form::open(array('url'=> 'appusers/'.$user->id,'method'=>'post')) }}
        
            <input type="hidden" name="_method" value="PATCH" />
            
        <div class="row">
            <div class="span6">
                <div class="box box-primary">
                    <div class="box-body">
                        <fieldset>
                            <legend>Login info </legend>
                            
                            <div class="form-group">
                                {{ Form::label('username','Username') }}
                                {{ Form::text('username',$user->username,array('class'=>'form-control','placeholder'=>'Enter username')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('password','Password') }}
                                <input name="password" type="password" value="{{{ $user->password }}}" class="form-control" id="password">
                            </div>
                                        
                            <div class="form-group">
                                {{ Form::label('confirmpassword','Confirm Password') }}
                                <input name="confirmpassword" type="password" value="{{{ $user->password }}}" class="form-control" id="confirmpassword">
                            </div>
                        </fieldset>
                   </div>
                </div>            
            </div>

            <div class="span5">
                <div class="box box-primary">
                    <div class="box-body">
                        <fieldset><legend>Personal info </legend>
                                        
                            <div class="form-group">
                                {{ Form::label('first_name','First Name') }}                        
                                {{ Form::text('first_name',$user->first_name,array('class'=>'form-control','placeholder'=>'Enter first name')) }}
                            </div>
                                    
                            <div class="form-group">
                                {{ Form::label('last_name','Last Name') }}
                                {{ Form::text('last_name',$user->last_name,array('class'=>'form-control','placeholder'=>'Enter last name')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('role','Role') }}
                                {{ Form::select('role', $roles, $user->role,array('class'=>'form-control','placeholder'=>'Enter role')) }}
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-6">
                <div class="box-footer">
                    {{ Form::submit('Update User',array('class'=>'btn btn-primary')) }}
                </div>
            </div>
        </div>
        
        {{ Form::close() }}

    </section>
@stop
                                                                         
