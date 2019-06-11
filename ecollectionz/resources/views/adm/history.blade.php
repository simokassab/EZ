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
                        <h1 class="m-0 text-dark">Policies</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Policies</li>
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
                                <h3 class="card-title" style='color:#012F5C;'>List of policies</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php
                                   // print_r($policies)
                                ?>
                                <table id="brokers_table" class="table table-bordered table-hover" style="width: 100% !important;">
                                    <thead>

                                    <tr>
                                        <th>Corporate</th>
                                        <th>Client No</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Draft</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Currency</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Address</th>
                                        <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($history as $p)
                                        <tr class='histo' id='{{$p->phone}}_{{$p->draft_no}}_{{$p->client_name}}'>
                                            <td>{{$p->CP_NAME}}</td>
                                            <td>{{$p->client_no}}</td>
                                            <td>{{$p->client_name}}</td>
                                            <td>{{$p->phone}}</td>
                                            <td>{{$p->draft_no}}</td>
                                            <td>{{$p->due_date}}</td>
                                            @if($p->status == "")
                                                <td>UN</td>
                                            @else
                                                <td>{{$p->status}}</td>
                                            @endif
                                            @if($p->currency == 1)
                                                <td>USD</td>
                                            @else
                                                <td>LBP</td>
                                            @endif
                                            <td>{{$p->amount}}</td>
                                            <td>{{$p->remarks}}</td>
                                            <td>{{$p->address}}</td>
                                            <td>{{$p->created_at}}</td>
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
