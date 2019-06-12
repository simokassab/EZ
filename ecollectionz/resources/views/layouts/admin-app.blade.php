<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="userId" content="{{Auth::user()->id}}">
    <title>EZ - @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/iCheck/flat/yellow.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datepicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <style>
      body {

      }



      .highcharts-credits {
        display: none !important;
      }
      .clicked {
        cursor: pointer;
      }


      h1, h2, h3 {
         font-family: 'Poppins', sans-serif;
        font-weight: bold;
        color: #012f5c;
        font-size: 2rem;
        margin: 1.6em 0 0.8em;
        padding-bottom: 0.4em;
        position: relative;
      }
      .nav >.nav-item {
       /*border-bottom: 1px solid #CBD5DE;*/
       margin-bottom: 4%;
      }
      .nav >.nav-item:hover {
        transition: 0.4s;
        background-color: #D7B40E ;
        color: #012F5C !important;
      }

      .nav >.nav-item > a:hover {
        background-color: #D7B40E;
        color: #012F5C !important;
      }

      .badgebox
      {
          opacity: 0;
          color: white;
      }

      .badgebox + .badge
      {
          /* Move the check mark away when unchecked */
          text-indent: -999999px;
          /* Makes the badge's width stay the same checked and unchecked */
        width: 27px;
      }

      .badgebox:focus + .badge
      {
          /* Set something to make the badge looks focused */
          /* This really depends on the application, in my case it was: */

          /* Adding a light border */
          box-shadow: inset 0px 0px 5px;
          /* Taking the difference out of the padding */
      }

      .badgebox:checked + .badge
      {
          /* Move the check mark back when checked */
        text-indent: 0;
      }

      .example_e {
          border: none;
          background: #FFC107;
          color: #012F5C !important;
          font-weight: 500;
          padding: 4px;
          border-radius: 6px;
          display: inline-block;
      }
      .example_e:hover {
          color: white !important;
          font-weight: 700 !important;
          letter-spacing: 1px;
          text-decoration: none;
          background: #012F5C;
          -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
          -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
          transition: all 0.1s ease 0s;
      }

      .comments-section { margin-top: 10px; border: 1px solid #ccc; }
      .comment { margin-bottom: 10px; }
      .comment .comment-name { font-weight: bold; }
      .comment .comment-date {
        font-style: italic;
        font-size: 0.8em;
      }
      .comment .reply-btn, .edit-btn { font-size: 0.8em; }
      .comment-details { width: 91.5%; float: left; }
      .comment-details p { margin-bottom: 0px; }
      .comment .profile_pic {
        width: 35px;
        height: 35px;
        margin-right: 5px;
        float: left;
        border-radius: 50%;
      }
      /*replies*/
      .reply { margin-left: 30px; }
      .reply_form {
        margin-left: 40px;
        display: none;
      }
      #comment_form { margin-top: 10px; }
      table {
        width: 100% !important;
      }

      @media screen and (max-width: 767px) {
        li.paginate_button.previous {
          display: inline;
        }

        li.paginate_button.next {
          display: inline;
        }

        li.paginate_button {
          display: none;
        }
      }

      div.dataTables_wrapper div.dataTables_info {
        white-space: normal;
      }
    </style>
</head>
<body class="hold-transition sidebar-mini" >

<!-- End Modal -->
<div class="wrapper" id="app">
   <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      {!! Form::open(['action'=>'Admins\AdminCpController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="modal-header" style="background-color: #012F5C; color: white;">
          <h4 class="modal-title">Add Corporate</h4>
          <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col col-sm-6">
              <div class="form-group">
                 <label class="control-label"for="id">ID</label>
                 <input type="text" class="form-control" name='id' required id='id'>
              </div>
            </div>
            <div class="col col-sm-6">
              <div class="form-group">
                <label class="control-label"for="name">Name</label>
                <input type="text" class="form-control" name='name' required id='name'>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col col-sm-4">
              <div class="form-group">
                <label class="control-label"for="email">Email</label>
                <input type="email" class="form-control" name='email' required id='email'>
              </div>
            </div>
            <div class="col col-sm-4">
              <div class="form-group">
                 <label class="control-label"for="password">Password</label>
                 <input type="text" class="form-control" name='password' required id='password'>
              </div>
            </div>
            <div class="col col-sm-4">
              <label class="control-label"for="phone">Phone</label>
              <input type="number" class="form-control" name='phone' required id='phone'>
            </div>
          </div>
          <div class="row">
            <div class="col col-sm-6">
              <label class="control-label"for="address">Address</label>
              <input type="text" class="form-control" name='address' required id='address'>
            </div>
            <div class="col col-sm-6">
              <label class="control-label"for="photo">Photo</label>
              <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="customFile" name="photo" required>
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col col-sm-6">
              <label for="pay_online">Collect Fees <small>(3$ and 5$)</small>: &nbsp;&nbsp;&nbsp;&nbsp;</label><br>
              <label>Corporate
                <input type="radio" name="collect_fees" class="flat-red" value="1" checked>
              </label>&nbsp;&nbsp;&nbsp;
              <label>Client
                <input type="radio" name="collect_fees" value="0" class="flat-red">
              </label>
            </div>
            <div class="col col-sm-6">
              <label for="pay_online">Net Commerce Fees <small>(2.5%)</small>: &nbsp;&nbsp;&nbsp;&nbsp;</label><br>
              <label>Corporate
                <input type="radio" name="net_c_fees" class="flat-red" value="1" checked>
              </label>&nbsp;&nbsp;&nbsp;
              <label>Client
                <input type="radio" name="net_c_fees" value="0" class="flat-red">
              </label>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col col-sm-4">
              <label for="pay_online">Pay Online: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                <label>YES
                  <input type="radio" name="pay_online" class="flat-red" value="1" checked>
                </label>&nbsp;&nbsp;&nbsp;
                <label>NO
                  <input type="radio" name="pay_online" value="0" class="flat-red">
                </label>
            </div>
            <div class="col col-sm-4">
              <label for="pay_online">GPA: &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <label>YES
                <input type="radio" name="gpa" class="flat-red" value="1" checked>
              </label>&nbsp;&nbsp;&nbsp;
              <label>NO
                <input type="radio" name="gpa" value="0" class="flat-red">
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info btn-lg" >Add It !</button>
          <button type="reset" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
   </div>
   <?php
    // Brokers Modal
   ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light border-bottom" style="background-color:#012F5C !important;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars" style='color:#C2C7D0 !important;'></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown" >
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell"  style='color:#C2C7D0 !important; font-size: 20px; margin: 10px 10px 0 0;'></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div  class="dropdown-menu dropdown-menu-lg dropdown-menu-right  notif"  style="width: 500px !important;">

        </div>
      </li>
    </ul>
    <a href="{{ route('admin.profile') }}" class="btn btn-warning " >
      Profile
    </a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./admin" class="brand-link">
    
      <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image  elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">EZ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        
          <img src="{{ asset('images/administrator.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav  nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li  class='nav-item' >
            <a href="{{ URL::route('admin.dashboard') }}" class='nav-link'>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

        <li  class='nav-item ' >
          <a href="{{ url('/') }}/admin/corporate" class='nav-link active'>
            <i class="nav-icon fa fa-warehouse"></i>
            <p>Corporates</p>
          </a>
        </li>
        <li  class='nav-item' >
          <a href="{{ url('/') }}/admin/brokers" class='nav-link'>
            <i class="fas fa-blog nav-icon"></i>
            <p>Brokers</p>
          </a>
        </li>
        <li  class='nav-item' >

          <a href="{{ url('/') }}/admin/policies_" class='nav-link'>
            <i class="fas fa-file-alt  nav-icon"></i>
            <p>Policies</p>
          </a>
        </li>
          <li  class='nav-item has-treeview' >
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Clients
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color:  #012F5C !important; ">
              <li class="nav-item" >
                <a href="{{ url('/') }}/admin/unrclients"class="nav-link" style="background-color:  #012F5C !important; color: #D7B40E !important;">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Our Clients</p>
                </a>
              </li>
              <li class="nav-item" >
                <a href="{{ url('/') }}/admin/rclients"class="nav-link" style="background-color:  #012F5C !important; color: #D7B40E !important;">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Registred Users</p>
                </a>
              </li>

            </ul>
          </li>
        <li  class='nav-item' >
          <a href="{{ URL::route('admin.excel') }}" class='nav-link'>
            <i class="nav-icon fas fa-file-excel"></i>
            <p>Excel Management</p>
          </a>
        </li>
        <li  class='nav-item' >
          <a href="{{ url('/') }}/admin/p_requests"  class='nav-link'>
            <i class="nav-icon fas fa-boxes"></i>
            <p>Policies Request</p>
          </a>
        </li>
        <li  class='nav-item' >
          <a href="{{ URL::route('admin.receipts') }}" class='nav-link'>
            <i class="nav-icon fas fa-receipt"></i>
            <p>Receipts Management</p>
          </a>
        </li>
        <li  class='nav-item' >
          <a href="{{ URL::route('admin.reports') }}" class='nav-link'>
          <i class="fas fa-chart-pie"></i>
            <p>Reports</p>
          </a>
        </li>
        <li  class='nav-item' >
          <a href="{{ url('/') }}/admin/feedback" class='nav-link'>
            <i class="nav-icon fas fa-ad"></i>
            <p>Feedback</p>
          </a>
        </li>
        <li  class='nav-item' >
          <a href="{{ URL::route('admin.adv') }}" class='nav-link'>
            <i class="nav-icon fas fa-ad  "></i>
            <p>Advertisements</p>
          </a>
        </li>
        <!--li  class='nav-item' >
          <a href="{{ url('/') }}/admin/feedback"  class='nav-link'>
            <i class="nav-icon fas fa-comments"></i>
            <p>Feedback</p>
          </a>
        </li -->
        <a href="{{ route('admin.logout') }}"  onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="btn btn-danger " >
          Logout
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Main content -->
   @yield('content')
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="#">Ecollectionz.online</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('js/jquery.timeago.js') }}"></script>

<script>
$(document).ready( function() {
  $('#brokers_table').DataTable( {
        responsive: true,
        "pagingType": "full_numbers"
    } );
  jQuery("time.timeago").timeago(); 
  var url ='{{URL_}}admin';
  
  $("#politable").on('draw.dt', function() {
    jQuery("time.timeago").timeago(); 
});
  $('#getpolicies').submit(function(event){
      event.preventDefault();
      
      var corp= $("#corp_policies").val();
      $("#politable").dataTable().fnDestroy();
      $('#politable').DataTable( {
        "processing": true,
        responsive: true,
        "pagingType": "full_numbers",
        ajax:{url:url+"/"+corp+"/getdatatable",dataSrc:""},
    
        "columns": [
                { "data": "CP_NAME",
                  "render": function (data, type, row, meta) {
                    
                    var draft = row['draft_no'];
                      draft =draft.replace(/\\/g, "!");
                      draft =draft.replace("/", "-");
                      var histo =row['phone']+"_"+draft+"_"+row['client_name'];
                       
                      return '<a target="_blank" class="btn btn-danger" href="'+histo+'/history/"><i class="fas fa-history"></i></a>';
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
                      draft =draft.replace(/\\/g, "!");
                      draft =draft.replace("/", "-");
                      var comments =corp+"_"+draft+"_"+row['phone'];
                    return '<a href="./'+comments+'/comments" class="btn btn-warning">Comments</a>';
                    
                    }
                  
                 },
            ]
    } );    
  });
    var url ='{{URL_}}admin';
    console.log(url);
    getAjaxNotice();
    function getAjaxNotice() {
        var notif = "";
        $.ajax({
            type: 'get',
            url: url+'/notifications',
            dataType: 'JSON',
            success: function(data){
                if(data.length ==0){
                    $('.navbar-badge').html('');
                    notif="<a    class='dropdown-item '>\n" +
                            "            <div class='media'>\n" +
                            "              <div class='media-body'>\n" +
                            "                <h3 class='dropdown-item-title'>\n" +
                            "       No new notification           <span class='float-right text-sm text-danger'><i class='fa fa-eye'></i></span>\n" +
                            "                </h3>\n" +
                            "              </div>\n" +
                            "            </div>\n" +
                            "          </a>";
                    $('.notif').html(notif);
                }
                else{
                    for(var i=0;i<data.length;i++){
                        $('.navbar-badge').html(data.length);
                        //console.log(data[i].title);
                        notif+="<a  id='"+ data[i].id+"'  class='dropdown-item notif_click'>\n" +
                            "            <div class='media'>\n" +
                            "              <div class='media-body'>\n" +
                            "                <h3 class='dropdown-item-title'>\n" +
                            data[i].title +
                            "                  <span class='float-right text-sm text-danger'><i class='fa fa-eye'></i></span>\n" +
                            "                </h3>\n" +
                            "                <p class='text-sm'>"+data[i].body+"</p>\n" +
                            "                <p class='text-sm text-muted'><i class='fa fa-clock-o mr-1'></i> "+data[i].created_at+"</p>\n" +
                            "              </div>\n" +
                            "            </div>\n" +
                            "          </a>";

                    }
                    $('.notif').html(notif);
                }
            }
        });
    }
    window.setInterval(function(){
        getAjaxNotice();
    }, 4000);

    jQuery("time.timeago").timeago();
    $(document).on('click','.notif_click',function(e) {
        //alert('dd');
        var id = $(this).attr("id");
        $.ajax({
            type: 'get',
            url: url+'/'+id+'/read',
            success: function(data){
              //getAjaxNotice();
                console.log(url + data);
                window.location=  data;
            }
        });
    });
    //mark as read

  $('.select2').select2();
  $('#clients_table').DataTable( {
        responsive: true,
        "pagingType": "full_numbers"
    } );
    $('#c_table').DataTable( {
        responsive: true,
        "pagingType": "full_numbers"
    } );

    $('#corporates_table').DataTable( {
        responsive: true,
        "pagingType": "full_numbers"
    } );


  $('#dates').daterangepicker({
    locale: {
      format: 'DD-MM-YYYY'
    }
  });

  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });


    $(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
		});

		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#imgInp").change(function(){
		    readURL(this);
		});

    $(".clicked").click(function() {
        var id = $(this).attr("id");
        location.href = "./admin/"+id+"/status";
    });
    $(".us_reg_pol").click(function() {
        var id = $(this).attr("id");
        location.href = "./admin/poli";
    });
    $(".un_us_reg_pol").click(function() {
        var id = $(this).attr("id");
        location.href = "./admin/poli1";
    });
    $(".us_reg_unpol").click(function() {
        var id = $(this).attr("id");
        location.href = "./admin/poli2";
    });
    $(".corpp").click(function() {
        var id = $(this).attr("id");
        location.href = "./admin/corporate";
    });
    $('.policc').click(function(event){
      var phone = $(this).attr('id');
      location.href = "../../../admin/"+phone+"/policy";
    });

    // policies page
    $('#formm').submit(function(event){
      event.preventDefault();
      var file_data = $('#import_file').prop('files')[0];
      var form_data = new FormData();
      form_data.append('import_file', file_data);
      form_data.append('_token', '{{csrf_token()}}');

        $.ajax({
            url: "{{url('admin/importExcel')}}",
            dataType    : 'text',           // what to expect back from the PHP script, if anything
            cache       : true,
            contentType : false,
            processData : false,
            data        : form_data,
            type        : 'post',
            beforeSend: function() {
                // setting a timeoutup_title
                $(".uploading").html("<img src='{{ asset('img/loading.gif') }}'  style='width: 100px;'>");
                $(".up_title").html("Uploading ... Please wait, this might take a while depending your excel size..");
            },
            success:function(response){
                // console.log(response);
                console.log(response);
                    // obj.pause();
                alert('Your file has been uploaded successfully !');
                location.reload();
            },
            error: function (response) {
                console.log(response);
              alert('There is an error in your file, please contact the support ! ');
                location.reload();
            }
        });
  });

	});
</script>
</body>
</html>
