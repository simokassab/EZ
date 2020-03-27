@extends('layouts.admin-app')
@section('title', 'Status')
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
            <h1 class="m-0 text-dark">Status</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Status</li>
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
        <div class="row">
          <div class="col col-sm-12">
          @include('inc.messages')
            <div class="card card-warning" style="border: 2px solid #012F5C;">
              <div class="card-header" style="background-color: #012F5C;" >
                <h3 class="card-title" style=" color: white; ">Status</h3>
              </div>
              <div class="card-body">
                  <table id="status_tab" class="table table-bordered table-hover" style="width: 100%;">
                   <thead>
                   <tr>
                       <th>Code</th>
                       <th>Description</th>
                       <th>Control</th>
                   </tr>
                   </thead>
                    <tbody>
                      @foreach($status as $s)
                      <tr>
                          <td>{{$s->code}}</td>
                          <td>{{$s->name}}</td>
                          <td><a href="./{{$s->id}}/status" class="btn btn-warning"><i class="fas fa-edit"></i> </a> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>         
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
