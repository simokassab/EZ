@extends('layouts.corporate-app')
@section('title', 'Profile')
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
            <h1 class="m-0 text-dark">My Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
         @foreach ($profile as $p)
         <?php 
            $photo = $p->photo;
        ?>
      <br/>
        <form crole="form" method="post" action="{{ route('corporates.profile.update') }}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col col-sm-12">
            <div class="card card-warning" style="border: 2px solid #012F5C;">
              <div class="card-header">
                <h3 class="card-title">Edit Profile !</h3>
              </div>
              <div class="card-body">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                  </div>
                  <input type="text" class="form-control" name='name' id='name' value="{{$p->name}}" placeholder="Name">
                </div>
                <br>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" name='email' id='email' value="{{$p->email}}" placeholder="Email">
                </div>
                <br>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                  </div>
                  <input type="number" class="form-control" name='phone' id='phone' value="{{$p->phone}}" placeholder="Phone">
                </div>
                <br> 
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                  </div>
                  <input type="text" class="form-control" title='Your address' name='address' id='address' value="{{$p->address}}">
                </div>
                <br>  
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
                    @if(!$p->photo==NULL)
                    <img  src="{{asset('images/') }}<?php echo '/'.$photo; ?>"  class="img-circle" width="35%">
                    @else
                      No photo yet
                    @endif
                  </div>
                </div>  
                <hr>
                <button type="submit" class="btn btn-success" style="width:100%;">Update!</button>
              
              
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
