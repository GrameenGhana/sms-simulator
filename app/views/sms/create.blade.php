@extends('layouts.main')

@section('head')
@parent
{{ HTML::style('css/datatables/dataTables.bootstrap.css'); }}
@stop

@section('content-header')

@stop

@section('content')

<section class="content invoice">
    <div class="box">

        <div class="iphone">



            <div>  
                {{ Form::open(array('url'=> 'sms','method'=>'post')) }}
                <div class="recipient">
                    <input type="text" class="form-control" name="to" value="" placeholder="233201010101" />
                </div>
                <select name="from" style="width: 95%">
                        <?php  
                        $apps = SystemApplication::all();
                        ?>
                          @foreach($apps as $value)
                          <option value="{{ $value->id }}">{{ $value->app_name }}</option>
                           @endforeach
                    </select>
                  <select name="direction" style="width: 95%">
                      <option>IN</option>
                      <option>OUT</option>
                  </select>
                <input type="hidden" name="type" value="w" />
     
                <div id="msgcnt">0</div>
                <textarea rows="3" name="message" id="msgcontent"onkeyup="wordCount()" placeholder="Send Message to " class="form-control" style="width: 79%;float: left"></textarea>
                <input type="submit" name="send" value="send" style="float: left;width: 18%;height: 78px" class="btn btn-inverse"/>
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
</script>
@stop


