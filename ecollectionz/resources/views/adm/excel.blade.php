@extends('layouts.admin-app')

@section('title', 'Excel Management')
@section('content')
<div class="content-wrapper">
  <!-- Modal-->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Excel Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Excel</li>
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
            <div class="card card-info">
              <div class="card-header ">
                <h3 class="card-title up_title" style='color: white;'>Import Excel !</h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                      </button>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body uploading">
                  {!! Form::open([ 'id' =>'formm', 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
                  <label for='import_file'>Select your Excel: </label><br/> 
                  <div class="input-group">
                      <span class="input-group-btn">
                          <span class="btn btn-default btn-file">  
                              Browse… <input type="file" id="import_file" name="import_file" accept=".xlsx, .xls, .csv" />
                          </span>
                      </span>
                      <input type="text" class="form-control" readonly>
                  </div>
                  <br/>
                  <sub style="color: red; font-style: italic;">Note: Only xls and xlsx are accepted</sub>

                  <hr>
                  <button type="submit" class="btn btn-success" style="width:100%;">Upload !</button>

                  {!! Form::close() !!}
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
          <hr><br>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style='color:#012F5C;'>Export Excel !</h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                      </button>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  {!! Form::open(['action'=>'Admins\ExcelController@downloadExcel', 'method'=>'POST']) !!}
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col col-sm-4" style="border-right: 1px solid #012F5C;">
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
                      <div class="col col-sm-4" style="border-right: 1px solid #012F5C;">
                          <div class="form-group">
                              <label>Select Corporate</label>
                              <select class="form-control select2" style="width: 100%;" name="corporates">
                                  <option value="null">Select Corporate</option>
                                @foreach($corp as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col col-sm-4">
                          <div class="form-group">
                              <label>Status</label>
                              <select class="form-control select2" name="status" style="width: 100%;">
                                <option value="null">Select the Status</option>
                                <option value="B">B - Barcode</option>
                                <option value="C">C - Cancelled</option>
                                <option value="D">D - Distribute</option>
                                <option value="E">E - Eliminate</option>
                                <option value="F">F - Failed</option>
                                <option value="P">P - Paid</option>
                                <option value="P-Online">P-Online</option>
                                <option value="">UN - Under progress</option>
                                <option value="V">V - Comments</option>
                              </select>
                          </div>
                      </div>
                      <div class="col col-sm-12">
                          <br/>
                          <button type="submit" class="btn btn-warning" style="width: 100%;">Export !</button>
                      </div>
                  </div>
                  {!! Form::close() !!}
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
      <br><br/>
    </section>
    <!-- /.content -->
  </div>
</div>
@endsection
