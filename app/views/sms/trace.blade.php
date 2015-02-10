@extends('layouts.main')

@section('head')
@parent
{{ HTML::style('css/datatables/dataTables.bootstrap.css'); }}
@stop


@section('content-header')
SMS Trace {{$recipient}} - {{$app->app_name}}
@stop

@section('content')

<section class="content invoice">



    <div class="box">

        <div class="iphone">

            <div class="recipient">{{$recipient}}</div>
            <div class="msgs">
                @foreach($sms as $value)

                @if($value->direction=='IN')
                <div class="msg in">
                    {{ $value->message}}
                    <div class="date">{{ date('D jS M, Y h:i a',strtotime($value->created_at)) }}</div> 
                </div>
                @endif
                @if($value->direction=='OUT')
                <div class="msg out">
                    {{ $value->message}}
                    <div class="date">{{ date('D jS M, Y h:i a',strtotime($value->created_at)) }}</div> 
                </div>
                @endif

                @endforeach
            </div>    
            <div>
                {{ Form::open(array('url'=> 'sms','method'=>'post')) }}
                <input type="hidden" name="direction" value="OUT" />
                <input type="hidden" name="type" value="w" />
                <input type="hidden" name="api_key" value="{{$app->api_key}}" />
                <input type="hidden" name="from" value="{{$app->id}}" />
                <input type="hidden" name="to" value="{{$recipient}}" />

                <textarea rows="3" name="message" id="msgcontent"onkeyup="wordCount()" placeholder="Send Message to {{$recipient}}" class="form-control" style="width: 75%;float: left;height: 58px;"></textarea>
                <div style="width: 18%;float: left;text-align: center;font-size: 1.0rem">
                    <div id="msgcnt" >0</div>
                    <input type="submit" name="send" value="send" style="height: 55px;width: 100%" class="btn btn-inverse"/>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>      
</div>      
</section>

@stop
@section('script')
<script type="text/javascript">
    function wordCount() {
        document.getElementById("msgcnt").innerHTML = document.getElementById("msgcontent").value.length;

    }
    $(function() {
        $('#container').highcharts({
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
                    data: [
                        ['Firefox', 45.0],
                        ['IE', 26.8],
                        {
                            name: 'Chrome',
                            y: 12.8,
                            sliced: true,
                            selected: true
                        },
                        ['Safari', 8.5],
                        ['Opera', 6.2],
                        ['Others', 0.7]
                    ]
                }]
        });
    });


</script>
@stop


