@extends('layouts.app')
@section('title', 'Policies')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Checkout</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
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
                        <h3 class="card-title" style="color: white">Checkout</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="check" action="https://www.netcommercepay.com/iPAY/">
                            {{ csrf_field() }}
                            @foreach($data as $p)
                            <?php
                                  //  echo $order_id;
                                $cur ='';
                                $cur_val ='';

                                if($p->currency =='1'){
                                    $cur = 840;
                                    $cur_val ='USD';
                                }
                                else {
                                    $cur =422;
                                    $cur_val ='LBP';
                                }
                                $namnt = 0;
                                $txtamount = 0;
                                $camnt=0;
                                $finalamount=0;
                                $name = explode(' ', $p->CNAME);
                                $code = substr($p->phone, 0, 3);

                                if($p->C_FEES==0){
                                    if(($code=='961') &&($cur==840)){
                                        $camnt=$p->amount+3;
                                        $txtamount=$p->amount+3;
                                    }
                                    else if(($code=='961') &&($cur==422)){
                                        $camnt=$p->amount+4500;
                                        $txtamount=$p->amount+4500;
                                    }
                                    else if(($code!='961') &&($cur==422)){
                                        $camnt=$p->amount+7500;
                                        $txtamount=$p->amount+7500;
                                    }
                                    else if(($code!='961') &&($cur==840)){
                                        $camnt=$p->amount+5;
                                        $txtamount=$p->amount+5;
                                    }
                                }
                                else {
                                    $camnt=$p->amount;
                                    $txtamount=$p->amount;
                                }

                                

                                if($p->N_FEES==0){
                                    if($cur==840){
                                        $namnt = (2.5 * $camnt/100) + $camnt;
                                        $namnt = round($namnt, 2);
                                    }
                                    else if($cur==422){
                                        $namnt = (2.5 * $camnt/100) + $camnt;
                                        $namnt = round ($namnt);
                                    }                                    
                                }
                                else {
                                    $namnt=$camnt;
                                }
                               
                               // $txtIndex =$order_id;
                                $txtMerchNum = '01999131';
                                $txthttp = URL_.'payment_status';
                                $sha_key = 'TEST';
                                ?>
                            <div class="row">
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="password">First Name</label>
                                        <input type="text" class="form-control" value="{{$name[0]}}" name='fname' required id='fname' disabled>
                                        <input type="hidden" name='first_name' value="{{$name[0]}}">
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="password">Last Name</label>
                                        <input type="text" class="form-control" value="{{$name[2]}}" name='lname' required id='lname' disabled>
                                        <input type="hidden" name='last_name' value="{{$name[2]}}">
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="password">Email</label>
                                        <input type="text" class="form-control" value="{{$p->email}}" name='email_' required id='email_' disabled>
                                        <input type="hidden" name='email' value="{{$p->email}}">
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="password">Phone</label>
                                        <input type="text" class="form-control" value="{{$p->phone}}"  name='pp' required id='pp' disabled>
                                        <input type="hidden" name='mobile' value="00{{$p->phone}}">
                                        {{Session::put('CPHONE', $p->phone)}}
                                        {{Session::put('DRAFTNO', $p->draft_no)}}
                                        {{Session::put('DUEDATE', $p->due_date)}}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="amnnt">Amount</label>
                                        <input type="text" class="form-control" value="{{$p->amount}}" name='amnnt' required id='amnnt' disabled>

                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="password">Amount to Pay <small class="text-danger font-italic">Including Fees</small></label>
                                        <input type="text" class="form-control" value="{{$namnt}}" name='lname' required id='lname' disabled>
                                        <input type="hidden" name='txtAmount' id="txtAmount" value="{{$namnt}}">
                                        <input type="hidden" name='txtAmount1' value="{{$txtamount}}">
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="password">Currency</label>
                                        <input type="text" class="form-control" value="{{$cur_val}}"  disabled>
                                        <input type="hidden" name='txtCurrency' id="txtCurrency" value="{{$cur}}">
                                        <input type="hidden" id="txtIndex" name='txtIndex' value="">
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="password">Country</label>
                                        <input type="text" class="form-control" value="{{$p->country}}" disabled>
                                        <input type="hidden" name='country' value="{{$p->country}}">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="password">Address</label>
                                        <input type="text" class="form-control" value="{{$p->US_ADD}}" name='email_' required id='email_' disabled>
                                        <input type="hidden" name='address_line1' value="{{$p->US_ADD}}">

                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label"for="password">City</label>
                                        <input type="text" class="form-control" value="{{$p->city}}"  disabled>
                                        <input type="hidden" name='city' value="{{$p->city}}">
                                    </div>
                                </div>

                                <div class="col col-sm-3">
                                </div>
                                <div class="col col-sm-3">
                                    <img src="https://www.netcommerce.com.lb/logo/NCseal_L.gif"  alt="NetCommerce Security Seal" >
                                </div>
                            </div>
                            <hr style="border-bottom: 1px solid #012f5c;">
                            <div class="row">
                                <div class="col col-sm-12">
                                    <br/>
                                    <div class="form-group">
                                        <input type="hidden" name="payment_mode" value="test">

                                        <input type="hidden" name="txtMerchNum" id="txtMerchNum" value="{{$txtMerchNum}}">
                                        <input type="hidden" name="txthttp" id="txthttp" value="{{$txthttp}}">
                                        <?php

                                       // $signature= hash('sha256', $camnt.$cur.$txtIndex.$txtMerchNum.$txthttp.$sha_key);
                                        ?>
                                        <input type="hidden" name="signature" id="signature" value="">
                                        <button type="submit"  class="btn btn-success" style="width: 100%;">Checkout</button>
                                    </div>
                                </div>

                            </div>
                            @endforeach

                        </form>
                        <!-- /.row -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/sha256.js') }}"></script>
<script>
    var url =window.location.origin+'/ecollectionz/public';
    function makeid(length) {
        var result           = '';
        var characters       = '0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    $(document).ready( function() {
        $("#check").submit(function(event){
            var txtIndex = '{{$order_id}}-'+makeid(4)
            $('#txtIndex').val(txtIndex);
            var signature = sha256_digest($('#txtAmount').val()+$('#txtCurrency').val()+$('#txtIndex').val()+$('#txtMerchNum').val()+$('#txthttp').val()+'TEST');
            $('#signature').val(signature);
        });
    });
</script>

