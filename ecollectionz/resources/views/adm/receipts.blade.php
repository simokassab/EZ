@extends('layouts.admin-app')

@section('title', 'Excel Management')
@section('content')
<div class="content-wrapper">
  <!-- Modal-->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Receipts Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Receipts</li>
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
        <div class="row">
          <div class="col-12">
            <div class="card card-danger">
              <div class="card-header ">
                <h3 class="card-title up_title" style='color: white;'>Receipts</h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                      </button>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                      <div class="col col-sm-12" >
                          <table id="table" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Policy#</th>
                                  <th>Client#</th>
                                  <th>Amount</th>
                                  <th>Draft</th>
                                  <th>Due Date</th>
                                  <th>Paid </th>
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
                                      <td style="text-align: center;font-style: italic; color: #012F5C ;">
                                          <time class="timeago" datetime="{{$p->paid_at}}" >{{$p->paid_at}}</time>
                                      </td>
                                      <td>
                                      <?php

                                          $datenow = new DateTime("now");
                                          $due_date = new DateTime($p->paid_at);
                                          $interval = $due_date->diff($datenow);
                                          $diff = $interval->format('%a');
                                          if($diff >=0){
                                              echo "&nbsp;&nbsp;&nbsp;
                                                <a href='#' class='btn btn-lg btn-success' title='Send'><i class='fa fa-share'></i> </a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                              echo "<a href='./getPDF/".$p->RID."' id='".$p->RID."' target='_blank' class='btn btn-lg btn-primary vieww' title='View'><i class='fa fa-eye'></i> </a>";
                                          }
                                          else {
                                              $s = 7- $diff;
                                             echo "<b><i style='color:#9f191f'>You need ". $s." days at least to send the receipt </i></b>";
                                          }
                                      ?>
                                      </td>

                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
                  <hr>
                  <iframe id="pdff" src ="" width="100%" height="600px"></iframe>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
          <hr><br>
      </div>
      <br><br/>
    </section>
    <!-- /.content -->
  </div>
</div>
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('.vieww').click(function(event){
      event.preventDefault();
      var id = $(this).attr('id');
      $("#pdff").attr("src","http://localhost:8008/ecollectionz/public/admin/getPDF/"+id);

  });
});
</script>