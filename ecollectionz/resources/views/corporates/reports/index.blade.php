@extends('layouts.corporate-app')
@section('title', 'Reports Dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reports</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
        <!-- Small boxes (Stat box) -->
       <a href='./advanced' class='btn btn-primary'>Advanced Search</a>
        <hr style="border-top: 1px solid #012f5c !important; ">
          <div class="row">
              <div class="col col-sm-6" style="border-right: 1px solid #012f5c !important; ">
                  <div class="card card-info" >
                      <div class="card-header" >
                          <h3 class="card-title" style="color: white;">Paid This month</h3>
                          <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-widget="collapse">
                                  <i class="fa fa-minus"></i>
                              </button>
                          </div>
                      </div>
                      <div class="card-body">
                      
                      <div id="container" ></div>
                          <script>
                            var d = new Date();
                            var n = d.getMonth();
                            const monthNames = ["January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"
                            ];
                            $('#container').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Paid This month'
                            },
                            xAxis: {
                                categories: [monthNames[d.getMonth()]],
                                crosshair: true
                            },
                            yAxis: {
                                title: {
                                    text: 'Total'
                                }
                            },
                            series: [{
                                name: '{{$paid[0]->CP_NAME}}',
                                data: [{{$paid[0]->P_COUNT}}]
                            }]
                        });
                            
                          </script>
                      </div>
                  </div>
              </div>
              <div class="col col-sm-6" style="border-right: 1px solid #012f5c !important; ">
                  <div class="card card-success" >
                      <div class="card-header" >
                          <h3 class="card-title" style="color: white;">Paid online this month</h3>
                          <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-widget="collapse">
                                  <i class="fa fa-minus"></i>
                              </button>
                          </div>
                      </div>
                      <div class="card-body">

                      <div id="container1" ></div>
                      
                      <?php 
                        $data="";
                        if(empty($paid_online)){
                            echo "<h4>No data yet</h4>";
                        }
                        
                        else {
                            foreach($paid_online as $p){
                               
                                $data.="name: '".$p->CP_NAME."' ,";
                               
                                $data.="data: [".$p->P_COUNT."] },";
                            }
                            $data= substr($data, 0, -1);
                            
                      ?>
                          <script>
                            var d = new Date();
                            var n = d.getMonth();
                            $('#container1').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Paid Online This month'
                            },
                            xAxis: {
                                categories: [monthNames[d.getMonth()]],
                                crosshair: true
                            },
                            yAxis: {
                                title: {
                                    text: 'Total'
                                }
                            },
                            series: [{
                                <?php echo  $data; ?>
                            ]
                        });
                            
                          </script>
                         <?php 
                        }
                         ?>
                      </div>
                  </div>
              </div>
          </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
@endsection
