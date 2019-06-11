<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class err_policies extends Model
{
    protected $guard='admin';

    protected $table = 'err_policies';

    protected $fillable = [
        'cust_id', 'bord_date', 'policy', 'client_id','client_no', 'client_name', 'draft_no', 'status', 'due_date',
        'currency', 'amount', 'zone', 'broker_id', 'broker_name', 'remarks', 'phone',
        'insured_name', 'address',
    ];

    public $timestamps = false;
}
