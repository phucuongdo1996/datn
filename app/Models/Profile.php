<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $table = 'profiles';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'person_charge_first_name',
        'person_charge_last_name',
        'person_charge_first_name_kana',
        'person_charge_last_name_kana',
        'nick_name',
        'avatar',
        'avatar_thumbnail',
        'gender',
        'birthday',
        'email',
        'phone',
        'zip_code',
        'address_city',
        'address_district',
        'address_town',
        'address_building',
        'company_name',
        'division',
        'company_representative_first_name',
        'company_representative_last_name',
        'business_name',
        'website_business_name',
        'website_business_name_other',
        'introduction',
        'answer',
        'notification',
        'license_address',
        'license',
        'number_license',
        'search_tool',
        'presenter',
        'unblock_status',
        'deleted_at'
    ];

    /**
     * The attributes auto set time stamps
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Relation table user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

    /**
     * Relation table specialty
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'profile_specialty', 'profile_id', 'specialty_id');
    }

    /**
     * Relation table profileSpecialty
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profileSpecialty()
    {
        return $this->hasMany(ProfileSpecialty::class, 'profile_id', 'id');
    }

    /**
     * Relation table userSubscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userSubscription()
    {
        return $this->belongsTo(UserSubscription::class, 'user_id', 'user_id');
    }
}
