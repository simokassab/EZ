<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .table1 {
            border-collapse: collapse;
        }

        .table1,.table2, .tr1, .td1 {
            border: 1px solid black;
        }

        .table2 {
            border-collapse:separate;
            border-spacing: 0 1em;
        }

        .img2 {
           margin-right: 15px;
        }

        .td2 {
            text-align: right;
        }
    </style>
</head>
<body>

<div class="container-fluid">
   <table border="0">
       <tr>
           <td>
               <img src="{{ asset('img/collect.jpg') }}" style="width: 15%">
               <p style="line-height: 10pt;">Capital 500.000.000L.L</p>
               <p style="line-height: 10pt;">R.C 67856 baabda - Liban</p>
               <p style="line-height: 10pt;">TEL: 01/892335 - 01/892336</p>
               <p style="line-height: 10pt;">Hotline: 76/98 88 41 - 78/ 90 47 81</p>
               <p style="line-height: 10pt;">E-mail: <span style="color: dodgerblue">saminseiri@collectsal.com</span></p>
           </td>
           <td >
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <img src="{{ asset('images/eloan.png') }}">
           </td>
       </tr>
   </table>
    <br><br>
    <center style="direction: rtl;"><img src="{{ asset('images/rtitle.png') }}" style="width: 20%"></center>
    <br>
    <div style="border: 1px solid black; padding: 10px;">
        <table class="table1"  style="width: 100%; font-weight: bolder; margin-left: 3px;">
            <tr class="tr1">
                <td class="td1">Receipt#: {{$receipt_id}} <br><br></td>
                <td class="td1" colspan="2">Amount: {{$amount}} USD / {{$amount1}}  LBP</td>
            </tr>
            <tr class="tr1">
                <td class="td1">ClientID: {{$client_id}} <br><br></td>
                <td class="td1">Policy#: {{$policy}} </td>
                <td class="td1">ClientNo: {{$client_no}} </td>
            </tr>
        </table>
        <br>
        <table class="table2" style="width: 100%; font-weight: bolder; margin-left: 2px;">
            <tr >
                <td>From: </td>
                <td>{{$client_name}} </td>
                <td class="td2"><img class="img2" src="{{ asset('images/rfrom.png') }}" width="65px" ></td>
            </tr>
            <tr >
                <td>For Account of</td>
                <td>{{$cp_name}} </td>
                <td class="td2"><img class="img2" src="{{ asset('images/raccount.png') }}" width="45px" ></td>
            </tr>
            <tr>
                <td>Due Date</td>
                <td>{{$due_date}} </td>
                <td class="td2"><img class="img2" src="{{ asset('images/rdue.png') }}"  width="80px"></td>
            </tr>
            <tr>
                <td>In settlement of payment:</td>
                <td>{{$draft}} </td>
                <td class="td2"><img class="img2" src="{{ asset('images/rdraft.png') }}" width="80px" ></td>
            </tr>
            <tr>
                <td>The sum of: </td>
                <td>{{$sum}} </td>
                <td class="td2"><img class="img2" src="{{ asset('images/rtotal.png') }}"  width="40px"></td>
            </tr>
        </table>
        <br>
        <table style="width: 100%; font-weight: bold; margin-left: 2px;">
            <tr>
                <td style="text-align: center;">{{$paid_at}} <img class="img2" src="{{ asset('img/rdate.png') }}"  width="40px"></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>