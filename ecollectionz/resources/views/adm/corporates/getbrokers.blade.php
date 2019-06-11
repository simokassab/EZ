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
            <h1 class="m-0 text-dark">Brokers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brokers</li>
            </ol>
           
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr style="border-bottom: 1px solid #012F5C;">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 
    <!-- Main content -->
    <section class="content">
    <div class="modal fade" id="myModalBroker">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      {!! Form::open(['action'=>'Admins\AdminBrokersController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
       
        <div class="modal-header" style="background-color: #012F5C; color: white;">
          <h4 class="modal-title">Add New Broker</h4>
          <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col col-sm-6">
              <div class="form-group">
                 <label class="control-label"for="name">Name</label>
                 <input type="text" class="form-control" name='name' required id='name'>
              </div>
            </div>
            <div class="col col-sm-6">
              <div class="form-group">
                 <label class="control-label"for="email">Email</label>
                 <input type="email" class="form-control" name='email' required id='email'>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col col-sm-6">
              <div class="form-group">
                 <label class="control-label"for="password">Password</label>
                 <input type="text" class="form-control" name='password' required id='password'>
              </div>
            </div>
            <div class="col col-sm-6">
              <label class="control-label"for="phone">Phone</label>
              <input type="number" class="form-control" name='phone' required id='phone'>
            </div>
          </div>
          <div class="row">
            <div class="col col-sm-6">
              <label class="control-label"for="address">Address</label>
              <input type="text" class="form-control" name='address' required id='address'>
            </div>
            <div class="col col-sm-6">
              <label class="control-label"for="photo">Photo</label>
              <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="customFile" name="photo" required>
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
            </div> 
          </div>
          <br/>
          <div class="row">
            <div class="col col-sm-6">
              <label class="control-label"for="corporates">Select Corporate</label>
              <select class="form-control select2" style="width: 100%;" name='corporates' id ='corporates' required>
                  @foreach ($cp as $a)
                      <option value="{{$a->id}}" selected>{{$a->name}}</option>
                  @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning btn-lg" >Add It !</button>
          <button type="reset" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
      <div class="container-fluid">
        @include('inc.messages')
        <!-- Small boxes (Stat box) -->
        <a class="btn btn-lg btn-success" style="float: right; color:white" data-toggle="modal" data-target="#myModalBroker">
          <i class="fas fa-plus"></i> Add New</a><br/><br/><br/>
        <div class="row">
          <div class="col-12">
           
          <div class="card">
            <div class="card-header">
              @foreach ($cp as $c)
              <h3 class="card-title" style='color:#012F5C;'>List of Brokers - Corporate: {{$c->name}} </h3>
              @endforeach
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="brokers_table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Corporate</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Pay Online</th>
                  <th>Active</th>
                  <th>Control</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($brokers as $a)
                    @if ($a->active==1)
                       <tr >
                      @else
                          <tr style="background-color: #EBA1A4;">
                      @endif
                      <td>{{$a->name}}</td>
                      <td>{{$a->CP_NAME}}</td>
                      <td>{{$a->email}}</td>
                      <td>{{$a->phone}}</td>
                      <td>{{$a->address}}</td>
                      @if ($a->CP_PAY ==1) 
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
                        <a href="{{ url('/') }}/admin/brokers/{{$a->id}}/edit" class="btn btn-warning" style="color: white" title='Edit'><i class="fa fa-edit"></i></a>
                        @if ($a->active==1)
                            <a href="{{ route('admin.brokers.delete', $a->id) }}" class="btn btn-danger" title='Desactivate'>
                              <i class='fas fa-trash'></i></a>
                        
                        @else
                            <a href="{{ route('admin.brokers.activate', $a->id) }}" class="btn btn-success" title='Activate'>
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
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
