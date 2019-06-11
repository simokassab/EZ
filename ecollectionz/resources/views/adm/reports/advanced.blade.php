@extends('layouts.admin-app')
@section('title', 'Search Dashboard')
@section('content')

    <div class="content-wrapper">
        <!-- Modal-->

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Advanced Reports</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Advanced Reports</li>
                        </ol>

                    </div><!-- /.col -->
                </div><!-- /.row -->
                <hr style="border-bottom: 1px solid #012F5C;">
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            @include('inc.messages')
                <div class="row">
                    <div class="col-12">
                        <div class="card card-success">
                            <div class="card-header ">
                                <h3 class="card-title" style='color:white;'>Search</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            {!! Form::open(['id'=>'advanced', 'method'=>'get']) !!}
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col col-sm-6" style="border-right: 1px solid #012F5C;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="dateype" name="dateype" value="due_date" checked="checked" >
                                            <label class="form-check-label" for="due">Due Date</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="dateype1" name="dateype" value="bord_date">
                                            <label class="form-check-label" for="dateype1">bord Date</label>
                                        </div>
                                   <br> <hr>
                                        <label>Date Range:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="dates" name="dates">
                                        </div>
                                    </div>
                                    <div class="col col-sm-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control select2" name="status" id='status' style="width: 100%;">
                                                <option value="0">Select the Status</option>
                                                <option value="B">B - Barcode</option>
                                                <option value="C">C - Cancelled</option>
                                                <option value="D">D - Distribute</option>
                                                <option value="E">E - Eliminate</option>
                                                <option value="F">F - Failed</option>
                                                <option value="P">P - Paid</option>
                                                <option value="P-Online">P-Online</option>
                                                <option value="UN">UN - Under progress</option>
                                                <option value="V">V - Comments</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-sm-3">
                                        <div class="form-group">
                                        <label>Select Corporate</label>
                                        <select id=corp class="form-control select2" style="width: 100%;" name="corporates">
                                            <option value="null">Select Corporate</option>
                                            @foreach($corp as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col col-sm-12">
                                        <br/>
                                        <input type="hidden" value="search" name="search" id="search">
                                        <button type="submit" class="btn btn-warning" style="width: 100%;">Search !</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div id='chart1'></div>
                </div>
            </div>
                <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    </div>

@endsection
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


<script>
$(document).ready( function() {
    $('#advanced').submit(function(event){
      event.preventDefault();
      var corp = $('#corp').val();
      var status = $('#status').val();

      var datetype =$('input[name=dateype]:checked', '#advanced').val();
      var dates =$('#dates').val();
      dates= dates.replace(/\//g, "!");
      var formData = new FormData;
      formData.append('corp', corp);
      formData.append('status', status);
      formData.append('datetype', datetype);
      formData.append('dates', dates);

      //alert(datetype);
      $.ajax({
        url: './'+corp+'/'+status+'/'+datetype+'/'+dates+'/getsearch',
        type: 'get',
        success: function (data1) {
            console.log(data1);
            var json = $.parseJSON(data1);
            var categ = '';
            var series1 = '';
            //for (var i=0;i<json.length;++i) {
                categ+="'"+json[0].DD+"',"
                series1+="{name: '"+json[0].CP_NAME+"',";
                series1+="data: ["+json[0].P_COUNT+"]},";
           // }
            series1=series1.slice(0,-1);
            categ= categ.slice(0,-1)
            //categ+=']';
            console.log(categ);
            console.log(series1);
            var d = new Date();
            var n = d.getMonth();
            const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
            ];
            Highcharts.chart('chart1', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },

            xAxis: {
                categories: [
                    'JUNE'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'values'
                }
            },

            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{name: 'E-LOAN',data: [590]}, {name: 'Money  SAL',data: [8298]}]
        });
        }

    });
    });
});
</script>