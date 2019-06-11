@extends('layouts.admin-app')
@section('title', 'Clients Dashboard')
@section('content')

    <div class="content-wrapper">
        <!-- Modal-->

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style='color:#012F5C;'>Export Excel !</h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                      </button>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  {!! Form::open(['id'=>'getpolicies', 'method'=>'get']) !!}
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col col-sm-12" >
                          <div class="form-group">
                              <label>Select Corporate</label>
                              <select id=corp_policies class="form-control select2" style="width: 100%;" name="corporates">
                                  <option value="null">Select Corporate</option>
                                @foreach($corp as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col col-sm-12">
                          <br/>
                          <button type="submit" class="btn btn-warning" style="width: 100%;">View !</button>
                      </div>
                  </div>
                  {!! Form::close() !!}
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
                <hr style="border-bottom: 1px solid #012F5C;">
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
            <!-- Small boxes (Stat box) -->
                <br/>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style='color:#012F5C;'>List of policies</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body showing">
                            <table id="politable" class="table table-bordered table-hover" style="width: 100% !important;">
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
                                        <th>Updated At</th>
                                        <th>See Comments</th>
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

