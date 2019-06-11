@extends('layouts.brokers-app')
@section('title', 'Brokers')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard Brokers</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>

                    </div><!-- /.col -->
                </div><!-- /.row -->
                <hr style="border-bottom: 1px solid #012F5C;">
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content container-fluid">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$paid_policies[0]->P_COUNT}}</h3>

                                    <p>Paid Policies</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-clipboard"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-6 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{$unpaid_policies[0]->P_COUNT}}</h3>
                                    <p>Remaining Policies</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <hr style="border-top: 1px solid #012f5c !important; ">
                    <div class="row">
                        <div class="col col-sm-6" style="border-right: 1px solid #012f5c !important; ">
                            <div class="card card-success" >
                                <div class="card-header" >
                                    <h3 class="card-title" style="color: white;">Summary</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table  class="table table-bordered table-hover" style="border:2px solid #012f5c !important; text-align: center !important;">
                                        <thead>
                                        <tr>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Count
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $data = '[{'; ?>
                                        @foreach($summary as $s)
                                            <?php
                                            if($s->status==''){
                                                $data.="name: 'UN',";
                                                $data.="y: ".$s->COUNT."
                                                },{";
                                            }
                                            else {
                                                $data.="name: '".$s->status."',";
                                                $data.="y: ".$s->COUNT."
                                                },{";
                                            }

                                            ?>
                                            @if ($s->status=='B')
                                                <tr style="font-weight: bold; color: #a94442;" class="clicked" id="B">
                                                    <td  >B - Barcode</td>
                                                    <td style="font-weight: bold;">{{$s->COUNT}}</td>
                                                </tr>
                                            @elseif ($s->status=='C')
                                                <tr style="font-weight: bold;" class="text-danger clicked" id="C">
                                                    <td  >C - Cancelled</td>
                                                    <td style="font-weight: bold;">{{$s->COUNT}}</td>
                                                </tr>
                                            @elseif ($s->status=='D')
                                                <tr style="font-weight: bold;"  class="text-info clicked" id="D">
                                                    <td  >D - Distribute</td>
                                                    <td style="font-weight: bold;">{{$s->COUNT}}</td>
                                                </tr>
                                            @elseif ($s->status=='E')
                                                <tr style="font-weight: bold;" class="text-primary clicked" id="E">
                                                    <td >E - Eliminate</td>
                                                    <td style="font-weight: bold;">{{$s->COUNT}}</td>
                                                </tr>
                                            @elseif ($s->status=='F')
                                                <tr style="font-weight: bold; color: #9f191f;" class="clicked" id="F">
                                                    <td  >F - Failed</td>
                                                    <td style="font-weight: bold;">{{$s->COUNT}}</td>
                                                </tr>
                                            @elseif ($s->status=='P')
                                                <tr style="font-weight: bold; " class="text-success clicked" id="P">
                                                    <td  >P - Paid</td>
                                                    <td style="font-weight: bold;">{{$s->COUNT}}</td>
                                                </tr>
                                            @elseif ($s->status=='P-online')
                                                <tr style="font-weight: bold; color: #012f5c;" class="clicked" id="P-online">
                                                    <td  >P - Online</td>
                                                    <td style="font-weight: bold;">{{$s->COUNT}}</td>
                                                </tr>
                                            @elseif($s->status=='V')
                                                <tr style="font-weight: bold; color: chocolate;" class="clicked" id="V">
                                                    <td  >V - Comments</td>
                                                    <td style="font-weight: bold;">{{$s->COUNT}}</td>
                                                </tr>
                                            @else
                                                <tr style="font-weight: bold; " class="text-warning clicked" id="UN">
                                                    <td >UN - Under progress</td>
                                                    <td style="font-weight: bold;">{{$s->COUNT}}</td>
                                                </tr>
                                            @endif

                                        @endforeach
                                        <?php
                                        $data =  substr($data, 0, -3);
                                        $data.="}]";

                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-6" style="border-right: 1px solid #012f5c !important; ">
                            <div class="card card-success" >
                                <div class="card-header" >
                                    <h3 class="card-title" style="color: white;">Summary</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div id="container" ></div>
                                    <script>
                                        Highcharts.setOptions({
                                            colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                                                return {
                                                    radialGradient: {
                                                        cx: 0.5,
                                                        cy: 0.3,
                                                        r: 0.7
                                                    },
                                                    stops: [
                                                        [0, color],
                                                        [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                                                    ]
                                                };
                                            })
                                        });
                                        Highcharts.chart('container', {
                                            chart: {
                                                plotBackgroundColor: null,
                                                plotBorderWidth: null,
                                                plotShadow: true,
                                                type: 'pie'
                                            },
                                            title: {
                                                text: ''
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
                                                        },
                                                        connectorColor: 'silver'
                                                    },
                                                    showInLegend: true
                                                }
                                            },
                                            series: [{
                                                name: 'Status',
                                                colorByPoint: true,
                                                data: <?php echo $data; ?>,
                                                point:{
                                                    events:{
                                                        click: function (event) {
                                                           // alert(this.name );
                                                            location.href = "./brokers/"+this.name+"/status";
                                                        }
                                                    }
                                                }
                                            }]
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.container-fluid -->
            </section>
    </div>
@endsection

