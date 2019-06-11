@extends('layouts.supervisor-app')
@section('title', 'Supervisor Dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        @include('inc.messages')
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
      <hr>       
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
     <h1>Supervisor page</h1>
    </section>
    <!-- /.content -->
  </div>
  <!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="pull-right hidden-xs">
    Anything you want
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
</footer>
@endsection
