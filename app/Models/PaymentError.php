<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentError extends Model
{
    use SoftDeletes;

    protected $table = 'payment_errors';

    protected $fillable = ['user_id'];
}
