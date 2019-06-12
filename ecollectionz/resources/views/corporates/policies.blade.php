@extends('layouts.corporate-app')
@section('title', 'Corporate')
@section('content')
    <div class="content-wrapper">
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
                            <li class="breadcrumb-item active">Dashboard</li>
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
                            <h3 class="card-title" style="color: white">Client Policies</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table id="policies_table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>History</th>
                                        <th>Client No</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Draft</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Currency</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Control</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($policies as $p)
                                        <tr>
                                        <?php 
                                                if (strpos($p->draft_no, '\\') !== false) {
                                                    $draft = str_replace('\\', '!', $p->draft_no);
                                                }
                                                else {
                                                    $draft = str_replace('/', '-', $p->draft_no);
                                                }
                                                $histo =$p->phone."_".$draft."_".$p->client_name;
                                                $comments =Auth()->user()->id."_".$draft."_".$p->phone;
                                            ?>
                                            <td>

                                            <a target='_blank' title='History' href='../../{{$histo}}/history' class='btn btn-danger'>
                                            <i class='fas fa-history'></i></a>
                                            </td>
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
                                            <td>{{$p->RK}}</td>
                                            <td><a 
                                            href="../../{{$comments}}/comments"
                                            class="btn btn-warning">Comments</a> </td>
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
                    <hr>
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

