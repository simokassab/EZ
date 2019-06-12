@extends('layouts.corporate-app')
@section('title', 'Corporate')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">My Brokers</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">brokers</li>
                        </ol>

                    </div><!-- /.col -->
                </div><!-- /.row -->
                <hr style="border-bottom: 1px solid #012F5C;">
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content container-fluid">
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-danger" style="border: 2px solid #012F5C;">
                        <div class="card-header">
                            <h3 class="card-title" style="color: white">My brokers</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table id="clients_table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Control</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brokers as $c)
                                        <tr>
                                            <td>{{$c->name}}</td>
                                            <td>{{$c->email}}</td>
                                            <td>{{$c->phone}}</td>
                                            <td>{{$c->address}}</td>
                                            <td style="width: 15% !important;">
                                                <div class="button_cont" align="center">

                                                    <a class="example_e" href="./{{$c->bk_id}}/BK/policies" rel="nofollow noopener">
                                                        Policies
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col col-sm-12">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
    </div>
@endsection

