<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifiedRegister extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'email','password','role', 'verified_token', 'expiry_time',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App/User');
    }
}
