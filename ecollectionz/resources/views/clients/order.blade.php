@extends('layouts.app')
@section('title', 'Policies')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Order</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Order</li>
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
                            <h3 class="card-title" style="color: white"></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @foreach($orderr as $o)
                                        @if($o->RespVal==1)
                                            <center>
                                                <h4 class="text-success">
                                                    Your Transaction was successful
                                                </h4>
                                                <hr>
                                                <br/>
                                                <h5>Order ID: {{$o->id}}</h5>
                                                <h5>Authorization no: {{$o->txtNumAut}}</h5>
                                                <h5>Amount: {{$o->txtAmount}}</h5>
                                                <h6 class="text-danger"><i>Your Official Receipt will be sent to your email in 7 days</i></h6>
                                                <hr>
                                                <a href="#" class="btn btn-lg btn-success vieww" id="{{$RID}}">Download Temporary Receipt</a>
                                                <br><br>
                                            </center>
                                        @else
                                            <center>
                                                <h4 class="text-danger">
                                                Unfortunately your transaction was refused
                                                </h4>
                                                <hr>
                                                <br/>
                                                <h5>Order ID: {{$o->id}}</h5>
                                                <h5>Amount: {{$o->txtAmount}}</h5>
                                                <h5>Cause: {{$o->RespMsg}}</h5>
                                                <hr>
                                                <br>
                                            </center>
                                        @endif
                                    @endforeach
                                </div>
                                <hr><br><br>
                                <iframe id="pdff" src ="" width="100%" height="600px"></iframe>
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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
    
        $('.vieww').click(function(event){
            event.preventDefault();
            var id = $(this).attr('id');
            $("#pdff").attr("src","{{URL_}}getPDF/"+id);

        });
    });
</script>
<script type = "text/javascript">  
    window.onload = function () {  
        document.onkeydown = function (e) {  
            return (e.which || e.keyCode) != 116;  
        };  
    }  
</script> 
