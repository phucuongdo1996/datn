<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccuracyEmailChange extends Model
{
    protected $table = 'accuracy_email_change';
    protected $fillable = ['user_id', 'email', 'verified_token', 'status'];

    /**
     * Relationship with user table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Relationship with profile table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }
}
