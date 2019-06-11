@extends('layouts.admin-app')
@section('title', 'Feedback Dashboard')
@section('content')

  <div class="content-wrapper">
    <!-- Modal-->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Feedbacks</h1>
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
      @include('inc.messages')
      <!-- Small boxes (Stat box) -->
        <br/>
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style='color:#012F5C;'>Feedback</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <?php
                  // print_r($policies)
                  ?>
                <table id="brokers_table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Control</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($feedback as $p)
                    <tr>
                      <td>{{$p->name}}</td>
                      <td>{{$p->phone}}</td>
                      <td>{{$p->email}}</td>
                      <td>{{$p->message}}</td>
                      <td>{{$p->created_at}}</td>
                      <td>
                          @if($p->isread ==1)
                           <p style="color: red; font-weight: bolder;">IS READ</p>
                          @else
                              <a href="{{ route('admin.feedback.read', $p->id) }}" class="btn btn-success" title='Mard As Read'>
                                  <i class='fas fa-check-square'></i></a>
                          @endif

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
