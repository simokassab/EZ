
@extends('layouts.admin-app')



@section('title', 'CP-PAGE')
@section('content')

<div class="content-wrapper">
  <!-- Modal-->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$cp[0]->name}}</h1>
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
       <br/><br/>
        <div class="row">
          <div class="col-12">
           
          <div class="card">
            <div class="card-header">
              @foreach ($cp as $c)
              <h3 class="card-title" style='color:#012F5C;'>List of Policies</h3>
              @endforeach
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable_table" class="table table-bordered table-hover">
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
                  <th>Updated </th>
                  <th>Comments </th>
                </tr>
                </thead>
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

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.timeago.js') }}"></script>
<script>
$(document).ready( function() {
  var url1 ='{{URL_}}admin';
  $("#datatable_table").dataTable().fnDestroy();
        $("#datatable_table").on('draw.dt', function() {
          jQuery("time.timeago").timeago(); 
      });

     // alert(url1+"/corporate/150/getdatatable");
      
      $('#datatable_table').DataTable( {
        "processing": true,
        responsive: true,
        "pagingType": "full_numbers",
        ajax:{url:url1+"/corporate/{{$cp[0]->id}}/getdatatable",dataSrc:""},
    
        "columns": [
                { "data": "CP_NAME",
                  "render": function (data, type, row, meta) {
                    
                    var draft = row['draft_no'];
                      draft =draft.replace(/\\/g, "!");
                      draft =draft.replace("/", "-");
                     
                        var histo =row['phone']+"_"+draft+"_"+row['client_name'];
                       
                        return '<a target="_blank" class="btn btn-danger" href="../../'+histo+'/history/"><i class="fas fa-history"></i></a>';
                    }
                 },
                { "data": "client_no" },
                { "data": "client_name" },
                { "data": "phone" },
                { "data": "draft_no" },
                { "data": "due_date" },
                { "data": "status" },
                { "data": "currency",
                  "render": function (data, type, row, meta) {
                    var cur='';
                    if(row['currency']==1){
                          cur='USD';
                        }
                        else {
                          cur='LBP';
                        }
                    return cur;
                    
                    }
                 },
                { "data": "amount" },
                { "data": "RK" },
                { "data": "created_at",
                  "render": function (data, type, row, meta) {
                    
                    return '<time class="timeago" datetime="'+row['created_at']+'" >'+row['created_at']+'</time>';
                    
                    }
                  
                 },
                { "data": "comments",
                  "render": function (data, type, row, meta) {
                    var draft = row['draft_no'];
                    var corp = row['CID'];
                      draft =draft.replace(/\\/g, "!");
                      draft =draft.replace("/", "-");
                      var comments =corp+"_"+draft+"_"+row['phone'];
                    return '<a href="../../'+comments+'/comments" class="btn btn-warning">Comments</a>';
                    
                    }
                  
                 }
            ]
    } );
       
    
  });

  </script>

