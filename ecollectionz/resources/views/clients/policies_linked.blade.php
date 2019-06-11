@extends('layouts.app')
@section('title', 'Policies')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Linked Policies</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Linked Policies</li>
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
                    <div class="card card-danger" style="border: 2px solid #012F5C;">
                        <div class="card-header">
                            <h3 class="card-title" style="color: white">My Linked Policies</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table id="brokers_table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Policy#</th>
                                        <th>Client#</th>
                                        <th>Amount</th>
                                        <th>Draft</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Control</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($policies as $p)
                                        <tr>
                                            <td>{{$p->id}}</td>
                                            <td>{{$p->policy}}</td>
                                            <td>{{$p->client_id}}</td>
                                            @if($p->currency==1)
                                                <td>{{$p->amount}} $</td>
                                            @else
                                                <td>{{$p->amount}} LBP</td>
                                            @endif
                                            <td>{{$p->draft_no}}</td>
                                            <td>{{$p->due_date}}</td>
                                            @if($p->status=='')
                                                <td>UN</td>
                                            @else
                                                <td>{{$p->status}}</td>
                                           @endif
                                            @if($corp[0]->pay_online==1)
                                                @if($p->status =='P-online')
                                                    <td><a class="btn btn-info" href="{{ url('/') }}/{{$p->id}}/DOWNLOAD">Download Receipt</a></td>
                                                @elseif ($p->status =='P')
                                                    <td><h5 class="text-success">Draft PAID</h5> </td>
                                                
                                                @else
                                                    <td><a class="btn btn-success" href="{{ url('/') }}/{{$p->id}}/checkoutlinked">PAY Draft !</a> </td>
                                                @endif
                                            @else
                                                <td><p class="text-danger">Company doesn't allow to pay online</p></td>
                                            @endif

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

