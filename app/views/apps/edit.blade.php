@extends('layouts.main')

@section('head')
@parent
{{ HTML::style('css/datatables/dataTables.bootstrap.css'); }}
@stop


@section('content-header')
Applications
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


    {{ Form::open(array('url'=> 'apps/'.$cat->id,'method'=>'put')) }}
    <div class="">
        <div class="form-group">
            {{ Form::label('app_name','Application Name') }}
            <input type="text" name="app_name" value="{{$cat->app_name}}" class="form-control" placeholder="Application name"/>
        </div>

        <div class="form-group">
            {{ Form::label('outboundurl','Outbound URL') }}
            <input type="text" name="outboundurl" value="{{$cat->outbound_url}}" class="form-control" placeholder="Application name"/>
            Place holders
            #msisdn
            #msg
            #date
        </div>
        <div class="form-group">
            {{ Form::label('apiKey','API Key') }}
            <input type="text" name="apiKey" readonly="readonly" value="{{$cat->api_key}}" class="form-control" placeholder="Application name"/>
            <input type="checkbox" name="genapikey" value="1"/>Re Generate API Key 
        </div>


        <div class="form-group">
            {{ Form::label('status','Status') }}
            <select name="status">
                <option >ACTIVE</option>
                <option >INACTIVE</option>
            </select>
        </div>

        <div class="form-group">
            {{ Form::submit('Edit Application',array('class'=>'btn btn-primary')) }}
        </div>

        <input type="hidden" name="id"  value="{{$cat->id}}"/>


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


