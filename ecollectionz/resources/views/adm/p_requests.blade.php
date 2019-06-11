@extends('layouts.admin-app')
@section('title', 'Clients Dashboard')
@section('content')

    <div class="content-wrapper">
        <!-- Modal-->

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Policies Requests</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">P_Requests</li>
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
                                <h3 class="card-title" style='color:#012F5C;'>Requests</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php
                                   // print_r($policies)
                                ?>
                                    <table  id='table1' class="table  table-bordered hover" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Name</th>
                                        <th style="border-right: 4px solid #FFC107;">Sender Phone</th>
                                        <th>Client#</th>
                                        <th>Policy#</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($req as $p)
                                        <tr>
                                            <td>{{$p->CP_NAME}}</td>
                                            <td>{{$p->US_NAME}}</td>
                                            <td style="border-right: 4px solid #FFC107;">{{$p->USPHONE}}</td>
                                            <td>{{$p->client_number}}</td>
                                            <td>{{$p->policy}}</td>
                                            <td>{{$p->phone}}</td>

                                            <td style="width: 30%;">
                                                <a href="./{{$p->id}}/send_to_cp" class="btn btn-primary"><i class="fa fa-share-square "></i>&nbsp;&nbsp; Send to Corporate</a>
                                                <a href="./{{$p->id}}/confirm" class="btn btn-success"><i class="fa fa-check-circle "></i>&nbsp;&nbsp;Confirm</a>
                                                <a href="./{{$p->id}}/decline" class="btn btn-danger"><i class="fa fa-window-close "></i>&nbsp;&nbsp;Decline</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header ">
                                <h3 class="card-title" style='color:white;'>Sent Requests</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php
                                // print_r($policies)
                                ?>
                                    <table  id='table2' class="table  table-bordered hover" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Name</th>
                                        <th style="border-right: 4px solid #FFC107;">Sender Phone</th>
                                        <th>Client#</th>
                                        <th>Policy#</th>
                                        <th>Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($req_sent as $p)
                                        <tr>
                                            <td>{{$p->CP_NAME}}</td>
                                            <td>{{$p->US_NAME}}</td>
                                            <td style="border-right: 4px solid #FFC107;">{{$p->USPHONE}}</td>
                                            <td>{{$p->client_number}}</td>
                                            <td>{{$p->policy}}</td>
                                            <td>{{$p->phone}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="card card-success">
                            <div class="card-header ">
                                <h3 class="card-title"   style='color:white;'>Confirmed Requests</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php
                                // print_r($policies)
                                ?>
                                    <table  id='table3' class="table  table-bordered hover" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Name</th>
                                        <th style="border-right: 4px solid #FFC107;">Sender Phone</th>
                                        <th>Client#</th>
                                        <th>Policy#</th>
                                        <th>Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($req_done as $p)
                                        <tr>
                                            <td>{{$p->CP_NAME}}</td>
                                            <td>{{$p->policy}}</td>
                                            <td>{{$p->client_number}}</td>
                                            <td>{{$p->phone}}</td>
                                            <td>{{$p->US_NAME}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="card card-danger">
                            <div class="card-header ">
                                <h3 class="card-title"  style='color:white;' >Declined Requests</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php
                                // print_r($policies)
                                ?>
                                    <table  id='table4' class="table  table-bordered hover" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Name</th>
                                        <th style="border-right: 4px solid #FFC107;">Sender Phone</th>
                                        <th>Client#</th>
                                        <th>Policy#</th>
                                        <th>Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($req_decline as $p)
                                        <tr>
                                            <td>{{$p->CP_NAME}}</td>
                                            <td>{{$p->policy}}</td>
                                            <td>{{$p->client_number}}</td>
                                            <td>{{$p->phone}}</td>
                                            <td>{{$p->US_NAME}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
