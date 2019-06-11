@extends('layouts.brokers-app')
@section('title', 'Comments')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Comments</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">comments</li>
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
                    <hr>
                    <div class="card card-info" style="border: 2px solid #012F5C;">
                        <div class="card-header">
                            <h3 class="card-title" style="color: white">Comments</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-sm-12">
                                    <table id="" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Policy#</th>
                                            <th>Client#</th>
                                            <th>Amount</th>
                                            <th>Draft</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
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


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 col-md-offset-3 comments-section">
                                    <hr>
                                    @if($comments->isEmpty())
                                        <h2>Client has no comments yet</h2>
                                        <div class="row">
                                            <div class="col col-sm-12">
                                                <form method="post" action="addcomment" >
                                                    <textarea name="comment" id="comment" class="form-control" cols="30" required rows="10" placeholder="Add Comment here..."></textarea>
                                                    <br/>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </form>
                                            </div>

                                        </div>
                                    @else
                                    <!-- comments wrapper -->
                                    <div id="comments-wrapper">
                                        @foreach($comments as $c)
                                            <div class="comment clearfix">
                                                <div class="comment-details">
                                                    <span class="comment-name">{{$c->writer}}</span>
                                                    <span class="comment-date">{{$c->ccreated_at}}</span>
                                                    <p><strong>{{$c->message}}</strong> </p>
                                                </div>
                                            </div>
                                        @endforeach
                                        <hr style="border-top: 1px solid #012F5C;">
                                        @foreach($replies as $r)
                                            <div class="comment reply clearfix" style="margin: 0 0 0 60px !important;">
                                                <div class="comment-details">
                                                    <span class="comment-name">{{$r->from_}}</span>
                                                    <span class="comment-date">{{$r->created_at}}</span>
                                                    <p>{{$r->reply}}</p>
                                                </div>
                                            </div>
                                            <hr/>
                                        @endforeach
                                        <div class="reply_div">
                                            <form class="clearfix" method="post" action="../addreply" id="reply" name="reply">
                                                <input type="hidden" name="comment_id" value="{{$comments[0]->CID}}">

                                                <textarea name="message" id="message" class="form-control" cols="30" required rows="8" placeholder="Reply here..."></textarea>
                                                <br/>
                                                <button class="btn btn-primary btn-sm pull-right" id="submit">Reply</button>
                                                <br/> <br/>
                                            </form>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- // comments wrapper -->
                                </div>
                                <!-- // comments section -->
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

