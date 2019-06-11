@extends('layouts.app')
@section('title', 'Policies')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">New Policy</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Policys</li>
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
                    <div class="card card-info" style="border: 2px solid #012F5C;">
                        <div class="card-header">
                            <h3 class="card-title" style="color: white">Add New Policy</h3>
                        </div>
                        {!! Form::open(['action'=>'HomeController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="card-body">
                            <div class="row">

                                <div class="col col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label"for="corporates">Company</label>
                                        <select class="form-control select2" style="width: 100%;" name='corporates' id ='corporates' required>
                                            @foreach ($corp as $cor)
                                                    <option value="{{$cor->id}}" >{{$cor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-sm-12">
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name='phone' id='phone' value="" placeholder="e.g 96171123456">
                                    </div>
                                    <br>
                                </div>
                                <div class="col col-sm-12">
                                  <center><b>OR</b></center>
                                </div>
                                <div class="col col-sm-12">
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-address-card "></i></span>
                                        </div>
                                        <input type="number" class="form-control" name='policy_no' id='policy_no' value="" placeholder="policy Number">
                                    </div>
                                    <br>
                                </div>
                                <div class="col col-sm-12">
                                    <center><b>OR</b></center>
                                </div>
                                <div class="col col-sm-12">
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user "></i></span>
                                        </div>
                                        <input type="number" class="form-control" name='client_no' id='client_no' value="" placeholder="Client Number">
                                    </div>
                                    <br>
                                </div>
                                <div class="col col-sm-12">
                                    <center>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-cart-arrow-down "></i>&nbsp;&nbsp; Request Policy</button>
                                    </center>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div><!-- /.container-fluid -->
            </section>
    </div>
@endsection

