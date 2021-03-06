@extends('layouts.app')
@section('title', 'Client Dashboard')
@section('content')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="">Companies you have premiums with :</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
           
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr style="border-bottom: 3px solid #c2c7d0;">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content container-fluid">
        @include('inc.messages')
      <div class="container-fluid">
        <div class="card card-info" style="border: 2px solid #012F5C;">
            <div class="card-header">
              <h2 class="card-title">My corporates</h2>
            </div>
          <div class="card-body">
            <div class="row">
              @if($corp->isEmpty())
                <div class="col col-sm-12">
                  <h1 style="text-align: center; color: #c2c7d0;">You don't have any policy yet</h1>
                  <hr>
                </div>

              @else
                @foreach($corp as $c)
                  <?php
                    $photo = $c->photo;
                  ?>
                  <div class="col col-sm-4">
                    <div class="card card-widget widget-user " style='background-color: #012F5C; color:white; opacity: 0.9; border: 2px solid #28A745'>
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-danger-active">
                        <h4 class="widget-user-username" style="color:white;"><u>{{$c->name}}</u></h4>
                        <h5 class="widget-user-desc">{{$c->email}}</h5>
                        <i class="fas fa-mobile-alt"></i><strong> &nbsp;: {{$c->phone}}</strong><br/>
                        <i class="fas fa-map-marker"></i><strong> &nbsp;: {{$c->address}}</strong>
                      </div>
                      <div class="widget-user-image" style='position: absolute; top: 10% !important; left: 87%; margin-left: -45px;'>
                        <img class="img-circle elevation-2" src="{{asset('images/'.$photo) }}" >
                      </div>
                      <div class="card-footer" style="border: 0">
                        <div class="row">
                          <div class="col-sm-4 border-right">
                            <div class="description-block">
                              <a href="./{{$c->CPP}}/policies" class="btn btn-danger "> My Policies </a>
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
              @endif
            </div>
            <!-- /.row -->
          </div>
        </div>
          <hr>
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection

