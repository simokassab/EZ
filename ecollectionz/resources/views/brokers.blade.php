@extends('layouts.brokers-app')
@section('title', 'Brokers')
@section('content')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard Brokers</h1>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Paid Policies</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>
                <p>Remaining Policies</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="card card-danger" style="border: 2px solid #012F5C;">
            <div class="card-header">
              <h3 class="card-title" style="color: white">My Clients</h3>
            </div>
          <div class="card-body">
            <div class="row">
                <table id="corporates_table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Control</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>1</td>
                      <td>Client 1</td>
                      <td>client1@email.com</td>
                      <td>+96171444501</td>
                      <td>
                        <div class="button_cont" align="center">
                          <a class="example_e" href="#" rel="nofollow noopener">
                        
                            Policies
                          </a>
                        </div>
                      </td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>Client 2</td>
                      <td>client2@email.com</td>
                      <td>+96171444502</td>
                      <td>
                        <div class="button_cont" align="center">
                          <a class="example_e" href="#" rel="nofollow noopener">
                            Policies
                          </a>
                        </div>
                      </td>
                  </tr>  
                  <tr>
                      <td>3</td>
                      <td>Client 3</td>
                      <td>client3@email.com</td>
                      <td>+96171444503</td>
                      <td>
                        <div class="button_cont" align="center">
                          <a class="example_e" href="#" rel="nofollow noopener">
                            Policies
                          </a>
                        </div>
                      </td>
                  </tr> 
                  <tr>
                      <td>4</td>
                      <td>Client 4</td>
                      <td>client4@email.com</td>
                      <td>+96171444504</td>
                      <td>
                        <div class="button_cont" align="center">
                          <a class="example_e" href="#" rel="nofollow noopener">
                            Policies
                          </a>
                        </div>
                      </td>
                  </tr> 
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

