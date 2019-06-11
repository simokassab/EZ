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
            <h1 class="m-0 text-dark">Clients</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Clients</li>
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
       <br/><br/>
        <div class="row">
          <div class="col-12">
           
          <div class="card">
            <div class="card-header">
              @foreach ($cp as $c)
              <h3 class="card-title" style='color:#012F5C;'>List of Clients - Corporate: {{$c->name}} </h3>
              @endforeach
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="c_table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>GPA</th>
                  <th>Address</th>
                  <th>Control</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($clients as $a)
                    <tr id="{{$a->PHONE}}" class='policc' style='cursor: pointer;' title='See Policies'> 
                      <td>{{$a->client_name}}</td>
                      <td>{{$a->PHONE}}</td>
                      <td>{{$a->email}}</td>
                      <td>%</td>
                      <td>{{$a->address}}</td>
                      <td style="width: 15% !important;">
                        <div class="button_cont" align="center">
                            <a class="example_e" href="../../{{$a->PHONE}}/policy" rel="nofollow noopener">
                                Policies
                            </a>
                        </div>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
