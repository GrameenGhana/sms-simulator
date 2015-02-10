@extends('layouts.main')

@section('head')
@parent
{{ HTML::style('css/datatables/dataTables.bootstrap.css'); }}
@stop


@section('content-header')
Applications &raquo; Create
@stop

@section('content')






<div class="box-body table-responsive">
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


    {{ Form::open(array('url'=> 'apps','method'=>'post')) }}
    <div class="span7">
        <div class="form-group">
            {{ Form::label('app_name','Application Name') }}
            {{ Form::text('app_name',Input::old('app_name'),array('class'=>'form-control','placeholder'=>'Enter Application Name')) }}
        </div>

        <div class="form-group">
            {{ Form::label('outboundurl','Outbound URL') }}
            {{ Form::text('outboundurl',Input::old('outboundurl'),array('class'=>'form-control','placeholder'=>'eg http:\\ URL')) }}
        </div>

        <div class="form-group">
            {{ Form::label('status','Status') }}
            <select name="status" class="form-control">
                <option>ACTIVE</option>
                <option>INACTIVE</option>
            </select>
        </div>

        <div class="form-group">
            {{ Form::submit('Create Application',array('class'=>'btn btn-primary')) }}
        </div>



    </div>

    {{ Form::close() }}


    @stop
    @section('script')
    <script type="text/javascript">
        $(function() {
            $('#userstable').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false,
                "iDisplayLength": 5
            });
        });
    </script>
    @stop


