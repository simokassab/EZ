@extends('layouts.admin-app')
@section('title', 'Corporate Dashboard')
@section('content')

<div class="content-wrapper">
  <!-- Modal-->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Corporates</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Corporates</li>
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
        <!-- Small boxes (Stat box) -->
        <a class="btn btn-lg btn-success" style="float: right; color:white" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Add New</a><br/><br/><br/>
      <div class="row">
        @foreach ($corp as $a)
        <?php 
            $photo = $a->photo;
        ?>
        <div class="col col-sm-4">
          @if ($a->active==0)
              <div title="Desactivated" class="card card-widget widget-user " 
              style='background-color: #EA989B; color:white; opacity: 0.9; border: 2px solid #DC3545;'>
          @else
              <div class="card card-widget widget-user " style='background-color: #012F5C; color:white; opacity: 0.9; border: 2px solid #28A745'>
          @endif
                  <a href='./corporate/{{$a->id}}/edit' class="btn btn-warning" style="color: white; position: absolute; color: white; top: -10px; right: -10px;"><i class="fa fa-edit"></i> </a>
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-danger-active">
                <h4 class="widget-user-username" style="color:white;"><u>{{$a->name}}</u></h4>
                <h5 class="widget-user-desc">{{$a->email}}</h5>
                <i class="fas fa-mobile-alt"></i><strong> &nbsp;: {{$a->phone}}</strong><br/>
                <i class="fas fa-map-marker"></i><strong> &nbsp;: {{$a->address}}</strong>
              </div>
              <div class="widget-user-image" style='position: absolute; top: 10% !important; left: 87%; margin-left: -45px;'>
                <img class="img-circle elevation-2" src="{{asset('images/') }}<?php echo '/'.$photo; ?>" >
              </div>
              <div class="card-footer" style="border: 0">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <a href="{{route ('admin.corporate.getbrokers' , $a->id)}}" class="btn btn-danger "> Brokers </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                       <a href="{{route ('admin.corporate.getclients' , $a->id)}}" class="btn btn-info "> Clients </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                        <a href="{{route ('admin.corporate.getpolicies' , $a->id)}}" class="btn btn-primary "> Policies </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
        </div>
        @endforeach
      </div>
      <br/><br>
        <div class="row">
          <div class="col-12">
           
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style='color:#012F5C;'>List of Our Corporates</h3>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="corporates_table" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                    <th>Pay Online</th>
                    <th>GPA</th>
                  <th>Active</th>
                  <th>Control</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($corp as $a)
                  @if ($a->active==1)
                       <tr >
                  @else
                      <tr style="background-color: #EBA1A4;">
                  @endif
                   
                      <td>{{$a->name}}</td>
                      <td>{{$a->email}}</td>
                      <td>{{$a->phone}}</td>
                      <td>{{$a->address}}</td>
                      @if ($a->pay_online ==1) 
                          <td style="text-align: center !important;"><strong  class="text-success" >YES</strong></td>                          
                      @else
                          <td style="text-align: center !important;"><strong  class="text-danger" >NO</strong></td> 
                      @endif
                      @if ($a->gpa ==1)
                          <td style="text-align: center !important;"><strong  class="text-success" >YES</strong></td>
                      @else
                          <td style="text-align: center !important;"><strong  class="text-danger" >NO</strong></td>
                      @endif
                      @if ($a->active==1)
                        <td style="text-align: center !important;"><span  class="badge badge-success" >Active</span></td>
                      @else
                        <td  style="text-align: center !important;"><span class="badge badge-danger">Inactive</span></td>
                      @endif
                      <td style="text-align:center;">
                        <a href="./corporate/{{$a->id}}/edit" class="btn btn-warning" style="color: white" title='Edit'><i class="fa fa-edit"></i></a>
                        @if ($a->active==1)
                            <a href="{{ route('admin.corporate.delete', $a->id) }}" class="btn btn-danger" title='Desactivate'>
                              <i class='fas fa-trash'></i></a>
                        
                        @else
                            <a href="{{ route('admin.corporate.activate', $a->id) }}" class="btn btn-success" title='Activate'>
                              <i class='fas fa-check-square'></i></a>
                        @endif
                        <a href="./edit/{{$a->id}}" class="btn btn-info" title='Report'><i class="fa fa-chart-line"></i></a>
                      </td>
                    </tr> 
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
      <br/><br/>
    </section>
    <!-- /.content -->
  </div>
</div>
@endsection

