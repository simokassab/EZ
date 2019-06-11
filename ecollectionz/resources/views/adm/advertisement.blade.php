@extends('layouts.admin-app');

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Corporates
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
      <hr>       
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
       <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue">
              <div class="widget-user-image">
                <img class="img-circle" src="{{ asset('img/avatar.png') }}" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Corporate 1</h3>
              <h5 class="widget-user-desc">Beirut - Lebanon</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">B (Barcode) <span class="pull-right badge bg-blue">31</span></a></li>
                <li><a href="#">C (Cancelled) <span class="pull-right badge bg-red">5</span></a></li>
                <li><a href="#">D (Distribute) Projects <span class="pull-right badge bg-navy">12</span></a></li>
                <li><a href="#">E (Eliminate) <span class="pull-right badge bg-orange">842</span></a></li>
                <li><a href="#">P (Paid) <span class="pull-right badge bg-green">842</span></a></li>
                <li><a href="#">P-Online<span class="pull-right badge bg-aqua">842</span></a></li>
                <li><a href="#">UN (Under Progress) <span class="pull-right badge bg-yellow">842</span></a></li>
                <li><a href="#">V (Comments) <span class="pull-right badge bg-teal">842</span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
         <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-red">
              <div class="widget-user-image">
                <img class="img-circle" src="{{ asset('img/avatar2.png') }}" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Corporate 2</h3>
              <h5 class="widget-user-desc">London - UK</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">B (Barcode) <span class="pull-right badge bg-blue">31</span></a></li>
                <li><a href="#">C (Cancelled) <span class="pull-right badge bg-red">5</span></a></li>
                <li><a href="#">D (Distribute) Projects <span class="pull-right badge bg-navy">12</span></a></li>
                <li><a href="#">E (Eliminate) <span class="pull-right badge bg-orange">842</span></a></li>
                <li><a href="#">P (Paid) <span class="pull-right badge bg-green">842</span></a></li>
                <li><a href="#">P-Online<span class="pull-right badge bg-aqua">842</span></a></li>
                <li><a href="#">UN (Under Progress) <span class="pull-right badge bg-yellow">842</span></a></li>
                <li><a href="#">V (Comments) <span class="pull-right badge bg-teal">842</span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
         <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
              <div class="widget-user-image">
                <img class="img-circle" src="{{ asset('img/avatar3.png') }}" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Corporate 3</h3>
              <h5 class="widget-user-desc">Saida - Lebanon</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">B (Barcode) <span class="pull-right badge bg-blue">31</span></a></li>
                <li><a href="#">C (Cancelled) <span class="pull-right badge bg-red">5</span></a></li>
                <li><a href="#">D (Distribute) Projects <span class="pull-right badge bg-navy">12</span></a></li>
                <li><a href="#">E (Eliminate) <span class="pull-right badge bg-orange">842</span></a></li>
                <li><a href="#">P (Paid) <span class="pull-right badge bg-green">842</span></a></li>
                <li><a href="#">P-Online<span class="pull-right badge bg-aqua">842</span></a></li>
                <li><a href="#">UN (Under Progress) <span class="pull-right badge bg-yellow">842</span></a></li>
                <li><a href="#">V (Comments) <span class="pull-right badge bg-teal">842</span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
    
    
    
    
    
    
    
    
    
    <!-- /.col -->
    