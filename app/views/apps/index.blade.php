@extends('layouts.main')

@section('head')
@parent
{{ HTML::style('css/datatables/dataTables.bootstrap.css'); }}
@stop


@section('content-header')
<!-- Content Header (Page header) -->
Applications
@stop

@section('content')

<section class="content invoice">

    <div class="row">
        <div class="col-xs-12">


        </div><!-- /.col -->
    </div>

        <a class="btn btn-small btn-success" href="{{ URL::to('apps/create') }}"><i class="fa fa-plus-circle"></i> Create Application</a>
     
    <div class="box">
        <div class="box-header">
        </div><!-- /.box-header -->

        <div class="box-body table-responsive">
            <table id="userstable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Application Name</th>

                        <th>API Key</th>

                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($apps as $value)
                    <tr>
                        <td> {{ $value->app_name }} </td>
                        <td> {{ $value->api_key }} </td>
                        <td> {{ $value->status}} </td>
                        <td>
                            <a title="Edit" class="label label-sm label-info" href="{{ URL::to('apps/'. $value->id ) }}"><i class="fa fa-pencil">Edit</i></a>
                              <a title="Edit" class="label label-sm label-info" href="{{ URL::to('appsms/'. $value->id ) }}"><i class="fa fa-pencil">SMS</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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


