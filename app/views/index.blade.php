@extends('layouts.home')

@section('content-header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Dashboard <small>Control panel</small> </h1>

</section>
@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="span6">
        <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3> Today's Stats</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="widget big-stats-container">
                    <div class="widget-content">
                        <h6 class="bigstats">Daily and Monthly stats</h6>
                        <div id="big_stats" class="cf">
                            <div class="stat">
                                <i class="icon-calendar"></i> <span class="value">{{$today}}</span> 
                                <div class="description">Today {{date("D M d")}}</div>
                            </div>
                            <!-- .stat -->

                            <div class="stat"> <i class="icon-calendar-empty"></i> <span class="value">{{$month}}</span> 
                                <div class="description">Total SMS for {{date("M")}}</div>

                            </div>
                            <!-- .stat -->

                            <div class="stat"> <i class="icon-calendar"></i> <span class="value">{{$totalsms}}</span>
                                <div class="description">Total SMS</div>

                            </div>
                            <!-- .stat -->

                           
                            <!-- .stat --> 
                        </div>
                    </div>
                    <!-- /widget-content --> 

                </div>
            </div>
        </div>

    </div>
    <div class="span5">
        
        <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3>SMS by Application</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="widget big-stats-container">
                    <div class="widget-content">
                        <div id="simplechart"></div>
                    </div>
                    <!-- /widget-content --> 
                </div>
            </div>
        </div>
        <div id="tsv"></div>
    </div>

</section>
<!-- /.content -->
@stop
@section('script')
<script type="text/javascript">
 $(function () {
    $('#simplechart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [{{$respond}}
            ]
        }]
    });
});


</script>
@stop



