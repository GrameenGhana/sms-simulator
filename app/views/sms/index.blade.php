@extends('layouts.main')

@section('head')
@parent
{{ HTML::style('css/datatables/dataTables.bootstrap.css'); }}
@stop


@section('content-header')
<!-- Content Header (Page header) -->
SMS Messages 
@stop

@section('content')

<section class="content invoice">

    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <a class="btn btn-small btn-success" href="{{ URL::to('sms/create') }}"><i class="fa fa-plus-circle"></i> Add a SMS</a>
            </h2>
        </div><!-- /.col -->
    </div>


    <div class="box">
        <div class="box-header">
            {{ Form::open(array('url'=> 'smsi/search','method'=>'get')) }}
            Search by application 
            <input type="text" name="q" value="{{Input::get('q')}}" placeholder="Search"/>
            <select name="a">
                <?php
                $apps = SystemApplication::all();
                ?>
                @foreach($apps as $value)
                <option value="{{ $value->id }}"
                        @if($value->id== Input::get('a')) 
                        selected="selected" 
                        @endif
                        >{{ $value->app_name }}</option>
                @endforeach
            </select>
            <input type="submit" value="search" class="btn btn-success" />

            {{ Form::close() }}
        </div><!-- /.box-header -->

        <div class="box-body table-responsive">
            <table id="userstable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Application</th>
                        <th>Message</th>
                        <th>Direction</th>
                        <th>Date</th>
                        <th>Status</th> 
                        <th>Source</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($sms as $value)
                    <tr>
                        <td> {{ $value->sender }} </td>
                        <td> {{ $value->recipient }} </td>
                        <td> {{ $value->application}} </td>
                        <td> {{ $value->message}} </td>
                        <td> {{ $value->direction}} </td>
                        <td> {{ date('M d, Y H:i:s',strtotime($value->created_at)) }} </td>
                        <td> {{ $value->status}} </td><td> {{ $value->source}} </td>
                        <td>
                            <a title="Edit" class="label label-sm label-inverse" href="{{ URL::to('smsi/respond/'.$value->recipient."/".$value->application) }}"><i class="fa fa-pencil"></i>Respond</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $sms->links() }}
        </div>
</section>

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
            "iDisplayLength": 100
        });
    });
</script>
@stop


