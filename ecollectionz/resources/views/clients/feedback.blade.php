@extends('layouts.app')
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
            <h1 class="m-0 text-dark">Feedback</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Feedback</li>
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
      @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
        <!-- Small boxes (Stat box) -->
      <br/>
        <form crole="form" method="post" action="{{ route('feedback.send') }}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col col-sm-12">
            <div class="card card-info" style="border: 2px solid #012F5C;">
              <div class="card-header">
                <h3 class="card-title">Send us your Feedabck !</h3>
              </div>
              <div class="card-body">
               <form name='feedback' action='' method='post'>
               <div class='row'>
               <div class='col col-sm-6'>
                <div class='form-group'>
                  <label for='name'>Name</label>
                  <input type='text' name='name' id='name' 
                  value='{{Auth()->user()->name}}'class="form-control" required> 
                </div>
                <hr>
                <div class='form-group'>
                  <label for='email'>Email</label>
                  <input type='text' name='email' id='email' 
                  value='{{Auth()->user()->email}}'class="form-control" required> 
                </div>
               <hr>
                <div class='form-group'>
                  <label for='phone'>Phone</label>
                  <input type='text' name='phone' id='phone' 
                  value='{{Auth()->user()->phone}}' class="form-control" required> 
                </div>
               </div>
               <div class='col col-sm-6'>
               <div class='form-group'>
                  <label for='message'>Message</label>
                  <textarea name='message' id='message'  class="form-control" required rows='10'></textarea>
               </div>
               
               </div>
               <button type="submit" class="btn btn-success" style="width:100%;">Send!</button>
                </form>
              
              </div>
              
              <!-- /.card-body -->
            </div>
          </div>         
        </div> 

         {!! Form::close() !!}
         <script id="vapulusScript" 
vapulusId="81f4e32b-754a-4ecc-baee-28e0f3a22180" 
amount="1.00" 
onaccept="https://ecollectionz.com/ecollectionz/public/feedback" 
onfail="https://ecollectionz.com/ecollectionz/public/feedback" 
src="https://storage.googleapis.com/vapulus-website/script.js"></script>  
       
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
 