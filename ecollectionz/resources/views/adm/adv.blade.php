@extends('layouts.admin-app')
@section('title', 'ADV')
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
            <h1 class="m-0 text-dark">Adv</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Adv</li>
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
        {!! Form::open(['action'=>'Admins\AdvController@saveIt', 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col col-sm-12">
          @include('inc.messages')
            <div class="card card-warning" style="border: 2px solid #012F5C;">
              <div class="card-header">
                <h3 class="card-title">Adv</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label class="control-label"for="corporates">Select Slider:</label>
                  <select class="form-control select2"  style="width: 100%;" name='slider' id ='slider' required>
                          <option value="1" >Slider 1</option>
                          <option value="2" >Slider 2</option>
                          <option value="3" >Slider 3</option>
                  </select>
                </div>              
                 <hr>
                <div class='row'>
                  <div class="col col-sm-6" style="border-right: 1px solid #012F5C;">
                    
                    <div class="form-group">
                      <label>Change Image</label>
                      <div class="input-group">
                          <span class="input-group-btn">
                              <span class="btn btn-default btn-file">
                                  Browse… <input type="file" id="imgInp" name="photo" required>
                              </span>
                          </span>
                          <input type="text" class="form-control" readonly>
                      </div>
                      <img id='img-upload' />
                    </div>
                  </div>
                  <div class='col col-sm-6'>
                    <div class="form-group">
                    <label class="control-label"for="title">Title:</label>
                    <input type='text' name='title' id='title' placeholder='Title' required  class="form-control">
                    </div> 
                  </div>
                  <div class='col col-sm-6'>
                    <div class="form-group">
                    <label class="control-label"for="desc">Description:</label>
                    <textarea placeholder='Description' name='desc' id='desc' required class="form-control"></textarea>
                    </div> 
                  </div>
                  <div class='col col-sm-6'>
                    <div class="form-group">
                    <label class="control-label"for="url">URL:</label>
                    <input type='text' name='url' id='url' placeholder='Website..'  class="form-control">
                    </div> 
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
      
       
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
