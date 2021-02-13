<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use SoftDeletes;

    protected $table = 'user_subscription';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'start_date', 'finish_date', 'id_subscription', 'status', 'trial_status', 'is_trial', 'discount'];

    /**
     * Relation table user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
