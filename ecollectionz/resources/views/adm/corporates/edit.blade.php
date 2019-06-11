@extends('layouts.admin-app')
@section('title', 'Corporate Dashboard')
@section('content')
<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
#img-upload{
    width: 50%;
}

</style>
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
       
         @foreach ($corp as $a)
        <?php 
            $photo = $a->photo;
        ?>
         <a href="{{ route('admin.corporate.delete', $a->id) }}" class="btn btn-lg btn-danger" style="float: right;"><i class='fas fa-trash'></i> Delete Corporate</a><br/><br/><br/>
        <form crole="form" method="post" action="{{ route('admin.corporate.update', $a->id) }}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col col-sm-12">
            <div class="card card-warning" style="border: 2px solid #012F5C;">
              <div class="card-header">
                <h3 class="card-title">Edit This Corporate !</h3>
              </div>
              <div class="card-body">
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text">ID</span>
                      </div>
                      <input type="text" class="form-control" name='id' id='id' value="{{$a->id}}" placeholder="Name">
                  </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                  </div>
                  <input type="text" class="form-control" name='name' id='name' value="{{$a->name}}" placeholder="Name">
                </div>
                <br>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" name='email' id='email' value="{{$a->email}}" placeholder="Email">
                </div>
                <br>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                  </div>
                  <input type="number" class="form-control" name='phone' id='phone' value="{{$a->phone}}" placeholder="Phone">
                </div>
                <br>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="text" class="form-control" name='address' id='address' value="{{$a->address}}" placeholder="Address">
                </div>
                <br/>
                <div class="input-group mb-3">
                    <label for="pay_online">Pay Online: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                    @if ($a->pay_online==1)
                        <label>YES
                          <input type="radio" name="pay_online" class="flat-red" value="1" checked> 
                        </label>&nbsp;&nbsp;&nbsp;
                        <label>NO
                          <input type="radio" name="pay_online" value="0" class="flat-red"> 
                        </label>
                    @else
                        <label>YES
                          <input type="radio" name="pay_online" value="1" class="flat-red" > 
                        </label>&nbsp;&nbsp;&nbsp;
                        <label>NO
                          <input type="radio" name="pay_online" value="0" class="flat-red" checked> 
                        </label>
                    @endif
                </div>
                  <div class="input-group mb-3">
                      <label for="gpa">GPA: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                      @if ($a->gpa==1)
                          <label>YES
                              <input type="radio" name="gpa" class="flat-red" value="1" checked>
                          </label>&nbsp;&nbsp;&nbsp;
                          <label>NO
                              <input type="radio" name="gpa" value="0" class="flat-red">
                          </label>
                      @else
                          <label>YES
                              <input type="radio" name="gpa" value="1" class="flat-red" >
                          </label>&nbsp;&nbsp;&nbsp;
                          <label>NO
                              <input type="radio" name="gpa" value="0" class="flat-red" checked>
                          </label>
                      @endif
                  </div>
                  <div class="input-group mb-3">
                      <label for="pay_online">Collect Fees: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                      @if ($a->collect_fees=='1')
                          <label>Corporate
                              <input type="radio" name="collect_fees" class="flat-red" value="1" checked>
                          </label>&nbsp;&nbsp;&nbsp;
                          <label>Client
                              <input type="radio" name="collect_fees" value="0" class="flat-red">
                          </label>
                      @else
                          <label>Corporate
                              <input type="radio" name="collect_fees" value="1" class="flat-red" >
                          </label>&nbsp;&nbsp;&nbsp;
                          <label>Client
                              <input type="radio" name="collect_fees" value="0" class="flat-red" checked>
                          </label>
                      @endif
                  </div>
                  <div class="input-group mb-3">
                      <label for="pay_online">Net Commerce Fees: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                      @if ($a->net_c_fees==1)
                          <label>Corporate
                              <input type="radio" name="net_c_fees" class="flat-red" value="1" checked>
                          </label>&nbsp;&nbsp;&nbsp;
                          <label>Client
                              <input type="radio" name="net_c_fees" value="0" class="flat-red">
                          </label>
                      @else
                          <label>Corporate
                              <input type="radio" name="net_c_fees" value="1" class="flat-red" >
                          </label>&nbsp;&nbsp;&nbsp;
                          <label>Client
                              <input type="radio" name="net_c_fees" value="0" class="flat-red" checked>
                          </label>
                      @endif
                  </div>

                  <hr>
                <div class='row'>
                  <div class="col col-sm-6" style="border-right: 1px solid #012F5C;">
                    
                    <div class="form-group">
                      <label>Change Image</label>
                      <div class="input-group">
                          <span class="input-group-btn">
                              <span class="btn btn-default btn-file">
                                  Browse… <input type="file" id="imgInp" name="photo">
                              </span>
                          </span>
                          <input type="text" class="form-control" readonly>
                      </div>
                      <img id='img-upload' />
                    </div>
                  </div>
                  <div class="col col-sm-6" style="text-align: center;">
                    <h5>Current Photo:</h5>
                    <img  src="{{asset('images/') }}<?php echo '/'.$photo; ?>"  class="img-circle">
                  </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-success" style="width:100%;">Change It!</button>
              </div>
              <!-- /.card-body -->
            </div>
          </div>         
        </div> 
         {!! Form::close() !!}
        @endforeach
       
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
