<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CorporateResetPasswordNotification;
use Auth;

class Corporate extends Authenticatable
{
    use Notifiable;

    protected $guard='corporate';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password', 'phone', 'address', 'pay_online', 'collect_fees','net_c_fees' , 'gpa', 'rate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token){
        $this->notify(new CorporateResetPasswordNotification($token));
    }
}
